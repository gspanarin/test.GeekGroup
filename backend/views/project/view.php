<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap4\Tabs;



use common\models\User;

/** @var yii\web\View $this */
/** @var backend\models\Project $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    
    
    
    <?= Tabs::widget([
                        'encodeLabels' => false,
                        'items' => [
                            [
                                'label' => Yii::t('backend', 'Картка проекту'),
                                'content' => $this->render('card', compact('model')),
                            ],
                            [
                                'label' => Yii::t('backend', 'Задачі проекту'),
                                'content' => $this->render('task/_tab_tasks', compact('model', 'taskDataProvider', 'taskSearchModel')),
                            ],
                            [
                                'label' => Yii::t('backend', 'Учасники проекту'),
                                'content' => $this->render('_tab_users', compact('model', 'userDataProvider', 'userSearchModel')),
                            ],
                            [
                                'label' => Yii::t('backend', 'Обговорення проекту'),
                                'content' => $this->render('comment/_tab_comments', compact('model', 'commentDataProvider', 'commentSearchModel')),
                            ],
                        ],
                    ]
                ) ?>
    
    
    
</div>
