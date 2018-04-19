<?php
/**
 * @Date: 2018/04/06 16:47
 * @Github: https://github.com/Hzhihua/jiahao-graduation-project.git
 */

use yii\helpers\Url;

?>

<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

    <div class="menu_section">
        <h3>General</h3>
        <?=
        \yiister\gentelella\widgets\Menu::widget(
            [
                "items" => [
                    ["label" => "公告管理", "url" => Url::to(["/announcement"]), "icon" => "cog"],
                    ["label" => "文件管理", "url" => Url::to(["/file"]), "icon" => "file-code-o"],
                    ["label" => "图片管理", "url" => Url::to(["/picture"]), "icon" => "file-photo-o"],
                    ["label" => "滚图管理", "url" => Url::to(["/rolling-map"]), "icon" => "file-image-o"],
//                    ["label" => "用户管理", "url" => Url::to(["/user"]), "icon" => "user"],
                    ["label" => "环境介绍", "url" => Url::to(["/environment"]), "icon" => "cog"],
                    ["label" => "安装介绍", "url" => Url::to(["/installation"]), "icon" => "institution"],
                    ["label" => "仿真介绍", "url" => Url::to(["/simulation"]), "icon" => "cog"],
                    ["label" => "上传作业", "url" => Url::to(["/upload-work"]), "icon" => "book"],
                    ["label" => "学生班级", "url" => Url::to(["/student-class"]), "icon" => "address-book"],
                    ["label" => "友情链接", "url" => Url::to(["/links"]), "icon" => "link"],
                ],
            ]
        )
        ?>
    </div>

</div>
<!-- /sidebar menu -->
