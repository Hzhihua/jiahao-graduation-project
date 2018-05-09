<?php
/**
 * @Author: Hzhihua
 * @Time: 2017/10/20 16:54
 * @Email: cnzhihua@gmail.com
 */
/* @var string $message */
/* @var $this \yii\web\View*/
/* @var array $studentClass */
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use frontend\helpers\FormHelper;
//use frontend\assets\UploadWorksAsset;

// 注册静态文件
//UploadWorksAsset::register($this);
\frontend\assets\AppAsset::register($this);
$this->title = '作业提交';

$params = Yii::$app->params;
//$ext = implode($params['uploadFileExtension'], '/');
//$url = Url::to(['/upload-works/upload']);
//$_csrf = Yii::$app->getRequest()->csrfToken;

?>

<!-- content start -->
<div class="am-g am-g-fixed blog-fixed blog-content" data-pjax=0>
    <div class="am-u-sm-12">
        <article class="am-article blog-article-p">
            <?php $form = ActiveForm::begin(['action' => Url::to(['create'])]); ?>

            <?= $form->field($model, 'student_name')->textInput(['maxlength' => true]) ?>

            <?= FormHelper::studenClassSelectize($form, $model, 'student_class_id') ?>

            <?= FormHelper::MediaUpload($form, $model, 'file_id') ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </article>
    </div>
</div>
<!-- content end -->
