<?php
/**
 * @Author: Hzhihua
 * @Time: 2017/10/20 15:34
 * @Email: cnzhihua@gmail.com
 */

namespace frontend\controllers;

use common\models\Installation;
use common\models\Links;
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
    /**
     * @return string
     */
    public function actionIndex()
    {
        $links = static::getLinks();
        $picture = static::getRollingMap();
        $announcement = static::getAnnouncement();
        $installation = static::getInstallation();

        return $this->render('index', [
            'data' => [
                'links' => $links,
                'rollingMap' => $picture, // 轮播图
                'announcement' => $announcement,
                'installation' => $installation,
            ],
        ]);
    }

    /**
     * 获取轮播图
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getRollingMap()
    {
        return RollingMap::find()->orderBy(['id' => SORT_DESC, 'updated_at' => SORT_DESC])->limit(5)->with('picture')->asArray()->all();
    }

    /**
     * 获取公告内容
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getAnnouncement()
    {
//        $paseSize = Yii::$app->params['AnnouncementPageSize'];
//        $page = (int)$page < 1 ? 1 : $page;
//        $offset = ($page - 1) * $paseSize;
//        $end = $page * $paseSize;

        return Announcement::find()->orderBy(['id' => SORT_DESC, 'updated_at' => SORT_DESC])->limit(1)->with('author', 'picture')->asArray()->one();
    }

    /**
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function getInstallation()
    {
        $data =  Installation::find()->orderBy(['id' => SORT_DESC, 'updated_at' => SORT_DESC])->limit(1)->with('author')->asArray()->one();
        if ($data)
            $data['description'] = mb_substr(strip_tags($data['content']), 0, 250, 'utf-8');

        return $data;
    }

    /**
     * 获取友情链接
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getLinks()
    {
        return Links::find()->orderBy(['id' => SORT_DESC, 'updated_at' => SORT_DESC])->asArray()->all();
    }
}