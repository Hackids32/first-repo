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
    $sekarang = date("Ymd");
    $modify = date('Y-m-d H:i:s');
    $kalimat = $_POST['kode_manufaktur'];
    $kalimat2 = $koneksi->query("SELECT * FROM mstr_principle ORDER BY PrincipleId DESC");
    $k = mysqli_fetch_array($kalimat2);
    $str = substr($kalimat,0,3);
    $str2 = substr($k['PrincipleCode'],-4);
    $str3 = $str2 + 1;
    $str4 = str_pad($str3,4,0,STR_PAD_LEFT);
    $prefix = '20160917'.$str;
    $generate = $prefix.$str4;

    $update = $koneksi->query("INSERT INTO mstr_principle (PrincipleCode,
                                PrincipleName,
                                ManufactureCode,
                                FirstAddress,
                                SecondAddress,
                                City,
                                PostalCode,
                                PhoneNumber,
                                FaxNumber,
                                Email,
                                PIC,
                                PICphoneNumber,
                                PICemail,
                                CreateAt,
                                CreateBy,
                                ModifiedAt,
                                ModifiedBy)
                                VALUES('$generate',
                                '$_POST[nama_principle]',
                                '$_POST[kode_manufaktur]',
                                '$_POST[alamat]',
                                '$_POST[alamat2]',
                                '$_POST[kota]',
                                '$_POST[pos]',
                                '$_POST[telepon]',
                                '$_POST[fax]',
                                '$_POST[email]',
                                '$_POST[pic]',
                                '$_POST[telepon_pic]',
                                '$_POST[email_pic]',
                                '$modify',
                                '$_SESSION[username]',
                                '$modify',
                                '$_SESSION[username]')");

    if($update)
    {   
        echo "<script>window.location='principle';</script>";
    }
    else
    {
        echo "<script>alert('Saving error');</script>";
        echo "<script>window.location='principle';</script>";   
    }
}
?>