<?php
include_once "module.php";
if (isset($_POST['reload'])) {
    users::view();
} else {
    echo "Ошибка reload!";
}
?>