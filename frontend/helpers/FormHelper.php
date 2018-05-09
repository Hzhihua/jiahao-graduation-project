<?php
/**
 * @Author: cnzhihua
 * @Date: 2018-05-09 22:52
 * @Github: https://github.com/Hzhihua
 */

namespace frontend\helpers;

use common\models\StudentClass;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

class FormHelper extends \backend\helpers\FormHelper
{
    /**
     * @param ActiveForm $form
     * @param $model
     * @param string $attribute
     * @param array $data
     * @param array $clientOptions
     * @return string
     */
    public static function studenClassSelectize(ActiveForm $form, $model, $attribute, array $clientOptions = [])
    {
        $data = ArrayHelper::map(StudentClass::find()->asArray()->all(), 'id', 'class_name');
        return $form->field($model, $attribute)->widget('dosamigos\selectize\SelectizeDropDownList', [
            'name' => $attribute,
            'items' => $data,
            'clientOptions' => $clientOptions,
        ]);
    }

}