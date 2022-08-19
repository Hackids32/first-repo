<?php
session_start();
if(empty($_SESSION['username']) AND empty($_SESSION['passuser']))
{
    echo"<script>window.location='index.php';</script>";
}
else
{
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

    $id = $_POST['id'];
    $modify = date('Y-m-d H:i:s');


    $update = $koneksi->query("UPDATE mstr_obat SET DrugsName = '$_POST[nama_obat]',
                                DrugsPositionCode = '$_POST[pot]',
                                Generic = '$_POST[nama_generik]',
                                DrugsType = '$_POST[jenis]',
                                DistributorCode = '$_POST[distributor]',
                                PrincipleCode = '$_POST[pabrikan]',
                                Unit = '$_POST[tipe]',
                                Strength = '$_POST[ukuran]',
                                BasicPrice = '$_POST[harga_dasar]',
                                SellingPrice = '$_POST[harga_jual]',
                                SeviceFactorPrice = '$_POST[biaya_jasa]',
                                ModifiedAt = '$modify' WHERE DrugsEstablishId = '$id'");
    if($update)
    {   
        //echo '<script type="text/javascript">sweetAlert("Congratulations !","Successfully booked for a vehicle, email has been sent to approver","success")</script>';
        echo "<script>window.location='obat';</script>";
    }
    else
    {   
        echo '<script type="text/javascript">alert("Update error");</script>';
        echo "<script>window.location='obat';</script>";
    }
}
?>