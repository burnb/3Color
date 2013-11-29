<?php
include_once "config.php";
include_once "module.php";
$user = new users();
$user->id = $_POST['id'];
$user->connect = $connect;
echo json_encode($user->del());
?>