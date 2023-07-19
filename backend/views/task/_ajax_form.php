<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use kartik\date\DatePicker;


?>
<div class="task-create">

    <?php $form = ActiveForm::begin([
        'id' => 'ajax-form',
        'action' => '/admin/task/ajax-update?id=' . $model->id,
    ]); ?>
    
    <?= $form->field($model, 'version')->hiddenInput()->label(false); ?>
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'desciption')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        'language' => 'ru',
        'clientOptions' => [
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

    tinymce.remove();
    tinymce.init({
        selector: "textarea",
    });
        
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

JS;
$this->registerJs($script);
?>