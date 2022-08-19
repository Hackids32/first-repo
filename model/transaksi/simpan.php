<?php
session_start();
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<script>window.location='index.php';</script>";
} else {
    if ($_POST['proses'] == 'payment') {
        include "../../config/koneksi.php";
        include "../../config/koneksi2.php";
        include "../../config/fungsi_kode_otomatis.php";
        include "../../config/class_paging.php";
        include "../../config/fungsi_rupiah.php";
        include "../../config/fungsi_indotgl.php";
        include "../../config/library.php";
        include "../../config/fungsi_combobox.php";
        include "../../config/fungsi_seo.php";
        include "../../config/fungsi_thumb.php";
        include "../../detect.php";

        $simpan4 = $koneksi->query("UPDATE trxn_saledrugs SET GrandTotalPayment = '$_POST[grand]',
                                                                    DeliveryPayment = '$_POST[delivery]' WHERE SalesDrugsCode = '$_POST[idr]'");
?>
        <script>
            localStorage.setItem("balance", "<?php echo $_POST['grand']; ?>");
        </script>
<?php
        if ($simpan4) {
            echo "<script>window.location='controller/transaksi/pay-umum.php?id=$_POST[idr]';</script>";
        } else {
            echo "<script>alert('Error, periksa kembali');</script>";
            echo "<script>window.location='edit-umum-$_POST[idr]';</script>";
        }
        //}
    } else {
        echo "tes";
    }
}
