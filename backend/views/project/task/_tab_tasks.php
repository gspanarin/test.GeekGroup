<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Url;
use common\models\Task;
use yii\bootstrap4\Modal;
use dosamigos\tinymce\TinyMce;


/** @var yii\web\View $this */
/** @var common\models\Task $model */

?>
<div class="task-view">

    <h2>Перелік задач проекту</h2>

    <?php Pjax::begin([
        'id' => 'pjaxTaskList']); ?>
    <?php  echo $this->render('_search', ['model' => $taskSearchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $taskDataProvider,
        'filterModel' => $taskSearchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            //'project_id',
            //'user_id',
            [
                'attribute' => 'status',
                'value' => function($model){
                    return $model->getStatusName();
                },
            ],
            'title',
            'desciption:html',
            'start_date',
            'finish_date',
            //'creater_id',
            //'created_at',
            //'updated_at',
            //'version',
            [
                'class' => ActionColumn::className(),
                'buttons'=>[
                    'update'=>function ($url, $model) {                        
                        return Html::button('Редагувати', ['class' => 'btn btn-success', 'onclick' => 'modalLinkClick("' . Url::to('/admin/task/ajax-update?id='.$model->id) . '");' ]);
                    },
                    'delete'=>function ($url, $model) {
                        return Html::button('Видалити', ['class' => 'btn btn-danger', 'onclick' => 'modalAxajDelete("' . Url::to('/admin/task/ajax-delete?id='.$model->id) . '");' ]);    
                    },
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

    

    <?php 
    echo Html::button('Створити нову задачу', ['value' => Url::to(['task/ajax-create', 'project_id' => $model->id, 'creater_id' => Yii::$app->user->id]), 'class' => 'btn btn-success', 'id' => 'modalButton',],);
    
    Modal::begin([
        'title' => '<h2>modal window</h2>',
        'id' => 'modal',
        'size' => 'modal-lg',
    ]);
    
    //$this->render('_tab_tasks_form', compact('task'));
    echo '<div id="modalContent" class="modalContent"></div>';
    
    Modal::end();
?>
    
    
    
</div>
