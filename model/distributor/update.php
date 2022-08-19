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


    $update = $koneksi->query("UPDATE mstr_distributor SET
                                DistributorName = '$_POST[nama_distributor]',
                                OfficialName = '$_POST[nama_official]',
                                FirstAddress = '$_POST[alamat]',
                                SecondAddress = '$_POST[alamat2]',
                                ThirdAddress = '$_POST[alamat3]',
                                City = '$_POST[kota]',
                                PostalCode = '$_POST[pos]',
                                PhoneNumber = '$_POST[telepon]',
                                FaxNumber = '$_POST[fax]',
                                Email = '$_POST[email]',
                                PIC = '$_POST[pic]',
                                PICphoneNumber = '$_POST[telepon_pic]',
                                PICemail = '$_POST[email_pic]',
                                CreateAt = '$modify',
                                CreateBy = '$_SESSION[username]',
                                ModifiedAt = '$modify',
                                ModifiedBy = '$_SESSION[username]' WHERE DistributorId = '$id'");
    if($update)
    {   
        //echo '<script type="text/javascript">sweetAlert("Congratulations !","Successfully booked for a vehicle, email has been sent to approver","success")</script>';
        echo "<script>window.location='distributor';</script>";
    }
    else
    {   
        echo '<script type="text/javascript">alert("Update error");</script>';
        echo "<script>window.location='distributor';</script>";
    }
}
?>