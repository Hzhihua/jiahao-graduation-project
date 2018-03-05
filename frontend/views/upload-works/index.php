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
use frontend\assets\UploadWorksAsset;

// 注册静态文件
UploadWorksAsset::register($this);
$this->title = '作业提交';

$params = Yii::$app->params;
$ext = implode($params['uploadFileExtension'], '/');
$url = Url::to(['/upload-works/upload']);
$_csrf = Yii::$app->getRequest()->csrfToken;
$tip = Yii::t('frontend', 'Select or Drag file to upload');
$uploadTip = Yii::t('frontend', 'Exceeded file upload limit');
$js = <<<JS
$(function(){
    $('#upload').html5SliceUpload({
      ajax_timeout: 60000,
      url:'{$url}',
      _csrf: '{$_csrf}',
      buttonText:'{$tip}({$ext})',
      onNumEnough: function(num){
        alert('{$uploadTip}: '+num);
      }
    });
});
JS;

// 显示一个额外的信息，如提交成功，上传文件未选择
$js .= $message;

// 注册js
$this->registerJs($js);

?>

<!-- content start -->
<div class="am-g am-g-fixed blog-fixed blog-content">
    <div class="am-u-sm-12">
        <article class="am-article blog-article-p">
            <form action="<?= Url::to(['/upload-works/post']) ?>" method="post">
                <input type="hidden" name="<?= Yii::$app->getRequest()->csrfParam ?>" value="<?= Yii::$app->getRequest()->csrfToken ?>">
                <?= Yii::t('frontend', 'Student\'s Name') ?>：<input type="text" name="form[student_name]"><br />
                <?= Yii::t('frontend', 'Class') ?>：
                <select name="form[student_class_id]">
                    <option value=""><?= Yii::t('frontend', 'Please select a class') ?></option>
                    <?php foreach ($studentClass as $value): ?>
                        <option value="<?= $value['id']; ?>"><?= $value['class_name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <br />
                <div class="am-article-hd">
                    <div id="dropFile"><div id="upload"></div></div>
                    <ol id="showFileList"></ol>
                    <input type="submit" value="提交">
                </div>
            </form>
        </article>
    </div>
</div>
<!-- content end -->
