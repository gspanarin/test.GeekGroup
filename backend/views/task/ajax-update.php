<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use kartik\date\DatePicker;
use yii\bootstrap4\Tabs;

?>
<div class="task-update">

    <h2><?= Html::encode($model->title) ?></h2>

    <?= Tabs::widget([
            'encodeLabels' => false,
            'items' => [
                [
                    'label' => Yii::t('backend', 'Картка задачі'),
                    'content' => $this->render('_ajax_form', ['model' => $model,]),
                ],
                [
                    'label' => Yii::t('backend', 'Обговорення'),
                    'content' => $this->render('_ajax_comment_form', ['model' => $model,]),
                ],

            ],
        ]
    ) ?>

    
</div>

