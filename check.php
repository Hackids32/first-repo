<?php
session_start();
include "config/koneksi.php";

$error = array();

$member_username = mysqli_real_escape_string($koneksi, $_POST['username']);
$member_password = md5($_POST['password']);

if (empty($error)) {
	$login = "SELECT * FROM admins WHERE username='$member_username' AND password='$member_password'";
	$result = $koneksi->query($login) or die($mysqli->error . __LINE__);
	$rows = $result->fetch_assoc();
	extract((array)$rows);
	// Apabila username dan password ditemukan
	if ($result->num_rows > 0) {
		$_SESSION['namauser'] = $full_name;
		$_SESSION['username'] = $username;
		$_SESSION['passuser'] = $password;
		$_SESSION['jabatan']  = $category;
		$_SESSION['upload_image_file_manager'] = true;
		if ($updater == 'No') {
			header('location:update');
			echo "<meta http-equiv='refresh' content='0; url=update";
		} else {
			header('location:transaksi-kasir');
			echo "<meta http-equiv='refresh' content='0; url=transaksi-kasir";
		}
	} else {
		echo "<script>alert('Username or password not match !');</script>";
		echo "<script>window.location='index.php';</script>";
	}
}

unset($_POST['login']);
