<?php
include_once "module.php";
if ($_POST['reload']) {
    users::view();
} else {
    echo "Ошибка reload!";
}
?>