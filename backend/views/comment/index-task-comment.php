<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use kartik\date\DatePicker;
use yii\widgets\Pjax;
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;







?>
<div class="index-task-comment">

   
    
    
  <!-- 
  Дизайн чату взяв тут
  https://mdbootstrap.com/docs/standard/extended/chat/
  -->
    
    
    
    <section style="background-color: #eee;">
  <div class="container py-5">

    <div class="row">

     

      <div class="m-3 p-3 ">

        <ul class="list-unstyled">
             
          <li class="d-flex justify-content-between mb-4">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp" alt="avatar"
              class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
            <div class="card">
              <div class="card-header d-flex justify-content-between p-3">
                <p class="fw-bold mb-0">Brad Pitt</p>
                <p class="text-muted small mb-0"><i class="far fa-clock"></i> 12 mins ago</p>
              </div>
              <div class="card-body">
                <p class="mb-0">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                  labore et dolore magna aliqua.
                </p>
              </div>
            </div>
          </li>
          <li class="d-flex justify-content-between mb-4">
            <div class="card w-100">
              <div class="card-header d-flex justify-content-between p-3">
                <p class="fw-bold mb-0">Lara Croft</p>
                <p class="text-muted small mb-0"><i class="far fa-clock"></i> 13 mins ago</p>
              </div>
              <div class="card-body">
                <p class="mb-0">
                  Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                  laudantium.
                </p>
              </div>
            </div>
            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-5.webp" alt="avatar"
              class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60">
          </li>
          <li class="d-flex justify-content-between mb-4">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp" alt="avatar"
              class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
            <div class="card">
              <div class="card-header d-flex justify-content-between p-3">
                <p class="fw-bold mb-0">Brad Pitt</p>
                <p class="text-muted small mb-0"><i class="far fa-clock"></i> 10 mins ago</p>
              </div>
              <div class="card-body">
                <p class="mb-0">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                  labore et dolore magna aliqua.
                </p>
              </div>
            </div>
          </li>
          
        <?php Pjax::begin(['id' => 'pjaxTaskCommentList']); ?>          
        
        <?php 
           /* $commentDataProvider = new ActiveDataProvider([
                'query' => $model->getComments(),
                'pagination' => [
                    'pageSize' => 50,
                ],
            ]);*/
            echo ListView::widget([
                'dataProvider' => $taskCommentDataProvider,
                'itemView' => '_task_comment',
            ]);
        ?>
          
        <?php Pjax::end(); ?>
      
          
          <li class="bg-white mb-3">
            <div class="form-outline">
              <?php $form = ActiveForm::begin(['id' => 'sendCommentForm','action' => '/admin/comment/ajax-create?user_id=' . $user_id . '&project_id=' . $project_id . '&task_id=' . $task_id]); ?>
              <textarea name="Comment[text]" class="form-control" id="comment-text" rows="4"></textarea>
              <label class="form-label" for="textAreaExample2">Message</label>
              <?php ActiveForm::end(); ?>
            </div>
          </li>
          
          <li class="bg-white mb-3">
            <div class="form-outline">
              <button type="submit" id="buttonSendComment" class="btn btn-info btn-rounded float-end">Send</button>
            </div>
          </li>
 
        </ul>

      </div>

    </div>

  </div>
</section>
    
    
    
    
    
    
    
    
    
    
    
    
    
</div>



<?php
$script = 'var pjax_url = "/admin/comment/index-task-comment?user_id=' . Yii::$app->user->id . '&project_id=' . $model->project_id . '&task_id=' . $model->id . '";' . 
    <<< JS

    try {
        tinymce.remove();
    } catch (e) {}
    tinymce.init({
        selector: "textarea",
    });
        
    
    $("#buttonSendComment").click(function (event) { 
        event.preventDefault();            
        
        var message = tinyMCE.activeEditor.getContent();
        if (message != ''){   
            $("#comment-text").val(message);
            var form_data = new FormData($('#sendCommentForm')[0]);
            $.ajax({
                url: $("#sendCommentForm").attr('action'), 
                dataType: 'JSON',  
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                 
                type: 'post',                        
                beforeSend: function() {},
                success: function(response){                      
                    //toastr.success("",response.message); 
                    $.pjax.reload({
                        container: '#pjaxTaskCommentList', 
                        async: false,
                        url: "http://test/admin/comment/index-task-comment?user_id=1&project_id=7&task_id=26"
                    });
                    tinyMCE.activeEditor.setContent('');
                },
                complete: function() {
                },
                error: function (data) {
                    //toastr.warning("","There may a error on uploading. Try again later");    
                }
            });    
        }
        return false;
    });
        
        
    tinymce.remove();
    tinymce.init({
        selector: "textarea",
    });
        
    

JS;
$this->registerJs($script);
?>