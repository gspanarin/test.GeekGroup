<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Url;
use common\models\Comment;
use yii\bootstrap4\Modal;

?>
<div class="task-view">

    <h2>Перелік задач проекту</h2>

    
    
    
    <?php Pjax::begin([
        'id' => 'pjaxCommentList']); ?>
   
    <?= GridView::widget([
        'dataProvider' => $commentDataProvider,
        'filterModel' => $commentSearchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'user_id',
            //'project_id',
            //'task_id',
            'text:html',
            //'created_at',
            //'updated_at',
            //'version',
            [
                'class' => ActionColumn::className(),
                'buttons'=>[
                    'update'=>function ($url, $model) {                        
                        return Html::button('Редагувати', ['class' => 'btn btn-success', 'onclick' => 'modalLinkClick("' . Url::to('/admin/comment/ajax-update?id='.$model->id) . '");' ]);
                    },
                    'delete'=>function ($url, $model) {
                        return Html::button('Видалити', ['class' => 'btn btn-danger', 'onclick' => 'modalAxajDelete("' . Url::to('/admin/comment/ajax-delete?id='.$model->id) . '");' ]);    
                    },
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

    

    <?php 
    echo Html::button('Додати коментар', ['value' => Url::to(['comment/ajax-create', 'project_id' => $model->id, 'user_id' => Yii::$app->user->id]), 'class' => 'btn btn-success', 'id' => 'modalCommentButton',],);
  
    
    Modal::begin([
        'title' => '<h2>modal window</h2>',
        'id' => 'modalComment',
        'size' => 'modal-lg',
    ]);
    
    //$this->render('_tab_tasks_form', compact('task'));
    echo '<div id="modalContent" class="modalContent"></div>';
    
    Modal::end();
    
    
    ?>
    
    
    
</div>
