//===========Magnific-Popup(модальное окно формы)===========//

$(document).ready(function() {
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
});


//===========Datepicker(Календарик)===========//

$(function() {
    $( "#datepicker" ).datepicker({ dateFormat: "dd.mm.yy" });
});

//===========Save===========//

$(document).ready(function(){
    $('#btn_save').click(function(){
        var name = $('#name').val();
        var gender = $('#gender').val();
        var data = $('#datepicker').val();
        var phone = $('#phone').val();
        $.ajax({                                        //отправка данных на addUser.php, где все сохраняется в БД
            type: "POST",
            url: "addUser.php",
            data: "name=" + name
                + "&gender=" + gender
                + "&data=" + data
                + "&phone=" + phone,
            success: function(response){
                if(response == "OK"){
                    $('#name').val('');                 //очистка формы
                    $('#gender').val('');
                    $('#datepicker').val('');
                    $('#phone').val('');
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
                        }
                    })
                }else
                    alert("Ошибка!" + response);
            }
        });
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
                    if(response == "del_ok"){
                        $('#info').empty().addClass('alert alert-warning').fadeIn().append('Пользователь удален!').delay(3000).fadeOut();       //отрисовка алерта в главном окне
                        $('.userview').remove();    //чистка таблицы
                        $.ajax({                    //перегрузка таблицы
                            type: "POST",
                            url: "updateView.php",
                            data: "reload=true",
                            success: function(response){
                                $('tbody').append(response);
                            }
                        });
                    }else
                        alert("Ошибка!" + response);
                }
            });
        }
    });
});