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
}
//===========Datepicker(Календарик)===========//
$(function() {
    $( "#datepicker" ).datepicker({ dateFormat: "dd.mm.yy" });
});
//===========Clear form data + error===========//
function clearForm(){
    $('#id').val('');
    $('#name').val('');
    $('#gender').val('');
    $('#datepicker').val('');
    $('#phone').val('');
}
function clearFormError(){
    $('.form-group').removeClass('has-error');
    $('#formError').removeClass('alert alert-warning').empty();
}
//===========Check form data===========//
function checkForm(name,gender,data,phone){
    var e=0;
    var ret = false;
    if (name.length == 0){
        $('#inputName').addClass('has-error');
        $('#formError').addClass('alert alert-warning').append('Заполните поле "Имя"!<br>');
        e++;
    }
    if (gender!="man" && gender!="women"){
        $('#inputGender').addClass('has-error');
        $('#formError').addClass('alert alert-warning').append('Укажите пол!<br>');
        e++;
    }
    if (data.length == 0){
        $('#inputDate').addClass('has-error');
        $('#formError').addClass('alert alert-warning').append('Заполните поле "Дата рождения"!<br>');
        e++;
    }
    if (phone.length == 0){
        $('#inputPhone').addClass('has-error');
        $('#formError').addClass('alert alert-warning').append('Заполните поле "Телефон"!<br>');
        e++;
    }
    if (!e){
        if (name.length>256){
            $('#inputName').addClass('has-error');
            $('#formError').addClass('alert alert-warning').append('Имя должно быть не более 256 символов!<br>');
            e++;
        }
        if (!/^(0[1-9]|[1-2][0-9]|3[0-1]).(0[1-9]|1[0-2]).[0-9]{4}$/.test(data)){
            $('#inputData').addClass('has-error');
            $('#formError').addClass('alert alert-warning').append('Поле "Дата рождения" заполненно некорректно!<br>');
            e++;
        }
        if (!/^(8)\(([0-9]{4})\)([0-9]{2})-([0-9]{2})-([0-9]{2})$/.test(phone)){
            $('#inputData').addClass('has-error');
            $('#formError').addClass('alert alert-warning').append('Поле "Телефон" заполненно некорректно!<br> Правильный формат 8(хххх)хх-хх-хх');
            e++;
        }
        if (!e) ret=true;
    }
    return ret;
}
//===========Reload view===========//
function reload(alert){
    $('#info').empty().addClass('alert alert-warning').fadeIn().append(alert).delay(3000).fadeOut();    //отрисовка алерта в главном окне
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
}
//===========Save===========//
function addEdit(){
    var url = "";
    var erralert = "";
    var al = "";
    var id = $('#id').val();
    var name = $('#name').val();
    var gender = $('#gender').val();
    var data = $('#datepicker').val();
    var phone = $('#phone').val();
    if (!checkForm(name,gender,data,phone)) return; //js проверка данных формы
    if (!id){
        url = "addUser.php";
        erralert = "Ошибка создания! ";
        al = "Добавлен пользователь ";
    }else{
        url = "editUser.php";
        erralert = "Ошибка при редактировании! ";
        al = "Обновлены данные пользователя ";
    }
    $.ajax({
        type: "POST",
        url: url,
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
                reload(al+json.suc);
            }else
            if(json.err) alert(erralert + json.err);
            else{
                for(var key in json){
                    $('#'+key).addClass('has-error');
                    $('#formError').addClass('alert alert-warning').append(json[key]+'<br>');
                }
            }
        }
    });
}
$(document).ready(function(){
    mp();
    $('#btn_add').click(function(){                     //открываем форму
        $('#form').removeAttr('style');
        $('#id').val('');
        clearFormError();
    });
    $('#btn_save').click(function(){
        clearFormError();
        addEdit();
    });
//===========Edit===========//
    $(document).on('click','.btn_edit',function(){      //открываем форму и заполняем поля
        $('#form').removeAttr('style');
        clearFormError();
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
//===========Delete===========//
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
                        reload('Пользователь удален');
                    }else
                        alert(json.err);
                }
            });
        }
    });
});





