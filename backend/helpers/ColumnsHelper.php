<?php
/**
 * @Author: cnzhihua
 * @Date: 2018-04-19 16:42
 * @Github: https://github.com/Hzhihua
 */

namespace backend\helpers;

use Yii;
use yii\helpers\Html;
use common\models\File;
use common\models\Picture;
use common\models\Author;
use common\models\StudentClass;

class ColumnsHelper
{
    /**
     * @param $timestamp
     * @param string $format
     * @return false|string
     */
    public static function date($timestamp, $format = 'Y-m-d H:i:s')
    {
        return date($format, $timestamp);
    }

    /**
     * @param string $string
     * @return string
     */
    public static function htmlEncode($string)
    {
        return Html::encode($string);
    }

    /**
     * @param int $authorId
     * @return string
     */
    public static function getAuthorNameById($authorId)
    {
        $data = Author::find()
            ->select('name')
            ->where(['id' =>(int) $authorId])
            ->asArray()
            ->one();

        return static::htmlEncode($data['name']);
    }

    /**
     * @param $url
     * @param array $option
     * @return string
     */
    public static function getPictureHtml($url, $option = [])
    {
        isset($option['alt']) || $option['alt'] = Yii::t('backend', 'Loading picture failed');
        isset($option['width']) || $option['width'] = 150;

        return Html::img($url, $option);
    }

    /**
     * @param int $picture_id
     * @param array $option
     * @return string
     */
    public static function getPictureHtmlById($picture_id, $option = [])
    {
        $data = Picture::find()
            ->select(['new_name', 'new_directory','extension'])
            ->where(['id' => (int) $picture_id])
            ->asArray()
            ->one();
        if ($data) {
            $url = sprintf(
                '%s%s/%s.%s',
                dirname($_SERVER['PHP_SELF']).'/img/temp/',
                $data['new_directory'],
                $data['new_name'],
                $data['extension']
            );
        } else {
            $url = 'javascript:;';
        }


        return static::getPictureHtml($url, $option);
    }

    /**
     * @param string $file_name
     * @param string $file_url
     * @param array $option
     * @return string
     */
    public static function getFileHtml($file_name, $file_url, $option = [])
    {
        $option['download'] = $file_name;

        return Html::a($file_name, $file_url, $option);
    }

    /**
     * @param int $file_id
     * @param array $option
     * @return string
     */
    public static function getFileHtmlById($file_id, $option = [])
    {
        $data = File::find()
            ->select(['name', 'url'])
            ->where(['id' => (int) $file_id])
            ->asArray()
            ->one();

        return static::getFileHtml($data['name'], $data['url'], $option);
    }

    /**
     * @param int $size
     * @return string
     */
    public static function formatBytes($size)
    {
        $size = (int) $size;

        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        for ($i = 0; $size >= 1024 && $i < 4; $i++) $size /= 1024;

        return sprintf('%.2f %s',
            round($size, 2),
            $units[$i]
        );
    }

    /**
     * @param string $name
     * @param string $url
     * @param array $option
     * @return string
     */
    public static function links($name, $url, $option = [])
    {
        return Html::a($name, $url, $option);
    }

    /**
     * @param int $student_class_id
     * @return string
     */
    public static function getStudentClassNameById($student_class_id)
    {
        $data = StudentClass::find()
            ->select('class_name')
            ->where(['id' => (int) $student_class_id])
            ->asArray()
            ->one();

        return static::htmlEncode($data['class_name']);
    }
}