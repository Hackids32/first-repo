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
 
    $today = date('Y-m-d');
    $modify = date('Y-m-d H:i:s');

    $update = $koneksi->query("INSERT INTO mstr_drugsunit (DrugsUnitCode,
                                DrugsUnitName,
                                Description,
                                CreateAt,
                                CreateBy,
                                ModifiedAt,
                                ModifiedBy)
                                VALUES('$_POST[kode_satuan]',
                                '$_POST[nama_satuan]',
                                '$_POST[keterangan]',
                                '$modify',
                                '$_SESSION[username]',
                                '$modify',
                                '$_SESSION[username]')");

    if($update)
    {   
        echo "<script>window.location='satuan-obat';</script>";
    }
    else
    {
        echo "<script>alert('Saving error');</script>";
        echo "<script>window.location='satuan-obat';</script>";   
    }
}
?>