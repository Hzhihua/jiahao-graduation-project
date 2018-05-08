<?php
/**
 * @Author: Hzhihua
 * @Time: 2017/10/24 2:55
 * @Email: cnzhihua@gmail.com
 */

namespace frontend\controllers;

use common\models\Announcement;
use yii\web\Controller;

class AnnouncementController extends Controller
{

    public function actionIndex()
    {
        $data = Announcement::find()->with('author', 'picture')->asArray()->all();
        return $this->render('index', [
            'data' => $data,
        ]);
    }


    /**
     * 根据 id 显示具体的公告内容
     * @param int $pk
     * @return string 具体的公告内容
     */
    public function actionView($pk)
    {
        $pk = (int)$pk;
        $data = Announcement::find()->where($pk)->with('author', 'picture')->asArray()->one();
        return $this->render('view', [
            'data' => $data,
        ]);
    }

    // 显示搜索的内容
    public function actionSearch($q)
    {
        echo $q;
    }

}