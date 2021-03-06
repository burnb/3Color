<?php
echo '
    <form class="form-horizontal white-popup-block mfp-hide" id="form" role="form" style="display: none">
        <div class="form-group">
            <div class="col-md-8">
                <input type="hidden" class="form-control" id="id"/>
            </div>
        </div>
        <div class="form-group" id="inputName">
            <label for="name" class="col-md-4 control-label">Имя:</label>
            <div class="col-md-8">
                <input class="form-control" id="name" type="text" placeholder="Имя" maxlength="512"/>
            </div>
        </div>
        <div class="form-group" id="inputGender">
            <label for="gender" class="col-md-4 control-label">Пол:</label>
            <div class="col-md-8">
                <select class="form-control" id="gender">
                    <option disabled selected value=""></option>
                    <option value="man">Мужской</option>
                    <option value="women">Женский</option>
                </select>
            </div>
        </div>
        <div class="form-group" id="inputDate">
            <label for="datepicker" class="col-md-4 control-label">Дата рождения:</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="datepicker" placeholder="Дата рождения"/>
            </div>
        </div>
        <div class="form-group" id="inputPhone">
            <label for="phone" class="col-md-4 control-label">Телефон:</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="phone" placeholder="8(хххх)хх-хх-хх"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-4 col-md-8" id="formError">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-4 col-md-8">
                <button type="button" id="btn_save" class="btn btn-default">Сохранить</button>
            </div>
        </div>
    </form>
';
?>