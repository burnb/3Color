<?php
include_once "config.php";
include_once "module.php";
$user = new users();
$user->name = $_POST['name'];
$user->gender = $_POST['gender'];
$user->data = date('Y-m-d', strtotime($_POST['data']));
$user->phone = $_POST['phone'];
$user->connect = $connect;
echo $user->add();
?>