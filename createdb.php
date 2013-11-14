<?php
// Создание структуры Базы Данных гостевой книги

define("DB_HOST", "localhost");
define("DB_LOGIN", "root");
define("DB_PASSWORD", "");

mysql_connect(DB_HOST, DB_LOGIN, DB_PASSWORD) or die(mysql_error());

$sql = 'CREATE DATABASE usersdb';
mysql_query($sql);

mysql_select_db('usersdb') or die(mysql_error());

$sql = "
CREATE TABLE users (
	id INT(11) NOT NULL AUTO_INCREMENT,
	name VARCHAR(50) NOT NULL,
	gender VARCHAR(7) NOT NULL,
	date DATE NOT NULL,
	phone VARCHAR(11) NOT NULL,
	del VARCHAR(1) NOT NULL,
	PRIMARY KEY (id)
)";
mysql_query($sql) or die(mysql_error());

mysql_close();

print '<p>Структура базы данных успешно создана!</p>';
?>