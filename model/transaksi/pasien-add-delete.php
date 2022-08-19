<?php
session_start();
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<script>window.location='index.php';</script>";
} else {
    include "../../config/koneksi.php";
    include "../../config/fungsi_kode_otomatis.php";
    include "../../config/class_paging.php";
    include "../../config/fungsi_rupiah.php";
    include "../../config/fungsi_indotgl.php";
    include "../../config/library.php";
    include "../../config/fungsi_combobox.php";
    include "../../config/fungsi_seo.php";
    include "../../config/fungsi_thumb.php";
    include "../../detect.php";

    $id = $_GET['id'];

    $update = $koneksi->query("DELETE FROM trxn_saledrugs WHERE SalesDrugsCode = '$id'");
    if ($update) {
        echo "<script>localStorage.clear();</script>";
        echo "<script>window.location='kasir-pasien';</script>";
    } else {
        echo '<script type="text/javascript">alert("Update error");</script>';
        echo "<script>window.location='kasir-pasien';</script>";
    }
}
