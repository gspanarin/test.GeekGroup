<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use kartik\date\DatePicker;
//use yii\jui\DatePicker;
/** @var yii\web\View $this */
/** @var backend\models\Project $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'version')->hiddenInput() ?>
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desciption')->widget(TinyMce::className(), [
    'options' => ['rows' => 6],
    'language' => 'ru',
    'clientOptions' => [
        /*'plugins' => [
            'advlist autolink lists link charmap  print hr preview pagebreak',
            'searchreplace wordcount textcolor visualblocks visualchars code fullscreen nonbreaking',
            'save insertdatetime media table contextmenu template paste image'
        ],*/
        'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image'
    ]
]); ?>
    
    <?= $form->field($model, 'status')
        ->dropDownList(
            $model->getStatusList(),        
        ); 

?>

    
    <?= $form->field($model, 'start_date')->widget(DatePicker::className(), [
            'bsVersion' => '4',
            'language' => 'ua',
            'pluginOptions' => [
                'convertFormat' => true,
                'format' => 'yyyy-mm-dd'
            ],
        ]) ?>
    
    <?= $form->field($model, 'finish_date')->widget(DatePicker::className(), [
            'bsVersion' => '4',
            'language' => 'ua',
            'pluginOptions' => [
                'convertFormat' => true,
                'format' => 'yyyy-mm-dd'
            ],
        ]) ?>
    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
