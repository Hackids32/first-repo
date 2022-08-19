<?php
include "../../config/koneksi.php";
include "../../config/koneksi2.php";

$simpan2 = $koneksi->query("SELECT * FROM rltn_transdrugsitem_tmp WHERE SalesDrugsCode = '$_POST[no_reg]'");
while ($cp = mysqli_fetch_array($simpan2)) {
    $simpan3 = $koneksi->query("INSERT INTO rltn_transdrugsitem (TransDrugItemCode,
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
                                                                        ModifiedBy) VALUES ('$cp[TransDrugItemCode]',
                                                                        '$cp[SalesDrugsCode]',
                                                                        '$cp[EstablishCode]',
                                                                        '$cp[EstablishPrice]',
                                                                        '$cp[Unit]',
                                                                        '$cp[DiscPercent]',
                                                                        '$cp[Discount]',
                                                                        '$cp[ServicePrice]',
                                                                        '$cp[SubTotal]',
                                                                        '$cp[CreateAt]',
                                                                        '$cp[CreateBy]',
                                                                        '$cp[ModifiedAt]',
                                                                        '$cp[ModifiedBy]')");
    //update stok
    $obat = $koneksi->query("SELECT * FROM mstr_obat WHERE EstablishCode = '$cp[EstablishCode]'");
    $ob = mysqli_fetch_array($obat);
    $stok_obat = $ob['stok_awal'] - $cp['Unit'];
    $update_obat = $koneksi->query("UPDATE mstr_obat SET stok_awal = '$stok_obat' WHERE EstablishCode = '$cp[EstablishCode]'");
}
//delete temp
$del_tmp = $koneksi->query("DELETE FROM rltn_transdrugsitem_tmp");
//update header table
$kembali = $_POST['balance'];
if ($kembali < 0) {
    $kalimat = $kembali;
    $kembalian = substr($kalimat, 1);
    $update = $koneksi->query("UPDATE trxn_saledrugs SET Status = '2', SalesPayment = '$_POST[paid]', InsufficientPayment = '$kembalian' WHERE SalesDrugsCode = '$_POST[no_reg]'");
    if ($update) {
?>
        <script>
            // Delete first
            localStorage.clear();
        </script>
    <?php
        echo "<script>alert('Transaksi berhasil tersimpan');</script>";
        echo "<script>window.location='cetak_umum.php?id=$_POST[no_reg]';</script>";
    } else {
        echo "<script>alert('Transaksi gagal tersimpan');</script>";
        echo "<script>window.location='pay.php?$_POST[no_reg]';</script>";
    }
} elseif ($kembali > 0) {
    $update = $koneksi->query("UPDATE trxn_saledrugs SET Status = '2', SalesPayment = '$_POST[paid]', InsufficientPayment = '$_POST[balance]' WHERE SalesDrugsCode = '$_POST[no_reg]'");
    if ($update) {
    ?>
        <script>
            // Delete first
            localStorage.clear();
        </script>
    <?php
        echo "<script>alert('Transaksi berhasil tersimpan');</script>";
        echo "<script>window.location='cetak_umum.php?id=$_POST[no_reg]';</script>";
    } else {
        echo "<script>alert('Transaksi gagal tersimpan');</script>";
        echo "<script>window.location='pay.php?$_POST[no_reg]';</script>";
    }
} elseif ($kembali == 0) {
    $update = $koneksi->query("UPDATE trxn_saledrugs SET Status = '2', SalesPayment = '$_POST[paid]', InsufficientPayment = '$_POST[balance]' WHERE SalesDrugsCode = '$_POST[no_reg]'");
    if ($update) {
    ?>
        <script>
            // Delete first
            localStorage.clear();
        </script>
<?php
        echo "<script>alert('Transaksi berhasil tersimpan');</script>";
        echo "<script>window.location='cetak_umum.php?id=$_POST[no_reg]';</script>";
    } else {
        echo "<script>alert('Transaksi gagal tersimpan');</script>";
        echo "<script>window.location='pay.php?$_POST[no_reg]';</script>";
    }
}
