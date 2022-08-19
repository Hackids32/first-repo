<?php
session_start();
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<script>window.location='index.php';</script>";
} else {
    include "../../config/koneksi.php";
    include "../../config/koneksi2.php";
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
    $selek = $koneksi2->query("SELECT * FROM trxn_pembayaran WHERE id = '$id'");
    $s = mysqli_fetch_array($selek);
    $update = $koneksi2->query("DELETE FROM trxn_pembayaran WHERE id = '$id'");
    if ($update) {
        //echo '<script type="text/javascript">sweetAlert("Congratulations !","Successfully booked for a vehicle, email has been sent to approver","success")</script>';
        echo "<script>window.location='pay.php?id=$s[no_reg]';</script>";
        echo $id;
    } else {
        echo '<script type="text/javascript">alert("Update error $id");</script>';
        echo "<script>window.location='pay.php?id=$s[no_reg]';</script>";
    }
}
