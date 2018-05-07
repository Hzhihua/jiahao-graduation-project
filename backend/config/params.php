<?php
return [
    'adminEmail' => 'admin@example.com',

    // 图片服务器的域名设置，拼接保存在数据库中的相对地址，可通过web进行展示
    'domain' => dirname($_SERVER['PHP_SELF']) . '/',
    'imageUploadRelativePath' => './img/temp/', // 图片默认上传的目录
    'imageUploadSuccessPath' => 'img/temp/', // 图片上传成功后，路径前缀
];
