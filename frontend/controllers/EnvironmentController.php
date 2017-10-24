<?php
/**
 * @Author: Hzhihua
 * @Time: 2017/10/21 11:55
 * @Email: cnzhihua@gmail.com
 */

namespace frontend\controllers;

use common\models\Environment;
use yii\web\Controller;

class EnvironmentController extends Controller
{
    public function actionIndex()
    {
        $data = Environment::find()->limit(1)->with('author')->asArray()->one();

        return $this->render('index', [
            'data' => $data,
        ]);
    }
}