<?php
date_default_timezone_set("Asia/Jakarta");
$db_host = "jsc-arif_mysql_1";
$db_pass = "my-secret-pw";
$db_user = "root";
$db_name = "jsc_dispensarydb";

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
//mysqli_select_db($db_name,$koneksi);
global $koneksi;

if (mysqli_connect_errno()) {
	echo 'Gagal melakukan koneksi ke Database : ' . mysqli_connect_error();
}

/*date_default_timezone_set("Asia/Jakarta");
$db_host = "localhost";
$db_pass = "";
$db_user = "root";
$db_name = "db_jsc";

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
global $koneksi;

if (mysqli_connect_errno()) {
	echo 'Gagal melakukan koneksi ke Database : ' . mysqli_connect_error();
}*/
