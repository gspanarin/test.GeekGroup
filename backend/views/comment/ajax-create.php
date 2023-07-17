<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use kartik\date\DatePicker;

?>
<div class="comment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    
    <?php $form = ActiveForm::begin([
        'id' => 'ajax-comment-form',
        'action' => '/admin/comment/ajax-create?project_id=' . $model->project_id . '&user_id=' . $model->user_id,
    ]); ?>
    
    <?= $form->field($model, 'project_id')->hiddenInput() ?>

    <?= $form->field($model, 'task_id')->hiddenInput() ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'version')->hiddenInput() ?>
    
   
    <div class="modal-footer">
        <?= Html::submitButton(Yii::t('backend', 'Send comment'), ['class' => 'btn btn-success']) ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    
    <?php ActiveForm::end(); ?>
    
    
    
    
    
</div>



<?php
$script = <<< JS

    $(document).ready(function () { 
        $("#ajax-comment-form").on('beforeSubmit', function (event) { 
            event.preventDefault();            
            var form_data = new FormData($('#ajax-comment-form')[0]);
            $.ajax({
                url: $("#ajax-comment-form").attr('action'), 
                dataType: 'JSON',  
                cache: false,
                contentType: false,
                processData: false,
                data: form_data, //$(this).serialize(),                      
                type: 'post',                        
                beforeSend: function() {},
                success: function(response){                      
                    //toastr.success("",response.message); 
                    $.pjax.reload({container: '#pjaxCommentList', async: false});
                    $('#modalComment').modal('hide');
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