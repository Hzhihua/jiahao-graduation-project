<?php
/**
 * @Author: cnzhihua
 * @Time: 18-3-1 20:21
 * @Github: https://github.com/Hzhihua
 */

namespace frontend\controllers;

use common\models\Media;
use Yii;
use yii\web\Controller;

class VideosController extends Controller
{
    public function actionIndex()
    {
        $data = Media::find()->orderBy(['id' => SORT_DESC])->asArray()->all();
        return $this->render('index', [
            'data' => $data,
        ]);
    }

    public function actionView()
    {
        $file_key = Yii::$app->request->get('id');
        $data = Media::find()->where(['file_key' => $file_key])->asArray()->one();
        return $this->render('view', [
            'data' => $data,
        ]);
    }
}