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


    $update = $koneksi->query("UPDATE mstr_drugsunit SET
                                DrugsUnitName = '$_POST[nama_satuan]',
                                Description = '$_POST[keterangan]' WHERE DrugsUnitId = '$id'");
    if($update)
    {   
        //echo '<script type="text/javascript">sweetAlert("Congratulations !","Successfully booked for a vehicle, email has been sent to approver","success")</script>';
        echo "<script>window.location='satuan-obat';</script>";
    }
    else
    {   
        echo '<script type="text/javascript">alert("Update error");</script>';
        echo "<script>window.location='satuan-obat';</script>";
    }
}
?>