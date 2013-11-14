<?php
define("DB_HOST", "localhost");
define("DB_LOGIN", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "usersdb");

$connect = new mysqli(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);
if ($connect->connect_errno) {
    printf("Не удалось подключиться: %s\n", $connect->connect_error);
    exit();
}
?>