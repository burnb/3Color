<?php
include_once "module.php";
if ($_POST['reload']) {
    views::view();
} else {
    echo "Ошибка reload!";
}
?>