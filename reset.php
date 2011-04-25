<?php
session_start();
session_destroy();

$connect = mysql_connect("localhost", "root", "root");
mysql_select_db("snake", $connect);

mysql_query("TRUNCATE game", $connect);

header("Location: client.php");

