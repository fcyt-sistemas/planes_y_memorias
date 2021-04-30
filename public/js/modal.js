$('div[data-form="deleteForm"]').on('click', '.form-delete', function(e){
    e.preventDefault();
    var $form=$(this);
    $('#confirm').modal({ backdrop: 'static', keyboard: false })
        .on('click', '#delete-btn', function(){
            $form.submit();
        });
});

$('#aprobForm').on('click', '.aprobar', function(e){
    e.preventDefault();
    var $form=$(this).parent();
    $('#confirm').modal({ backdrop: 'static', keyboard: false })
        .on('click', '#aprob-btn', function(){
            $form.submit();
        });
});