<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string|null $title Назва проекту
 * @property string|null $desciption Опис проекту
 * @property int $status Статус проекту
 * @property date|null $start_date Дата початку роботи над проектом
 * @property date|null $finish_date Дата завершення роботи над проектом
 * @property int $creater_id Ідентифікатор користувача, який створив проект
 * @property int $created_at Дата створення проетку
 * @property int $updated_at Дата оновлення проекту
 * @property int|null $version Версія запису
 *
 * @property Comment[] $comments
 * @property OperationLog[] $operationLogs
 * @property Task[] $tasks
 */
class Project extends \yii\db\ActiveRecord{
    
    /*const STATUS_NEW = 0;
    const STATUS_IN_WORK = 1;
    const STATUS_PAUSE = 2;
    const STATUS_CLOSED = 3;
    const STATUS_FINISHED = 4;*/

    Private $StatusList = [
        0 => 'Новий',
        1 => 'Планування',
        2 => 'В роботі',
        3 => 'Закритий',
        4 => 'Завершений',
    ];
    
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(){
        return 'project';
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
            [['desciption'], 'string'],
            //[['status', 'start_date', 'finish_date', 'creater_id', 'created_at', 'updated_at', 'version'], 'integer'],
            [['status', 'creater_id', 'created_at', 'updated_at', 'version'], 'integer'],
            [['title', 'creater_id'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['start_date', 'finish_date', ], 'date', 'format' => 'php: Y-m-d'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(){
        return [
            'id' => Yii::t('common', 'ID'),
            'title' => Yii::t('common', 'Назва проекту'),
            'desciption' => Yii::t('common', 'Опис проекту'),
            'status' => Yii::t('common', 'Статус проекту'),
            'start_date' => Yii::t('common', 'Дата початку роботи над проектом'),
            'finish_date' => Yii::t('common', 'Дата завершення роботи над проектом'),
            'creater_id' => Yii::t('common', 'Ідентифікатор користувача, який створив проект'),
            'created_at' => Yii::t('common', 'Дата створення проетку'),
            'updated_at' => Yii::t('common', 'Дата оновлення проекту'),
            'version' => Yii::t('common', 'Версія запису'),
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments(){
        return $this->hasMany(Comment::class, ['project_id' => 'id']);
    }

    /**
     * Gets query for [[OperationLogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOperationLogs(){
        return $this->hasMany(OperationLog::class, ['project_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks(){
        return $this->hasMany(Task::class, ['project_id' => 'id']);
    }
    
    
    /*public function beforeSave($insert){
        $this->creater_id = Yii::$app->user->id;
        return parent::beforeSave($insert);
    }*/

    
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
