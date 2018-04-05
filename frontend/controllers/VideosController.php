<?php
/**
 * @Author: cnzhihua
 * @Time: 18-3-1 20:21
 * @Github: https://github.com/Hzhihua
 */

namespace frontend\controllers;

use yii\web\Controller;

class VideosController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView()
    {
        return $this->render('view');
    }
}