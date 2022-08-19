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

    $update = $koneksi->query("INSERT INTO mstr_obat (EstablishDate,
                                EstablishCode,
                                DefinedCode,
                                DrugsPositionCode,
                                DistributorCode,
                                DrugsName,
                                Generic,
                                PrincipleCode,
                                Strength,
                                Unit,
                                BasicPrice,
                                SellingPrice,
                                SeviceFactorPrice,
                                DrugsType,
                                CreateAt,
                                CreateBy,
                                ModifiedBy)
                                VALUES('$today',
                                '$_POST[establish_code]',
                                '$_POST[kode_obat]',
                                '$_POST[pot]',
                                '$_POST[distributor]',
                                '$_POST[nama_obat]',
                                '$_POST[nama_generik]',
                                '$_POST[pabrikan]',
                                '$_POST[ukuran]',
                                '$_POST[tipe]',
                                '$_POST[harga_dasar]',
                                '$_POST[harga_jual]',
                                '$_POST[biaya_jasa]',
                                '$_POST[jenis]',
                                '$modify',
                                'system.jsc',
                                'system.jsc')");

    if($update)
    {   
        echo "<script>window.location='obat';</script>";
    }
    else
    {
        echo "<script>alert('Saving error');</script>";
        echo "<script>window.location='obat';</script>";   
    }
}
?>