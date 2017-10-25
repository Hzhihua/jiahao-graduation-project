<?php
/**
 * @Author: Hzhihua
 * @Time: 2017/10/21 11:55
 * @Email: cnzhihua@gmail.com
 */

namespace frontend\controllers;

use Yii;
use common\models\File;
use common\models\Simulation;
use yii\web\Controller;
use yii\web\Response;

class SimulationController extends Controller
{
    public function actionIndex()
    {
        $data = Simulation::find()->with('author', 'file')->asArray()->all();

        foreach ($data as $k => $v) {
            $data[$k]['file']['size'] = self::conversion($v['file']['size']);
        }

        return $this->render('index', [
            'data' => $data,
        ]);
    }

    /**
     * 下载文件
     * @param int $file 文件ID
     * @return Response
     */
    public function actionDownload($file)
    {
        $params = Yii::$app->params;
        $file = File::findOne($file);
        $host = dirname($_SERVER['DOCUMENT_URI']) === '/' ? '' : dirname($_SERVER['DOCUMENT_URI']);
        $url = $host . '/' . $params['uploadFileRoot'] . '/' . $file->url;
        return Yii::$app->getResponse()->redirect($url, 302);
    }

    /**
     * 单位换算
     * @param int $length 大小(单位：字节)
     * @return string 换算后的大小(带单位)
     */
    public static function conversion($length)
    {
        if ($length >= 1073741824) {
            $length = round($length / 1073741824 * 100) / 100 . ' GB';
        } elseif ($length >= 1048576) {
            $length = round($length / 1048576 * 100) / 100 . ' MB';
        } elseif ($length >= 1024) {
            $length = round($length / 1024 * 100) / 100 . ' KB';
        } else {
            $length = $length . ' Bytes';
        }

        return $length;
    }
}