$(document).ready(function () {
    $('.add-new').on('click', function () {
        $.ajax('/html/create', {
            "method"  : "GET",
            "dataType": "json",
            success   : function (response) {
                $('.modal-body').html(response.data);
                $("#buy_date").datepicker({
                    changeMonth: true,
                    changeYear : true,
                    dateFormat : "dd.mm.yy"
                });
                $('.modal-title').html(response.modalTitle);
                $('.save').html(response.saveBtn);
                $('.modal').show();
            }
        });
        
        return false;
    });
    
    $('.close-modal').on('click', function () {
        $('.modal').hide();
    });
    
    $('.save').on('click', function () {
        $(this).parents('.modal-content').find('form').trigger('submit');
    });
    
    $('body').on('submit', 'form', function () {
        
        let form = $(this);
        
        $.ajax(form.attr('action'), {
            dataType  : "json",
            method    : form.attr("method"),
            data      : form.serialize(),
            beforeSend: function () {
                $('.has-error').removeClass('has-error');
                $('.help-block').html('');
            },
            success   : function (response) {
                switch (response.status) {
                    case "validate_error":
                        $.each(response.errors, function (key, error) {
                            let element = $('#' + key);
                            let parrent = element.parents('.form-group');
                            parrent.addClass('has-error');
                            parrent.find('.help-block').html(error[0]);
                            
                        });
                        break;
                    case "ok" :
                        window.location = window.location.href;
                        break;
                }
            }
        });
        
        return false;
    });
    
    $('.delete').on('click', function () {
        let id = $(this).parents('tr').attr('data-id');
        
        let res = confirm("Удалить");
        
        if (res) {
            $.ajax('/delete/' + id, {
                method  : "delete",
                dataType: "json",
                success : function (response) {
                    if (response.status == 'ok') {
                        window.location = window.location.href;
                    }
                }
            });
        }
    });
    
    $('.update').on('click', function () {
        let id = $(this).parents('tr').attr('data-id');
        
        $.ajax('/html/edit/' + id, {
            "method"  : "GET",
            "dataType": "json",
            success   : function (response) {
                $('.modal-body').html(response.data);
                $("#buy_date").datepicker({
                    changeMonth: true,
                    changeYear : true,
                    dateFormat : "dd.mm.yy"
                });
                $('.modal-title').html(response.modalTitle);
                $('.save').html(response.saveBtn);
                $('.modal').show();
            }
        });
        
        return false;
    });
});

