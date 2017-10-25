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
$js = <<<JS
$(function(){
    $('#upload').html5SliceUpload({
      ajax_timeout: 60000,
      url:'{$url}',
      _csrf: '{$_csrf}',
      buttonText:'选择/拖拽文件上传({$ext})',
      onNumEnough: function(num){
        alert('超过文件上传数量限制: '+num);
      }
    });
});
JS;

// 显示一个额外的信息，如提交成功，上传文件未选择
$js .= $message;

// 注册js
$this->registerJs($js);

?>

<!-- content srart -->
<div class="am-g am-g-fixed blog-fixed blog-content">
    <div class="am-u-sm-12">
        <article class="am-article blog-article-p">
            <form action="<?= Url::to(['/upload-works/post']) ?>" method="post">
                <input type="hidden" name="<?= Yii::$app->getRequest()->csrfParam ?>" value="<?= Yii::$app->getRequest()->csrfToken ?>">
                姓名：<input type="text" name="form[student_name]"><br />
                班级：
                <select name="form[student_class_id]">
                    <option value="">请选择班级</option>
                    <?php foreach ($studentClass as $value): ?>
                        <option value="<?= $value['id']; ?>"><?= $value['class_name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <br />
                <div class="am-article-hd">
                    <div id="dropFile"><div id="upload"></div></div>
                    <ol id="showFileList"></ol>
                    <input type="submit" value="上传时禁用">
                </div>
            </form>
        </article>
    </div>
</div>
<!-- content end -->
