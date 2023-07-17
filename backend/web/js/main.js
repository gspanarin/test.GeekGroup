$('#modalButton').click(function(){
    $('#modal').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
    return false;
});

function modalLinkClick(url){
    $('#modal').modal('show')
        .find('#modalContent')
        .load(url);
    return false;
};

function modalAxajDelete(url){
    if (confirm('Are you sure you want to delete this item?') == true) {
        $.ajax({
            url: url, 
            dataType: 'JSON',  
            cache: false,
            contentType: false,
            processData: false,
            //data: form_data, //$(this).serialize(),                      
            type: 'post',                        
            beforeSend: function() {},
            success: function(response){                      
                $.pjax.reload({container: '#pjaxTaskList', async: false});
                $.pjax.reload({container: '#pjaxCommentList', async: false});
            },
            complete: function() {
            },
            error: function (data) {
                //toastr.warning("","There may a error on uploading. Try again later");    
            }
        });                
        return false;
    }
  
  
    
    

};











$('#modalCommentButton').click(function(){
    $('#modalComment').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
    return false;
});