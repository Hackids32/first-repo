<?php
/*date_default_timezone_set("Asia/Jakarta");
$db_host2 = "localhost";
$db_pass2 = "";
$db_user2 = "root";
$db_name2 = "db_jsc_poli2";

$koneksi2 = mysqli_connect($db_host2, $db_user2, $db_pass2, $db_name2);
global $koneksi2;

if (mysqli_connect_errno()) {
	echo 'Gagal melakukan koneksi ke Database : ' . mysqli_connect_error();
}*/

date_default_timezone_set("Asia/Jakarta");
$db_host2 = "jsc-arif_mysql_1";
$db_pass2 = "my-secret-pw";
$db_user2 = "root";
$db_name2 = "jsc_policlinicdb";

$koneksi2 = mysqli_connect($db_host2, $db_user2, $db_pass2, $db_name2);
global $koneksi2;

if (mysqli_connect_errno()) {
	echo 'Gagal melakukan koneksi ke Database : ' . mysqli_connect_error();
}
