<?php
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
$kueri1 = $koneksi->query("SELECT * FROM trxn_saledrugs WHERE SalesDrugsNumber = '$_GET[id]'");
$k1 = mysqli_fetch_array($kueri1);

function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " Belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " Puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " Seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " Ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " Seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " Ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " Juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " Milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " Trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}

function terbilang($nilai)
{
    if ($nilai < 0) {
        $hasil = "minus " . trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil;
}
?>
<style>
    body {
        font-size: 7pt;
        font-family: Draft, sans-serif;
    }

    h3 {
        font-size: 7pt;
        font-family: Draft, sans-serif;
    }

    div {
        font-size: 8.5pt;
        font-family: Draft, sans-serif;
    }

    strong {
        font-size: 9pt;
        font-family: Draft, sans-serif;
    }
</style>

<div class="ibox-content p-xl">
    <div class="row">
        <div class="col-sm-5 text-left">
            <img src="../../img/logo-jsc.jpeg">
        </div>
        <div class="col-sm-7 text-left">
            <h4>Kwitansi No.</h4>
            <h4 class="text-navy"> <?php echo $k1['SalesDrugsNumber']; ?></h4>
            <span>Sudah Terima dari:</span>
            <address>
                <strong><input type="text" value="<?php echo $k1['CustomerName']; ?>" style="background-color: transparent; resize: none; outline: none;"></strong>
            </address>

            <span>Untuk Pembayaran : </span>
            <address>
                <strong>
                    <?php echo (' Pembelian dengan no. resep ' . $k1['DrugsReceiveNumb']) ?>
                </strong>
            </address>

            <span>Terbilang :</span>
            <address>
                <strong><b><?php echo terbilang($k1['GrandTotalPayment']); ?> Rupiah</b>
                </strong>
            </address>
            <span>Jumlah Rp. :</span>
            <address>
                <strong><b>Rp. <?php echo format_rupiah($k1['GrandTotalPayment']); ?></b></strong>
            </address>
        </div>
    </div>
    <p></p>
    <div class="row">
        <div>
            Jakarta, <?php echo date('d M Y'); ?><br>
            <br>
            <br>
            <br>
            <br>
            <br>
            (<b><?php echo $k1['CustomerName']; ?></b>)
        </div>
    </div>
    <div class="well m-t"><strong>Comments</strong>
        Terima Kasih atas kunjungan anda
    </div>
</div>