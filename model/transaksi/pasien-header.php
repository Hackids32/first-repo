<?php
session_start();
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<script>window.location='index.php';</script>";
} else {
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

    $kueri = $koneksi->query("SELECT * FROM trxn_saledrugs ORDER BY SaleDrugsId DESC LIMIT 1");
    $k = mysqli_fetch_array($kueri);
    $sub = substr($k['SalesDrugsCode'], -5);
    $sub2 = $sub + 1;
    $pad = str_pad($sub2, 5, "0", STR_PAD_LEFT);
    $pad2 = str_pad($sub2, 6, "0", STR_PAD_LEFT);
    $kode = date('ymd') . ' ' . $pad . $pad2;
    $kode2 = date('ymd') . ' ' . $pad;
    $_SESSION['id_register'] = $kode2;

    //cek status header
    $cekstatus = $koneksi->query("SELECT * FROM trxn_saledrugs WHERE SalesDrugsCode = '$_POST[id_register]'");
    $cek = mysqli_fetch_array($cekstatus);
    $c = mysqli_num_rows($cekstatus);
    if ($c == 0) {
        $hari = $_POST['tgl_input'];
        $jam = date('H:i:s');
        $today = $hari . ' ' . $jam;
        //$subtotal = ($k['SellingPrice'] + $_POST['biaya_jasa']) - $_POST['diskon'];

        $dokter = $koneksi2->query("SELECT * FROM mstr_dokter WHERE no_dokter = '$_POST[id_dokter]'");
        $d = mysqli_fetch_array($dokter);
        $pasien = $koneksi2->query("SELECT * FROM mstr_pasien WHERE no_kartu = '$_POST[no_pasien]'");
        $p = mysqli_fetch_array($pasien);
        if (empty($_POST['id_dokter'])) {
            $no_dokter = '-';
            $nama_dokter = '-';
        } else {
            $no_dokter = $d['no_dokter'];
            $nama_dokter = $d['nama'];
        }

        $simpan = $koneksi->query("INSERT INTO trxn_saledrugs (SalesDrugsCode,
                                        SalesDrugsNumber,
                                        ReferenceNumber,
                                        Revisi,
                                        Status,
                                        PasienId,
                                        EmployeeId,
                                        CustomerName,
                                        CustomerType,
                                        GrandTotalPayment,
                                        DeliveryPayment,
                                        SalesPayment,
                                        InsufficientPayment,
                                        RegisterAt,
                                        CreateAt,
                                        CreateBy,
                                        ModifiedAt,
                                        ModifiedBy,
                                        DrugsReceiveNumb,
                                        no_dokter,
                                        namadokter,
                                        iter) VALUES ('$kode2',
                                        '$kode',
                                        '$kode',
                                        '0',
                                        '1',
                                        '$p[no_kartu]',
                                        '$_SESSION[username]',
                                        '$p[nama]',
                                        '3',
                                        '0',
                                        '0',
                                        '0',
                                        '0',
                                        '$hari',
                                        '$today',
                                        '$_SESSION[username]',
                                        '$today',
                                        '$_SESSION[username]',
                                        '$_POST[no_resep]',
                                        '$no_dokter',
                                        '$nama_dokter',
                                        '0')");

?>
        <script>
            // Set item
            var idreg = "<?php echo $kode2; ?>";
            localStorage.setItem("id_reg", idreg);
            window.location = 'kasir-pasien';
        </script>
        <?php
    } else {
        if ($cek['Status'] == '1') {
            echo "<script>alert('Maaf, pembayaran belum selesai');</script>";
            echo "<script>window.location='kasir-register';</script>";
        } else {
            $hari = $_POST['tgl_input'];
            $jam = date('H:i:s');
            $today = $hari . ' ' . $jam;
            //$subtotal = ($k['SellingPrice'] + $_POST['biaya_jasa']) - $_POST['diskon'];

            $dokter = $koneksi2->query("SELECT * FROM mstr_dokter WHERE no_dokter = '$_POST[id_dokter]'");
            $d = mysqli_fetch_array($dokter);
            $pasien = $koneksi2->query("SELECT * FROM mstr_pasien WHERE no_kartu = '$_POST[no_pasien]'");
            $p = mysqli_fetch_array($pasien);
            if (empty($_POST['id_dokter'])) {
                $no_dokter = '-';
                $nama_dokter = '-';
            } else {
                $no_dokter = $d['no_dokter'];
                $nama_dokter = $d['nama'];
            }

            $simpan = $koneksi->query("INSERT INTO trxn_saledrugs (SalesDrugsCode,
                                        SalesDrugsNumber,
                                        ReferenceNumber,
                                        Revisi,
                                        Status,
                                        PasienId,
                                        EmployeeId,
                                        CustomerName,
                                        CustomerType,
                                        GrandTotalPayment,
                                        DeliveryPayment,
                                        SalesPayment,
                                        InsufficientPayment,
                                        RegisterAt,
                                        CreateAt,
                                        CreateBy,
                                        ModifiedAt,
                                        ModifiedBy,
                                        DrugsReceiveNumb,
                                        no_dokter,
                                        namadokter,
                                        iter) VALUES ('$kode2',
                                        '$kode',
                                        '$kode',
                                        '0',
                                        '1',
                                        '$p[no_kartu]',
                                        '$_SESSION[username]',
                                        '$p[nama]',
                                        '3',
                                        '0',
                                        '0',
                                        '0',
                                        '0',
                                        '$hari',
                                        '$today',
                                        '$_SESSION[username]',
                                        '$today',
                                        '$_SESSION[username]',
                                        '$_POST[no_resep]',
                                        '$no_dokter',
                                        '$nama_dokter',
                                        '0')");

        ?>
            <script>
                // Set item
                var idreg = "<?php echo $kode2; ?>";
                localStorage.setItem("id_reg", idreg);
                window.location = 'kasir-pasien';
            </script>
<?php
        }
    }
}
?>