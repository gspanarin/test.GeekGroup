<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;

?>
<div class="project-view">

    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'title',
            'desciption:html',
            // TODO
            //Додати розшифровку статусів
            [
                'attribute' => 'status',
                'value' => $model->getStatusName(),
            ],
            'start_date',
            'finish_date',
            [
                'label' => 'Автор проекту',
                'value' => User::findOne(['id' => $model->creater_id])->username,
            ],
            
            'created_at:datetime',
            'updated_at:datetime',
            //'version',
        ],
    ]) ?>

    
    
</div>
