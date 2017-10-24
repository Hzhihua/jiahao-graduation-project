<?php
/**
 * @Author: Hzhihua
 * @Time: 2017/10/20 17:07
 * @Email: cnzhihua@gmail.com
 */

namespace frontend\models;

use Yii;

class UploadWorks
{
    /**
     * 移动上传的文件
     * return 0; 代表上传文件失败
     * @param string $rootdir 存放上传文件的根目录
     * @param array $extArray 允许上传的文件类型(后缀)
     * @return int 上传成功返回文件大小，上传失败返回0
     */
    public static function moveUploadFile($rootdir, $extArray=[])
    {
        if($_FILES['files']['error'] == 0){
            $rootdir = rtrim($rootdir, '/') . '/';
            $rootdir = Yii::getAlias($rootdir);
            $ext = self::getFileExtension($_FILES['files']['name']);

            // 判断文件上传类型是否允许
            if (! self::checkFileType($ext, $extArray)) {
                return 0;
            }

            // 创建新目录，按时间日期创建(eg: 2017-10-20)
            self::generateDirectory($rootdir);

            $post = Yii::$app->getRequest()->post();
            $dir = self::getNewDirectoryName();
            $fileName = self::getNewFileName($post['fileName']);
            $path = $rootdir . $dir . $fileName .'.'. $ext;

            // 上传中断重新上传
            if($post['first'] == 'true'){
                if (is_file($path)) {
                    unlink($path);
                }
            }

            if(!file_exists($path)) {
                move_uploaded_file($_FILES['files']['tmp_name'],$path);
            } elseif($post['fileSize'] > filesize($path)) {
                file_put_contents($path,file_get_contents($_FILES['files']['tmp_name']),FILE_APPEND);
            }

            /**
             * @see http://www.yiiframework.com/doc-2.0/guide-runtime-sessions-cookies.html
             */
            $session = Yii::$app->session;
            $session['file'] = [
                'name' => $post['originFileName'],
                'url' => $dir . $fileName .'.'. $ext,
            ];
            return $_FILES['files']['size'] ? $_FILES['files']['size'] : 0;  // 进度条数据
        }

        return 0;
    }

    /**
     * 检查上传的文件类型是否允许
     * @param string $ext 上传文件的后缀 (eg: .docx)
     * @param array $extArray 允许上传的文件后缀 (eg: ['.docx', '.doc', '.pdf'])
     * @return bool 文件类型匹配返回true，失败返回false
     */
    public static function checkFileType($ext, $extArray=[])
    {
        if (empty($extArray)) {
            return true;
        }

        return in_array($ext, $extArray);
    }

    /**
     * 获取新的文件名
     * @param string $time 上传所携带的时间戳
     * @return string 新的文件名
     */
    public static function getNewFileName($time)
    {
        return md5(date('His', $time));
    }

    /**
     * 获取文件后缀
     * @param $fileName
     * @return string 文件后缀名称,不包含"."
     */
    public static function getFileExtension($fileName)
    {
        return pathinfo($fileName, PATHINFO_EXTENSION); //文件后缀
    }

    /**
     * 获取新目录名称
     * @return null|string
     */
    public static function getNewDirectoryName()
    {
        static $dir = null;

        if (empty($dir)) {
            $dir = date('Ymd', $_SERVER['REQUEST_TIME']) . '/';
        }
        return $dir;
    }

    /**
     * 自动创建文件上传目录
     * @param string $rootdir 根目录路径
     * @return bool 创建成功返回true，创建不成功或者已经存在返回false
     */
    public static function generateDirectory($rootdir)
    {
        $dir = self::getNewDirectoryName();
        if(! is_dir($rootdir . $dir)){
           return mkdir($rootdir . $dir, 0755, true);
        }

        return false;
    }

    /**
     * 删除上传的文件
     * @param string $file 文件全路径，包括文件名
     * @return bool 成功true/失败false
     */
    public static function removeUploadFile($file)
    {
        if (empty($file)) {
            return false;
        }

        $file = Yii::getAlias($file);
        return unlink($file);
    }
}