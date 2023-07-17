<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use kartik\date\DatePicker;

?>
<div class="task-create">

    <h1><?= Html::encode($this->title) ?></h1>


    
    <?php $form = ActiveForm::begin([
        'id' => 'ajax-form',
        'action' => '/admin/task/ajax-create?project_id=' . $model->project_id . '&creater_id=' . $model->creater_id,
    ]); ?>
    <?= $form->field($model, 'version')->hiddenInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desciption')->widget(TinyMce::className(), [
    'options' => ['rows' => 6],
    'language' => 'ru',
    'clientOptions' => [
        'plugins' => [
            'advlist autolink lists link charmap  print hr preview pagebreak',
            'searchreplace wordcount textcolor visualblocks visualchars code fullscreen nonbreaking',
            'save insertdatetime media table contextmenu template paste image'
        ],
        'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image'
    ]
]); ?>

    <?= $form->field($model, 'status')
        ->dropDownList(
            $model->getStatusList(),        
        ); ?>

    
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
    
   
    <div class="modal-footer">
        <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success']) ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    
    <?php ActiveForm::end(); ?>
    
    
    
    
    
</div>



<?php
$script = <<< JS

    $(document).ready(function () { 
        $("#ajax-form").on('beforeSubmit', function (event) { 
            event.preventDefault();            
            var form_data = new FormData($('#ajax-form')[0]);
            $.ajax({
                url: $("#ajax-form").attr('action'), 
                dataType: 'JSON',  
                cache: false,
                contentType: false,
                processData: false,
                data: form_data, //$(this).serialize(),                      
                type: 'post',                        
                beforeSend: function() {},
                success: function(response){                      
                    //toastr.success("",response.message); 
                    $.pjax.reload({container: '#pjaxTaskList', async: false});
                    $('#modal').modal('hide');
                },
                complete: function() {
                },
                error: function (data) {
                    //toastr.warning("","There may a error on uploading. Try again later");    
                }
            });                
            return false;
        });
    });       

JS;
$this->registerJs($script);
?>