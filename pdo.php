<?php
$db_user = "newuser";
$db_passwd = "Aqwzsx123!";
$db_host = "localhost";
$db_port = "3306";
$db_name = "test";
$db_dataSourceName = "mysql:host=$db_host;port=$db_port;dbname=$db_name";

$PDO = new PDO($db_dataSourceName, $db_user, $db_passwd);
$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
