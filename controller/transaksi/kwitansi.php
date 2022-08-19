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
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Kwitansi JSC</title>
    </head>
    <style type="text/css">
        /* Kode CSS Untuk PAGE ini dibuat oleh http://jsfiddle.net/2wk6Q/1/ */
        body {
            width: 100%;
            height: 90%;
            margin: 0;
            padding: 0;
            background-color: #D3D3D3;
            font: 10pt "Tahoma";
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 140mm;
            min-height: 157mm;
            padding: 10mm;
            margin: 3mm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .subpage {
            padding: 1cm;
            border: 5px #FAFAFA solid;
            height: 217mm;
            outline: 2cm #FAFAFA solid;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {

            html,
            body {
                width: 200mm;
                height: 207mm;
            }

            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }
    </style>

    <body>
        <div class="book">
            <div class="page">
                <!--<div class="subpage">-->
                <center><img src="../../img/logo-jsc.jpeg" width="50px" /></center>
                <center>No. Kwitansi: <?php echo $k1['SalesDrugsNumber']; ?></center>
                <hr>
                <table width="100%" border="0" style="font-size: 10px;">
                    <tr>
                        <td width="50%" align="left"><b>Jakarta Skin Center</b></td>
                        <td width="50%" align="right"><b><?php echo $k1['CustomerName']; ?></b></td>
                    </tr>
                    <tr>
                        <td width="50%" align="left">Jalan Radio Dalam Raya 9B</td>
                        <td width="50%" align="right">Telp: (Phone) 021</td>
                    </tr>
                    <tr>
                        <td width="50%" align="left">Jakarta Selatan</td>
                        <td width="50%" align="right">Dokter: <?php echo $k1['namadokter']; ?></td>
                    </tr>
                    <tr>
                        <td width="50%" align="left">Telp: (Phone) (021) 720-7777 / 725-2355</td>
                        <td width="50%" align="right">Tgl. Kwitansi: <?php echo $k1['CreateAt']; ?></td>
                    </tr>
                    <tr>
                        <td width="50%" align="left">Kasir: <?php echo $k1['CreateBy']; ?></td>
                        <td width="50%" align="right">No. Resep: <?php echo $k1['DrugsReceiveNumb']; ?></td>
                    </tr>
                </table>
                <hr>
                <br>
                <table width="100%" border="0" style="font-size: 10px;">
                    <tr>
                        <td>Sudah terima dari:<br><b><input type="text" value="<?php echo $k1['CustomerName']; ?>" style="background-color: transparent; resize: none; outline: none;"></b></td>
                    </tr>
                    <tr>
                        <td>Untuk Pembayaran:<br><b>Pembelian dengan no.resep</b></td>
                    </tr>
                    <tr>
                        <td>Terbilang:<br><b><?php echo terbilang($k1['GrandTotalPayment']); ?> Rupiah</b></td>
                    </tr>
                    <tr>
                        <td>Jumlah Biaya:<br><b>Rp. <?php echo format_rupiah($k1['GrandTotalPayment']); ?></b></td>
                    </tr>
                </table>
                <br>
                <p style="font-size: 10px;">Jakarta, <?php echo tgl_indo($k1['CreateAt']); ?></p>
                <br>
                <br>
                <br>
                <p style="font-size: 10px;">(<b><?php echo $k1['CustomerName']; ?></b>)</p>
                <b style="font-size: 10px;">Catatan: Obat yang sudah dibeli tidak dapat ditukar / dikembalikan</b>
                <br>
                <!--</div>-->
            </div>

        </div>
    </body>

    </html>
    <script>
        window.print();
    </script>
<?php
}
?>