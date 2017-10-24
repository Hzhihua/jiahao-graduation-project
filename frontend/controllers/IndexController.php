<?php
/**
 * @Author: Hzhihua
 * @Time: 2017/10/20 15:34
 * @Email: cnzhihua@gmail.com
 */

namespace frontend\controllers;

use Yii;
use common\models\Announcement;
use common\models\RollingMap;
use yii\web\Controller;

/**
 * Class IndexController
 * 网站首页
 *
 * @package frontend\controllers
 * @Author Hzhihua <cnzhihua@gmail.com>
 */
class IndexController extends Controller
{

    /**
     * 网站首页
     */
    public function actionIndex()
    {
        $picture = $this->getRollingMap();
        $announcement = $this->getAnnouncement(Yii::$app->getRequest()->get('page'));

        return $this->render('index', [
            'data' => [
                'rollingMap' => $picture, // 轮播图
                'announcement' => $announcement,
            ],
        ]);
    }

    /**
     * 获取轮播图
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getRollingMap()
    {
        return RollingMap::find()->orderBy(['updated_at' => SORT_DESC])->limit(5)->with('picture')->asArray()->all();
    }

    /**
     * 获取公告内容
     * @param $page
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getAnnouncement($page)
    {
        $page = (int)$page < 1 ? 1 : $page;
        $offset = ($page - 1) * 7;
        $end = $page * 7;

        return Announcement::find()->orderBy(['updated_at' => SORT_DESC])->offset($offset)->limit($end)->with('author', 'picture')->asArray()->all();
    }

    public function actionCreate()
    {

        $model = new Announcement();
        $_POST['Announcement']['id'] = 3;
        $_POST['Announcement']['title'] = '这是标题';
        $_POST['Announcement']['author_id'] = '1';
        $_POST['Announcement']['picture_id'] = '1';
        $_POST['Announcement']['description'] = '这是描述';
        $_POST['Announcement']['content'] = '这是内容';
        $_POST['Announcement']['created_at'] = 'asdhaoisd';
        $_POST['Announcement']['updated_at'] = 'fasqwsd';

        if ($model->load($_POST) && $model->save()) {
            echo '1';
        } else {
            echo '0';
            var_dump($model->getErrors());
        }
    }

    public function actionUpdate()
    {

        $model = new Announcement();
        $_POST['Announcement']['id'] = 3;
        $_POST['Announcement']['title'] = '这是标题';
        $_POST['Announcement']['author_id'] = '1';
        $_POST['Announcement']['picture_id'] = '1';
        $_POST['Announcement']['description'] = '这是描述';
        $_POST['Announcement']['content'] = '这是内容';
        $_POST['Announcement']['created_at'] = 'asdfi';
        $_POST['Announcement']['updated_at'] = 'asdfui1';

        $model->oldAttributes = ['id' => 3, 'title' => '123'];
        if ($model->load($_POST) && $model->save()) {
            echo '1';
        } else {
            echo '0';
            var_dump($model->getErrors());
        }
    }
}