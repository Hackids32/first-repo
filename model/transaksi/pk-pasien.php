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

    $kueri = $koneksi->query("SELECT * FROM mstr_obat WHERE EstablishCode = '$_POST[kode_obat]'");
    $k = mysqli_fetch_array($kueri);
    /*$kueri2 = $koneksi->query("SELECT * FROM trxn_saledrugs ORDER BY SaleDrugsId DESC LIMIT 1");
    $l = mysqli_fetch_array($kueri2);
    $sub = substr($l['SalesDrugsCode'], -5);
    $sub2 = $sub + 1;
    $pad = str_pad($sub2, 5, "0", STR_PAD_LEFT);
    $pad2 = str_pad($sub2, 6, "0", STR_PAD_LEFT);
    $kode = date('ymd') . ' ' . $pad;*/
    $kode = $_POST['id_registerr'];

    $kueri3 = $koneksi->query("SELECT * FROM rltn_transdrugsitem ORDER BY TransDrugItemId DESC LIMIT 1");
    $m = mysqli_fetch_array($kueri3);
    $sub_new = substr($m['TransDrugItemCode'], -6);
    $sub2_new = $sub_new + 1;
    $pad_new = str_pad($sub2_new, 6, "0", STR_PAD_LEFT);
    $kode_new = date('Ym') . 'DGI' . $pad_new;
    $newid = $m['TransDrugItemId'] + 1;

    $today = date('Y-m-d H:i:s');
    $raw = $k['SellingPrice'] * $_POST['qty'];
    $sub_diskon = ceil(($raw * $_POST['diskon']) / 100);

    //pembulatan nominal
    function angka_pembulatan($angka, $digit, $minimal)
    {
        $digitvalue = substr($angka, - ($digit));
        $bulat = 0;
        $nolnol = "";
        for ($i = 1; $i <= $digit; $i++) {
            $nolnol .= "0";
        }
        if ($digitvalue < $minimal && $digit != $nolnol) {
            $x1 = $minimal - $digitvalue;
            $bulat = $angka + $x1;
        } else {
            $bulat = $angka;
        }
        return $bulat;
    }

    //cek pembulatan diskon
    $cek = substr($sub_diskon, -2);
    if ($cek == '00') {
        $rounding = $sub_diskon;
    } else {
        $rounding = angka_pembulatan($sub_diskon, 2, 100);
    }
    $subdiskon = $rounding;
    $subtotal = $raw - $subdiskon;
    $total = $subtotal + $_POST['biaya_jasa'];

    //cek pembulatan total
    $cek2 = substr($total, -2);
    if ($cek2 == '00') {
        $rounding2 = $total;
    } else {
        $rounding2 = angka_pembulatan($total, 2, 100);
    }
    $gtotal = $rounding2;

    //cek stok before input
    if ($k['stok_awal'] < $_POST['qty']) {
        echo "<script>alert('Stok tidak cukup');</script>";
        $simpan = $koneksi->query("INSERT INTO rltn_transdrugsitem_tmp (TransDrugItemCode,
                                        SalesDrugsCode,
                                        EstablishCode,
                                        EstablishPrice,
                                        Unit,
                                        DiscPercent,
                                        Discount,
                                        ServicePrice,
                                        SubTotal,
                                        CreateAt,
                                        CreateBy,
                                        ModifiedAt,
                                        ModifiedBy) VALUES ('$kode_new',
                                        '$kode',
                                        '$_POST[kode_obat]',
                                        '$k[SellingPrice]',
                                        '$_POST[qty]',
                                        '$_POST[diskon]',
                                        '$subdiskon',
                                        '$_POST[biaya_jasa]',
                                        '$gtotal',
                                        '$today',
                                        '$_SESSION[username]',
                                        '$today',
                                        '$_SESSION[username]')");

        if ($simpan) {
            echo "<script>window.location='kasir-pasien';</script>";
        } else {
            echo "<script>alert('Data item gagal ditambah');</script>";
            echo "<script>window.location='kasir-pasien';</script>";
        }
    } else {
        $simpan = $koneksi->query("INSERT INTO rltn_transdrugsitem_tmp (TransDrugItemCode,
                                        SalesDrugsCode,
                                        EstablishCode,
                                        EstablishPrice,
                                        Unit,
                                        DiscPercent,
                                        Discount,
                                        ServicePrice,
                                        SubTotal,
                                        CreateAt,
                                        CreateBy,
                                        ModifiedAt,
                                        ModifiedBy) VALUES ('$kode_new',
                                        '$kode',
                                        '$_POST[kode_obat]',
                                        '$k[SellingPrice]',
                                        '$_POST[qty]',
                                        '$_POST[diskon]',
                                        '$subdiskon',
                                        '$_POST[biaya_jasa]',
                                        '$gtotal',
                                        '$today',
                                        '$_SESSION[username]',
                                        '$today',
                                        '$_SESSION[username]')");

        if ($simpan) {
            echo "<script>window.location='kasir-pasien';</script>";
        } else {
            echo "<script>alert('Data item gagal ditambah');</script>";
            echo "<script>window.location='kasir-pasien';</script>";
        }
    }
}
