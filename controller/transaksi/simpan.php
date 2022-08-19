<?php
include "../../config/koneksi2.php";

$no_invoice = $_POST['no_invoice'];
$no_reg = $_POST['no_reg'];
$bayar       = $_POST['bayar'];
$bank = $_POST['bank'];
$kartu    = $_POST['kartu'];
$tgl = $_POST['tgl_bayar'];
$jumlah = $_POST['totbay'];
$uang = $_POST['jumbay'];
$kembali = $_POST['kembali'];
//jika pengembalian
if ($bayar == '8') {
    $uangg = '-' . $uang;
    $kembali = $jumlah - $uangg;
    $insert = $koneksi2->query("insert into trxn_pembayaran (no_invoice,no_reg,tgl,jumlah,type,card,bank,uang,kembali) VALUES ('$no_invoice','$no_reg','$tgl','$jumlah','$bayar','$kartu','$bank','$uangg','$kembali')");
} else {
    if ($kembali < 0) {
        $kalimat = $kembali;
        $kembalian = substr($kalimat, 1);
        $insert = $koneksi2->query("insert into trxn_pembayaran (no_invoice,no_reg,tgl,jumlah,type,card,bank,uang,kembali) VALUES ('$no_invoice','$no_reg','$tgl','$jumlah','$bayar','$kartu','$bank','$uang','$kembalian')");
    } elseif ($kembali > 0) {
        $insert = $koneksi2->query("insert into trxn_pembayaran (no_invoice,no_reg,tgl,jumlah,type,card,bank,uang,kembali) VALUES ('$no_invoice','$no_reg','$tgl','$jumlah','$bayar','$kartu','$bank','$uang','$kembali')");
    } elseif ($kembali == 0) {
        $insert = $koneksi2->query("insert into trxn_pembayaran (no_invoice,no_reg,tgl,jumlah,type,card,bank,uang,kembali) VALUES ('$no_invoice','$no_reg','$tgl','$jumlah','$bayar','$kartu','$bank','$uang','$kembali')");
    }
}
