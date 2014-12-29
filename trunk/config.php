<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "thoikhoabieu";
date_default_timezone_get("Asia/Ho_Chi_Minh");
$link = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
mysqli_query($link,"set names utf8");
?>
