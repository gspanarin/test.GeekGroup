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
<script src="/admin/assets/e322fbfc/tinymce.js"></script>
<div class="task-view">

    <h2>Перелік задач проекту</h2>
   
    <?php Pjax::begin([
        'id' => 'pjaxTaskList']); ?>
    <?php  echo $this->render('_search', ['model' => $taskSearchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $taskDataProvider,
        'filterModel' => $taskSearchModel,
        //'contentOptions' => ['style'=>'white-space: wrap;'],
        'options' => ['white-space' => 'wrap'], 
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
                'filter'=>$model->getStatusList(),
                //TODO
                //Підібрати кольори для виділення статусів задач
                //Можливо має сенс виділяти не текст, а фон комірки
                /*'contentOptions' => function($model){
                    switch ($model->status) {
                        case 1:
                            $style = ['style' => 'width: 65px; color:yellow;' ];
                            break;
                        case 2:
                            $style = ['style' => 'width: 65px; color:green;' ];
                            break;
                        case 3:
                            $style = ['style' => 'width: 65px; color:blue;' ];
                            break;
                        case 4:
                            $style = ['style' => 'width: 65px; color:black;' ];
                            break;
                        default:
                            $style = [];
                            break;
                    }; 
                    return $style;
                },*/
            ],
            'title',
            'desciption:html',
            [
                'attribute' => 'start_date',
                //'options' => ['style' => 'width: 65px; color:red; '],
                'contentOptions' => ['style' => 'width: 65px; color:red;' ],     
            ],
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
        'title' => '<h2>Задача поточного проекту</h2>',
        'id' => 'modal',
        'size' => 'modal-lg',
    ]);
    
    //$this->render('_tab_tasks_form', compact('task'));
    echo '<div id="modalContent" class="modalContent"></div>';
    
    Modal::end();
?>
    
    
    
</div>
