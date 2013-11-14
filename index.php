<?php
include_once "form.php";
include_once "module.php";
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<div class="container">
    <nav class="navbar navbar-inverse navbar-fixed-top" role='navigation'>
        <div class="col-lg-offset-1 col-lg-2">
            <a class="popup-with-form" href="#form"><button class="btn btn-warning navbar-btn" onlick="return false;">Добавить</button></a>
        </div>
        <div class="navbar-right col-sm-1"></div>
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
    users::view(); /*Метод из module.php для отрисовки талицы*/
?>
    </tbody>
    </table>
</div>
<?php
$form = new formView();
$form->displayForm(); /*отрисовка формы из form.php*/
?>
</body>
</html>
