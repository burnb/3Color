<?php
include_once "module.php";
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>Тестовое задание</title>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/main.js"></script>
    <link href="css/magnific-popup.css" rel="stylesheet" type="text/css"/>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen" type="text/css">
    <link href="css/jquery-ui-1.10.3.custom.css" rel="stylesheet" media="screen" type="text/css">
    <link href="css/main.css" rel="stylesheet" media="screen" type="text/css"/>
</head>
<body>
<div class="container body">
    <nav class="navbar navbar-inverse navbar-fixed-top" role='navigation'>
        <div class="col-sm-offset-1 col-sm-2">
            <a class="popup-with-form" href="#form"><button class="btn btn-warning navbar-btn" id="btn_add">Добавить</button></a> </div>
        <div class="navbar-right col-sm-6"></div>
        <div class="col-sm-3 navbar-right navbar-text" id='info'>
        </div>
    </nav>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Имя</th>
                <th>Пол</th>
                <th>Дата рождения</th>
                <th>Телефон</th>
                <th><span></span></th>
            </tr>
        </thead>
        <tbody>
<?php
    views::view(); /*Метод из module.php для отрисовки таблицы*/
?>
    </tbody>
    </table>
</div>
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col-md-6">
                    <div class="container">
                        <small>© 2013 Company. All rights reserved. Proudly made in Russia.</small>
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <div class="container">
                        <img src="./img/Physicist.fw.png" height="20"><a href="http://www.phdevelop.com">Physicist</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    views::form();  /*Метод из module.php для отрисовки формы*/
?>
</body>
</html>
