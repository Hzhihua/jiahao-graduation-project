<?php
/**
 * @Author: Hzhihua
 * @Time: 2017/10/20 15:56
 * @Email: cnzhihua@gmail.com
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\Media;
use common\models\UploadWork;
use yii\web\NotFoundHttpException;

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
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['GET'],
                    'create' => ['POST'],
                    'file-upload' => ['POST'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return array_merge(parent::actions(), [
            'file-upload' => [
                'class' => 'hzhihua\actions\FileUploadAction',
                'attribute' => 'media',
                'seeDirectory' => Yii::$app->params['baseUrl'],
                'uploadDirectory' => Yii::$app->params['baseDirectory'],
                'on afterUpload' => [new Media(), 'afterMediaUpload'],
//                'responseFormat' => 'json',
            ],
            'file-delete' => [
                'class' => 'hzhihua\actions\FileDeleteAction',
                'on beforeDelete' => [new Media(), 'beforeMediaDelete'],
//                'on afterDelete' => [new Media(), 'afterMediaDelete'],
            ],
            'file-download' => [
                'class' => 'hzhihua\actions\FileDownloadAction',
                'on beforeDownload' => [new Media(), 'beforeMediaDownload'],
//                'responseFormat' => 'json',
            ],
        ]);
    }

    public function actionIndex()
    {
        $model = new UploadWork();
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionCreate()
    {
        $model = new UploadWork();

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $file_id = Media::getIdByFileKey($post['file_id']);
            $_POST['UploadWork']['file_id'] = $file_id;
            if ($model->load($_POST) && $model->save()) {
                echo '<script>alert("提交成功")</script>';
            }
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}