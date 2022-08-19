<?php
session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";
include "../../config/fungsi_rupiah.php";
if (isset($_POST['update'])) {
    //get item detail
    $brg = $koneksi->query("SELECT * FROM mstr_obat WHERE EstablishCode = '$_POST[kode_barang]'");
    $data = mysqli_fetch_array($brg);
    $hitung = $data['SellingPrice'] * $_POST['qty'];
    $sub_diskon = ceil(($hitung * $_POST['diskon']) / 100);

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
    $subtotal = $hitung - $subdiskon;
    $total = $subtotal + $_POST['biaya_jasa'];

    //cek pembulatan total
    $cek2 = substr($total, -2);
    if ($cek2 == '00') {
        $rounding2 = $total;
    } else {
        $rounding2 = angka_pembulatan($total, 2, 100);
    }
    $gtotal = $rounding2;

    $modifiedat = date('Y-m-d H:i:s');
    $modifiedby = $_SESSION['username'];
    $ubah = $koneksi->query("UPDATE rltn_transdrugsitem_tmp SET EstablishCode = '$_POST[kode_barang]',
                                                                EstablishPrice = '$data[SellingPrice]',
                                                                DiscPercent = '$_POST[diskon]',
                                                                Discount = '$subdiskon',
                                                                Unit = '$_POST[qty]',
                                                                ServicePrice = '$_POST[biaya_jasa]',
                                                                SubTotal = '$gtotal',
                                                                ModifiedAt = '$modifiedat',
                                                                ModifiedBy = '$modifiedby'
																WHERE TransDrugItemId = '$_POST[id]'");
    if ($ubah) {
        echo "<script>alert('Update berhasil');</script>";
        echo "<script>window.location='../../kasir-umum';</script>";
    } else {
        echo "<script>alert('Update gagal');</script>";
        echo "<script>window.location='../../kasir-umum';</script>";
    }
}
