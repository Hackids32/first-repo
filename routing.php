<?php
if ($_GET['route'] == 'dashboard') {
	include "controller/dashboard/index.php";
}

//obat
elseif ($_GET['route'] == 'obat') {
	include "controller/master/obat.php";
} elseif ($_GET['route'] == 'obat-add') {
	include "controller/master/obat-add.php";
} elseif ($_GET['route'] == 'obat-edit') {
	include "controller/master/obat-edit.php";
}

//distributor
elseif ($_GET['route'] == 'distributor') {
	include "controller/master/distributor.php";
} elseif ($_GET['route'] == 'distributor-add') {
	include "controller/master/distributor-add.php";
} elseif ($_GET['route'] == 'distributor-edit') {
	include "controller/master/distributor-edit.php";
}

//principle
elseif ($_GET['route'] == 'principle') {
	include "controller/master/principle.php";
} elseif ($_GET['route'] == 'principle-add') {
	include "controller/master/principle-add.php";
} elseif ($_GET['route'] == 'principle-edit') {
	include "controller/master/principle-edit.php";
}

//satuan obat
elseif ($_GET['route'] == 'satuan-obat') {
	include "controller/master/satuan.php";
} elseif ($_GET['route'] == 'satuan-obat-add') {
	include "controller/master/satuan-add.php";
} elseif ($_GET['route'] == 'satuan-obat-edit') {
	include "controller/master/satuan-edit.php";
}

//transaksi - kasir
elseif ($_GET['route'] == 'transaksi-kasir') {
	include "controller/transaksi/transaksi-kasir.php";
} elseif ($_GET['route'] == 'kasir-umum') {
	include "controller/transaksi/kasir-umum.php";
} elseif ($_GET['route'] == 'edit-umum') {
	include "controller/transaksi/kasir-umum-edit.php";
} elseif ($_GET['route'] == 'kasir-pasien') {
	include "controller/transaksi/kasir-pasien.php";
} elseif ($_GET['route'] == 'edit-pasien') {
	include "controller/transaksi/kasir-pasien-edit.php";
} elseif ($_GET['route'] == 'kasir-register') {
	include "controller/transaksi/kasir-register.php";
} elseif ($_GET['route'] == 'edit-register') {
	include "controller/transaksi/kasir-register-edit.php";
} elseif ($_GET['route'] == 'kasir-register-payment') {
	include "controller/transaksi/kasir-register-payment.php";
} elseif ($_GET['route'] == 'pay-register') {
	include "controller/transaksi/pay.php";
}

//transaksi - kasir - list
elseif ($_GET['route'] == 'list-invoice') {
	include "controller/transaksi/list-invoice.php";
}

//transaksi - kasir - eod
elseif ($_GET['route'] == 'kasir-eod') {
	include "controller/transaksi/kasir-eod.php";
} elseif ($_GET['route'] == 'kasir-eod-cari') {
	include "controller/transaksi/kasir-eod-cari.php";
} else {
	echo "<script>alert('Controller not found!');</script>";
	echo "<script>window.location='dashboard'</script>";
}
