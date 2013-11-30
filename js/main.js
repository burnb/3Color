function clearForm(){
    $('#id').val('');
    $('#name').val('');                 //очистка формы
    $('#gender').val('');
    $('#datepicker').val('');
    $('#phone').val('');
};
function clearFormError(){
    $('.form-group').removeClass('has-error');
    $('#formError').removeClass('alert alert-warning').empty();
}
//===========Magnific-Popup(модальное окно формы)===========//
function mp(){
    $('.popup-with-form').magnificPopup({
        type: 'inline',
        preloader: false,
        focus: '#name',
        // When elemened is focused, some mobile browsers in some cases zoom in
        // It looks not nice, so we disable it:
        callbacks: {
            beforeOpen: function() {
                if($(window).width() < 700) {
                    this.st.focus = false;
                } else {
                    this.st.focus = '#name';
                }
            }
        }
    });
};

//===========Datepicker(Календарик)===========//

$(function() {
    $( "#datepicker" ).datepicker({ dateFormat: "dd.mm.yy" });
});

//===========Save===========//

$(document).ready(function(){
    mp();
    $('#btn_add').click(function(){
        $('#id').val('');
        clearFormError();
    });
    $('#btn_save').click(function(){
        clearFormError();
        var id = $('#id').val();
        var name = $('#name').val();
        var gender = $('#gender').val();
        var data = $('#datepicker').val();
        var phone = $('#phone').val();
        if(!id){
            $.ajax({                                        //отправка данных на addUser.php, где все сохраняется в БД
                type: "POST",
                url: "addUser.php",
                data: "name=" + name
                    + "&gender=" + gender
                    + "&data=" + data
                    + "&phone=" + phone,
                success: function(response){
                    var json = $.parseJSON(response);
                    if(json.suc){
                        clearForm();
                        var magnificPopup = $.magnificPopup.instance;   //скрытие формы
                        magnificPopup.close();
                        $('#info').empty().addClass('alert alert-warning').fadeIn().append('Пользователь ' + name + ' добавлен!').delay(3000).fadeOut();    //отрисовка алерта в главном окне
                        $('.userview').remove();    //чистка таблицы
                        $.ajax({                    //перегрузка таблицы
                            type: "POST",
                            url: "updateView.php",
                            data: "reload=true",
                            success: function(response){
                                $('tbody').append(response);
                                mp();
                            }
                        });
                    }else
                        if(json.err) alert("Ошибка! " + json.err);
                        else{
                            for(var key in json){
                                $('#'+key).addClass('has-error');
                                $('#formError').addClass('alert alert-warning').append(json[key]+'<br>');
                            }
                        }
                }
             });
        }else{
            $.ajax({                                        //отправка данных на editUser.php, где обновляются данные в БД
                type: "POST",
                url: "editUser.php",
                data: "id=" + id
                    +"&name=" + name
                    + "&gender=" + gender
                    + "&data=" + data
                    + "&phone=" + phone,
                success: function(response){
                    var json = $.parseJSON(response);
                    if(json.suc){
                        clearForm();
                        var magnificPopup = $.magnificPopup.instance;   //скрытие формы
                        magnificPopup.close();
                        $('#info').empty().addClass('alert alert-warning').fadeIn().append('Данные пользователя ' + name + ' обновлены!').delay(3000).fadeOut();    //отрисовка алерта в главном окне
                        $('.userview').remove();    //чистка таблицы
                        $.ajax({                    //перегрузка таблицы
                            type: "POST",
                            url: "updateView.php",
                            data: "reload=true",
                            success: function(response){
                                $('tbody').append(response);
                                mp();
                            }
                        });
                    }else
                    if(json.err) alert("Ошибка при редактировании! " + json.err);
                    else{
                        for(var key in json){
                            $('#'+key).addClass('has-error');
                            $('#formError').addClass('alert alert-warning').append(json[key]+'<br>');
                        }
                    }
                }
            });
        }
    });
});

//===========Edit===========//
$(document).ready(function(){
    $(document).on('click','.btn_edit',function(){
        var id = $(this).val();
        var name = $(this).parent().parent().parent().find('.tdName').html();
        var gender = $(this).parent().parent().parent().find('.tdGender').html();
        if(gender=='Мужской') gender='man';else gender='women';
        var date = $(this).parent().parent().parent().find('.tdDate').html();
        var phone = $(this).parent().parent().parent().find('.tdPhone').html();
        $('#id').val(id);
        $('#name').val(name);
        $('#gender').val(gender);
        $('#datepicker').val(date);
        $('#phone').val(phone);
    });
});

//===========Delete===========//

$(document).ready(function(){
    $(document).on('click','.btn_del',function(){
        var id = $(this).val();                                         //парсим id юзера
        var name = $(this).parent().parent().find('.tdName').html();    //парсим имя юзера
        if (confirm("Хотите удалить пользователя "+name+"?")){
            $.ajax({                                                    //отправка данных на delUser.php, где добавляется юзеру с выбранным id параметр del=1 в БД
                type: "POST",
                url: "delUser.php",
                data: "id=" + id,
                success: function(response){
                    var json = jQuery.parseJSON(response);
                    if(json.suc){
                        $('#info').empty().addClass('alert alert-warning').fadeIn().append('Пользователь удален!').delay(3000).fadeOut();       //отрисовка алерта в главном окне
                        $('.userview').remove();    //чистка таблицы
                        $.ajax({                    //перегрузка таблицы
                            type: "POST",
                            url: "updateView.php",
                            data: "reload=true",
                            success: function(response){
                                $('tbody').append(response);
                                mp();
                            }
                        });
                    }else
                        alert(json.err);
                }
            });
        }
    });
});