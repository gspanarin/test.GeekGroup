<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string|null $title Назва проекту
 * @property string|null $desciption Опис проекту
 * @property int $status Статус проекту
 * @property int|null $start_date Дата початку роботи над проектом
 * @property int|null $finish_date Дата завершення роботи над проектом
 * @property int $creater_id Ідентифікатор користувача, який створив проект
 * @property int $created_at Дата створення проетку
 * @property int $updated_at Дата оновлення проекту
 * @property int|null $version Версія запису
 *
 * @property Comment[] $comments
 * @property OperationLog[] $operationLogs
 * @property Task[] $tasks
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['desciption'], 'string'],
            [['status', 'start_date', 'finish_date', 'creater_id', 'created_at', 'updated_at', 'version'], 'integer'],
            [['creater_id', 'created_at', 'updated_at'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'title' => Yii::t('backend', 'Назва проекту'),
            'desciption' => Yii::t('backend', 'Опис проекту'),
            'status' => Yii::t('backend', 'Статус проекту'),
            'start_date' => Yii::t('backend', 'Дата початку роботи над проектом'),
            'finish_date' => Yii::t('backend', 'Дата завершення роботи над проектом'),
            'creater_id' => Yii::t('backend', 'Ідентифікатор користувача, який створив проект'),
            'created_at' => Yii::t('backend', 'Дата створення проетку'),
            'updated_at' => Yii::t('backend', 'Дата оновлення проекту'),
            'version' => Yii::t('backend', 'Версія запису'),
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['project_id' => 'id']);
    }

    /**
     * Gets query for [[OperationLogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOperationLogs()
    {
        return $this->hasMany(OperationLog::class, ['project_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::class, ['project_id' => 'id']);
    }
}
