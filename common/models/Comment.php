<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property int $user_id Автор коментаря
 * @property int|null $project_id Ідентифікатор проекту
 * @property int|null $task_id Ідентифікатор задачі
 * @property string|null $text Текст коментаря
 * @property int $created_at Дата створення коментаря
 * @property int $updated_at Дата оновлення коментаря
 * @property int|null $version Версія запису
 *
 * @property File[] $files
 * @property OperationLog[] $operationLogs
 * @property Project $project
 * @property Task $task
 * @property User $user
 */
class Comment extends \yii\db\ActiveRecord{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName(){
        return 'comment';
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
            [['user_id', ], 'required'],
            [['user_id', 'project_id', 'task_id', 'created_at', 'updated_at', 'version'], 'integer'],
            [['text'], 'string'],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::class, 'targetAttribute' => ['project_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::class, 'targetAttribute' => ['task_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(){
        return [
            'id' => Yii::t('backend', 'ID'),
            'user_id' => Yii::t('backend', 'Автор коментаря'),
            'project_id' => Yii::t('backend', 'Ідентифікатор проекту'),
            'task_id' => Yii::t('backend', 'Ідентифікатор задачі'),
            'text' => Yii::t('backend', 'Текст коментаря'),
            'created_at' => Yii::t('backend', 'Дата створення коментаря'),
            'updated_at' => Yii::t('backend', 'Дата оновлення коментаря'),
            'version' => Yii::t('backend', 'Версія запису'),
        ];
    }

    /**
     * Gets query for [[Files]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFiles(){
        return $this->hasMany(File::class, ['comment_id' => 'id']);
    }

    /**
     * Gets query for [[OperationLogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOperationLogs(){
        return $this->hasMany(OperationLog::class, ['comment_id' => 'id']);
    }

    /**
     * Gets query for [[Project]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProject(){
        return $this->hasOne(Project::class, ['id' => 'project_id']);
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask(){
        return $this->hasOne(Task::class, ['id' => 'task_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser(){
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
