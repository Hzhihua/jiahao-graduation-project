<?php

namespace common\models;

use PDOException;
use yii\base\Model;
/**
 * This is the model class for table "{{%upload_work}}".
 *
 * @property int $id
 * @property int $file_id 上传文件ID
 * @property string $student_name 学生名称
 * @property string $student_class_id 学生班级ID
 * @property string $created_at 创建时间
 * @property string $updated_at 修改时间
 */
class UploadWork extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%upload_work}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file_id', 'student_name', 'student_class_id', 'created_at', 'updated_at'], 'required'],
            [['file_id', 'student_class_id'], 'integer'],
            [['created_at', 'updated_at'], 'integer'],
            [['student_name'], 'filter', 'filter' => 'trim'],
            [['student_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return array_merge(Model::scenarios(), [
            'insert' => [
                'file_id',
                'student_name',
                'student_class_id',
            ],
            'update' => [
                'file_id',
                'student_name',
                'student_class_id',
            ],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file_id' => '上传文件ID',
            'student_name' => '学生名称',
            'student_class_id' => '学生班级ID',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
        ];
    }

    /**
     * 在数据添加之前调用
     * @param \yii\base\ModelEvent $event
     * @return bool
     */
    public function beforeInsert($event)
    {
        if (! parent::beforeInsert($event)) {
            return $event->isValid = false;
        }

        // 判断 file_id 是否存在
        if (! self::findFileById($this->file_id)) {
            throw new PDOException('File ID('.$this->file_id.') could not be found in '.File::tableName().' table');
        }

        // 判断 student_class_id 是否存在
        if (! self::findStudentClassById($this->student_class_id)) {
            throw new PDOException('StudentClass ID('.$this->student_class_id.') could not be found in '.StudentClass::tableName().' table');
        }

        return $event->isValid;
    }

    /**
     * 在数据修改之前调用
     * @param \yii\base\ModelEvent $event
     * @return bool
     */
    public function beforeUpdate($event)
    {
        if (! parent::beforeUpdate($event)) {
            return $event->isValid = false;
        }

        // 判断 file_id 是否存在
        if (! self::findFileById($this->file_id)) {
            throw new PDOException('File ID('.$this->file_id.') could not be found in '.File::tableName().' table');
        }

        // 判断 student_class_id 是否存在
        if (! self::findStudentClassById($this->student_class_id)) {
            throw new PDOException('StudentClass ID('.$this->student_class_id.') could not be found in '.StudentClass::tableName().' table');
        }

        return $event->isValid;
    }

    /**
     * 判断 file_id 是否存在
     * @param int $fileId
     * @return File|null
     */
    public static function findFileById($fileId)
    {
        return File::findOne($fileId);
    }

    /**
     * 判断 student_class_id 是否存在
     * @param int $student_class_id
     * @return StudentClass|null
     */
    public static function findStudentClassById($student_class_id)
    {
        return StudentClass::findOne($student_class_id);
    }

    /**
     * 与 file 表一对一关系
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        // id 是 file 表的 id
        return $this->hasOne(File::class, ['id' => 'file_id']);
    }

    /**
     * 与 student_class_id 表一对一关系
     * @return \yii\db\ActiveQuery
     */
    public function getStudentClass()
    {
        // id 是 student_class_id 表的 id
        return $this->hasOne(StudentClass::class, ['id' => 'student_class_id']);
    }

}
