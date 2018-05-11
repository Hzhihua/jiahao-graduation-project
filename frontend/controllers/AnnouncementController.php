<?php
/**
 * @Author: Hzhihua
 * @Time: 2017/10/24 2:55
 * @Email: cnzhihua@gmail.com
 */

namespace frontend\controllers;

use yii\web\Controller;
use common\models\File;
use common\models\Announcement;

class AnnouncementController extends Controller
{
    public function actions()
    {
        return array_merge(parent::actions(), [
            'file-download' => [
                'class' => 'hzhihua\actions\FileDownloadAction',
                'on beforeDownload' => [new File(), 'beforeFileDownload'],
//                'responseFormat' => 'json',
            ],
        ]);
    }

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
        $data = Announcement::find()->where(['id' => $pk])->with('author', 'file')->asArray()->one();
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