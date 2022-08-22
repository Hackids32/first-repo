<?php
date_default_timezone_set("Asia/Jakarta");
$db_host = "192.168.100.7";
$db_pass = "myroot";
$db_user = "root";
$db_name = "hris_ntc";

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
//mysqli_select_db($db_name,$koneksi);
global $koneksi;

if (mysqli_connect_errno()) {
	echo 'Gagal melakukan koneksi ke Database : ' . mysqli_connect_error();
}
