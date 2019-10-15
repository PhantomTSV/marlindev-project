<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$db_driver = 'mysql'; // тип базы данных, с которой мы будем работать 

$db_host = 'localhost';// альтернатива '127.0.0.1' - адрес хоста, в нашем случае локального

$db_name = 'test'; // имя базы данных 

$db_user = 'root'; // имя пользователя для базы данных 

$db_password = '123'; // пароль пользователя 

$db_charset = 'utf8'; // кодировка по умолчанию 

$db_options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]; 

$db_dsn = "$db_driver:host=$db_host;dbname=$db_name;charset=$db_charset";
