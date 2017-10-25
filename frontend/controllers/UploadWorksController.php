<?php
/**
 * @Author: Hzhihua
 * @Time: 2017/10/20 15:56
 * @Email: cnzhihua@gmail.com
 */

namespace frontend\controllers;

use common\models\StudentClass;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use frontend\models\UploadWorks;
use common\models\File;
use common\models\UploadWork;
use PDOException;

/**
 * Class UploadWorksController
 * 作业上传
 *
 * @package frontend\controllers
 * @Author Hzhihua <cnzhihua@gmail.com>
 */
class UploadWorksController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['GET'],
                    'upload' => ['POST'],
                    'post' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        // 获取文件全路径
        $params = Yii::$app->params;
        $session = Yii::$app->session;
        $rootDir = rtrim($params['uploadFileRoot'], '/') . '/';
        $file = isset($session['file']) ? $rootDir . $session['file']['url'] : null; // /frontend/web/uploads

        // 每次刷新页面删除上一次未上传完的文件
        UploadWorks::removeUploadFile($file);
        $message = $session['message']; // 判断表单是否提交成功
        $session['file'] = null;
        $session['message'] = null;

        $studentClass = StudentClass::find()->asArray()->all();
        return $this->render('index', [
            'message' => $message,
            'studentClass' => $studentClass,
        ]);
    }

    /**
     * 作业文件上传
     */
    public function actionUpload()
    {
        // 文件锁  防止出现多线程问题
        $sock_file = 'sock.txt';
        $fp = fopen($sock_file, 'w');
        flock($fp, LOCK_EX) or die('Lock Error');
        fwrite($fp, 'fileSock');

        // 获取配置参数  /frontend/config/params.php
        $params = Yii::$app->params;
        // 上传文件保存的根目录路径
        $rootDir = $params['uploadFileRoot']; // /frontend/web/uploads
        // 允许上传的文件类型
        $extArray = $params['uploadFileExtension'];
        // 移动上传的临时文件并返回文件大小
        echo UploadWorks::moveUploadFile($rootDir, $extArray);

        flock($fp, LOCK_UN);
        fclose($fp);
    }

    /**
     * 提交表单
     */
    public function actionPost()
    {
        $session = Yii::$app->session;
        $file = $session['file'];

        if (empty($file)) {
            $session['message'] =  'alert("请选择要提交的文件")>';
            return $this->redirect(['index']);
        }

        $transaction = Yii::$app->getDb()->beginTransaction();
        try {
            $fileModel = new File();
            $rst = $fileModel->load($file, '') && $fileModel->save();
            if (! $rst) {
                $errors = $fileModel->getFirstErrors();
                throw new PDOException(array_shift($errors));
            }

            $post = Yii::$app->getRequest()->post();
            $post['form']['file_id'] = Yii::$app->getDb()->getLastInsertID();

            $uploadWork = new UploadWork();
            $rst = $uploadWork->load($post,'form') && $uploadWork->save();
            if (! $rst) {
                $errors = $uploadWork->getFirstErrors();
                throw new PDOException(array_shift($errors));
            }

            $transaction->commit();
        } catch (PDOException $e) {
            $transaction->rollBack();
            throw $e;
        }

        $session['file'] = null;
        $session['message'] = 'alert("提交成功")'; // 判断表单是否提交成功
        return $this->redirect(['index']);
    }
}