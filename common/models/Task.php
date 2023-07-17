<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property int $project_id Ідентифікатор проекту
 * @property int $user_id Користувач, відповідальний за задачу
 * @property int $status Статус задачі
 * @property string|null $title Назва задачі
 * @property string|null $desciption Опис задачі
 * @property int|null $start_date Дата початку роботи над задачею
 * @property int|null $finish_date Дата завершення роботи над задачею
 * @property int $creater_id Ідентифікатор користувача, який створив задачу
 * @property int $created_at Дата створення задачі
 * @property int $updated_at Дата оновлення задачі
 * @property int|null $version Версія запису
 *
 * @property Comment[] $comments
 * @property OperationLog[] $operationLogs
 * @property Project $project
 */
class Task extends \yii\db\ActiveRecord{
    
    Private $StatusList = [
        0 => 'Нова',
        1 => 'Планується',
        2 => 'В роботі',
        3 => 'Закрита',
        4 => 'Завершена',
    ];
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(){
        return 'task';
    }
    
    public function optimisticLock() {
        return 'version';
    }

    
    public function behaviors(){
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }
    
    
    /**
     * {@inheritdoc}
     */
    public function rules(){
        return [
            [['project_id'], 'required'],
            [['project_id', 'user_id', 'status', 'creater_id', 'created_at', 'updated_at', 'version'], 'integer'],
            [['desciption'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::class, 'targetAttribute' => ['project_id' => 'id']],
            [['start_date', 'finish_date', ], 'date', 'format' => 'php: Y-m-d'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(){
        return [
            'id' => Yii::t('backend', 'ID'),
            'project_id' => Yii::t('backend', 'Ідентифікатор проекту'),
            'user_id' => Yii::t('backend', 'Користувач, відповідальний за задачу'),
            'status' => Yii::t('backend', 'Статус задачі'),
            'title' => Yii::t('backend', 'Назва задачі'),
            'desciption' => Yii::t('backend', 'Опис задачі'),
            'start_date' => Yii::t('backend', 'Дата початку роботи над задачею'),
            'finish_date' => Yii::t('backend', 'Дата завершення роботи над задачею'),
            'creater_id' => Yii::t('backend', 'Ідентифікатор користувача, який створив задачу'),
            'created_at' => Yii::t('backend', 'Дата створення задачі'),
            'updated_at' => Yii::t('backend', 'Дата оновлення задачі'),
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
        return $this->hasMany(Comment::class, ['task_id' => 'id']);
    }

    /**
     * Gets query for [[OperationLogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOperationLogs()
    {
        return $this->hasMany(OperationLog::class, ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Project]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::class, ['id' => 'project_id']);
    }
    
    
    public function getStatusList(){
        return $this->StatusList;
    }
    
    
    public function getStatus(){
        return $this->status;
    }
    
    
    public function getStatusName(){
        return $this->StatusList[$this->status];
    }
}
