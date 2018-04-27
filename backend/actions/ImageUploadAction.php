<?php
/**
 * @Author: cnzhihua
 * @Date: 2018-04-23 18:39
 * @Github: https://github.com/Hzhihua
 */

namespace backend\actions;

use Yii;
use yii\base\Action;
use yii\db\ActiveRecord;
use yii\web\Response;
use common\components\Upload;

class ImageUploadAction extends Action
{
    /**
     * @var string
     */
    public $attribute;

    /**
     * @var ActiveRecord $model the data model
     */
    public $model = 'common\models\Picture';

    /**
     * @var string
     */
    public $uploadDirectory = '@backend/web/img/temp';

    /**
     * @var string
     */
    public $seeDirectory = '/img/temp';

    /**
     * 入口
     * return json
     */
    public function run()
    {
        try {
            Yii::$app->response->format = Response::FORMAT_JSON;

            $model = new Upload();
            $info = $model->upImage();

            if ($info && is_array($info)) {
                return $info;
            } else {
                return ['code' => 1, 'msg' => 'error'];
            }

        } catch (\Exception $e) {
            return ['code' => 1, 'msg' => $e->getMessage()];
        }
    }
}