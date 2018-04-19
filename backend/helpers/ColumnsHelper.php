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
            ->select('url')
            ->where(['id' => (int) $picture_id])
            ->asArray()
            ->one();

        return static::getPictureHtml($data['url'], $option);
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
}