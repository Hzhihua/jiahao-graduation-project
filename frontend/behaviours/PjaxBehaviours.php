<?php
/**
 * @Author: Hzhihua
 * @Time: 17-10-24 下午7:21
 * @Email: cnzhihua@gmail.com
 */

namespace frontend\behaviours;

use Yii;
use yii\base\ActionFilter;

/**
 * Class PjaxBehaviours
 *
 * @package frontend\behaviours
 */
class PjaxBehaviours extends ActionFilter
{
    public function beforeAction($action)
    {
        if (! parent::beforeAction($action)) {
            return false;
        }

        if (Yii::$app->getRequest()->isPjax) {
            Yii::$app->controller->layout = 'content';
        }
        return true;
    }
}