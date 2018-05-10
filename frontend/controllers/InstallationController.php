<?php
/**
 * @Author: Hzhihua
 * @Time: 2017/10/21 11:55
 * @Email: cnzhihua@gmail.com
 */

namespace frontend\controllers;

use common\models\Installation;
use yii\web\Controller;

class InstallationController extends Controller
{
    public function actionIndex()
    {
        $data = Installation::find()->orderBy(['id' => SORT_DESC, 'updated_at' => SORT_DESC])->limit(1)->with('author')->asArray()->one();
        return $this->render('index', [
            'data' => $data,
        ]);
    }
}