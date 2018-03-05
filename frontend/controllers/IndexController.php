<?php
/**
 * @Author: Hzhihua
 * @Time: 2017/10/20 15:34
 * @Email: cnzhihua@gmail.com
 */

namespace frontend\controllers;

use common\models\Links;
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
        $links = self::getLinks();
        $picture = self::getRollingMap();
        $announcement = self::getAnnouncement(Yii::$app->getRequest()->get('page'));

        return $this->render('index', [
            'data' => [
                'links' => $links,
                'rollingMap' => $picture, // 轮播图
                'announcement' => $announcement,
            ],
        ]);
    }

    /**
     * 获取轮播图
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getRollingMap()
    {
        return RollingMap::find()->orderBy(['updated_at' => SORT_DESC])->limit(5)->with('picture')->asArray()->all();
    }

    /**
     * 获取公告内容
     * @param $page
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getAnnouncement($page)
    {
        $paseSize = Yii::$app->params['AnnouncementPageSize'];
        $page = (int)$page < 1 ? 1 : $page;
        $offset = ($page - 1) * $paseSize;
        $end = $page * $paseSize;

        return Announcement::find()->orderBy(['updated_at' => SORT_DESC])->offset($offset)->limit($end)->with('author', 'picture')->asArray()->all();
    }

    /**
     * 获取友情链接
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getLinks()
    {
        return Links::find()->orderBy(['updated_at' => SORT_DESC])->asArray()->all();
    }
}