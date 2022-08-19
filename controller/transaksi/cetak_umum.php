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

    $kueri1 = $koneksi->query("SELECT * FROM trxn_saledrugs WHERE SalesDrugsCode = '$_GET[id]'");
    $k1 = mysqli_fetch_array($kueri1);
    $totalbeli = $k1['GrandTotalPayment'] - $k1['DeliveryPayment'];
?>
    <!DOCTYPE html>
    <html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>JSC </title>
        <link rel="stylesheet" type="text/css" href="../css/form.css" />
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">

        <link href="../css/animate.css" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet">
        <style type="text/css">
            body {
                background: rgb(204, 204, 204);

            }

            .table tbody tr td {
                border-top: none;
                padding: 1px;
            }

            .table thead tr th {
                text-align: center
            }

            page {
                background: white;
                display: block;
                margin: 0 auto;
                margin-top: 0.2cm;
                margin-bottom: 0.2cm;
                box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
                font-size: 10px;
                font-family: Draft, sans-serif;
            }

            page[size="A4"] {
                width: 21cm;
                height: 29.7cm;
            }

            page[size="A4"][layout="portrait"] {
                width: 29.7cm;
                height: 21cm;
            }

            page[size="A3"] {
                width: 29.7cm;
                height: 42cm;
            }

            page[size="A3"][layout="portrait"] {
                width: 42cm;
                height: 29.7cm;
            }

            page[size="A5"] {
                width: 14.8cm;
                height: 21cm;
            }

            page[size="A5"][layout="portrait"] {
                width: 21cm;
                height: 14.8cm;
            }

            page[size="STRUK"] {
                width: 14cm;
            }

            page[size="STRUK"][layout="portrait"] {
                width: 21cm;
                height: 13cm;
            }

            @media print {}

            @media print {

                body,
                page {
                    margin: 0;
                    box-shadow: 0;
                    font-size: 8px;
                }

                .col-sm-6 {
                    width: 40%;
                }

                @page[size="STRUK"] {
                    width: 14cm;
                    height: 21cm;
                }

                .col-sm-1,
                .col-sm-2,
                .col-sm-3,
                .col-sm-4,
                .col-sm-5,
                .col-sm-6,
                .col-sm-7,
                .col-sm-8,
                .col-sm-9,
                .col-sm-10,
                .col-sm-11,
                .col-sm-12 {
                    float: left;
                }

                .col-sm-12 {
                    width: 100%;
                }

                .col-sm-11 {
                    width: 91.66666667%;
                }

                .col-sm-10 {
                    width: 83.33333333%;
                }

                .col-sm-9 {
                    width: 75%;
                }

                .col-sm-8 {
                    width: 66.66666667%;
                }

                .col-sm-7 {
                    width: 58.33333333%;
                }

                .col-sm-6 {
                    width: 50%;
                }

                .col-sm-5 {
                    width: 41.66666667%;
                }

                .col-sm-4 {
                    width: 33.33333333%;
                }

                .col-sm-3 {
                    width: 25%;
                }

                .col-sm-2 {
                    width: 16.66666667%;
                }

                .col-sm-1 {
                    width: 8.33333333%;
                }

                .col-sm-pull-12 {
                    right: 100%;
                }

                .col-sm-pull-11 {
                    right: 91.66666667%;
                }

                .col-sm-pull-10 {
                    right: 83.33333333%;
                }

                .col-sm-pull-9 {
                    right: 75%;
                }

                .col-sm-pull-8 {
                    right: 66.66666667%;
                }

                .col-sm-pull-7 {
                    right: 58.33333333%;
                }

                .col-sm-pull-6 {
                    right: 50%;
                }

                .col-sm-pull-5 {
                    right: 41.66666667%;
                }

                .col-sm-pull-4 {
                    right: 33.33333333%;
                }

                .col-sm-pull-3 {
                    right: 25%;
                }

                .col-sm-pull-2 {
                    right: 16.66666667%;
                }

                .col-sm-pull-1 {
                    right: 8.33333333%;
                }

                .col-sm-pull-0 {
                    right: auto;
                }

                .col-sm-push-12 {
                    left: 100%;
                }

                .col-sm-push-11 {
                    left: 91.66666667%;
                }

                .col-sm-push-10 {
                    left: 83.33333333%;
                }

                .col-sm-push-9 {
                    left: 75%;
                }

                .col-sm-push-8 {
                    left: 66.66666667%;
                }

                .col-sm-push-7 {
                    left: 58.33333333%;
                }

                .col-sm-push-6 {
                    left: 50%;
                }

                .col-sm-push-5 {
                    left: 41.66666667%;
                }

                .col-sm-push-4 {
                    left: 33.33333333%;
                }

                .col-sm-push-3 {
                    left: 25%;
                }

                .col-sm-push-2 {
                    left: 16.66666667%;
                }

                .col-sm-push-1 {
                    left: 8.33333333%;
                }

                .col-sm-push-0 {
                    left: auto;
                }

                .col-sm-offset-12 {
                    margin-left: 100%;
                }

                .col-sm-offset-11 {
                    margin-left: 91.66666667%;
                }

                .col-sm-offset-10 {
                    margin-left: 83.33333333%;
                }

                .col-sm-offset-9 {
                    margin-left: 75%;
                }

                .col-sm-offset-8 {
                    margin-left: 66.66666667%;
                }

                .col-sm-offset-7 {
                    margin-left: 58.33333333%;
                }

                .col-sm-offset-6 {
                    margin-left: 50%;
                }

                .col-sm-offset-5 {
                    margin-left: 41.66666667%;
                }

                .col-sm-offset-4 {
                    margin-left: 33.33333333%;
                }

                .col-sm-offset-3 {
                    margin-left: 25%;
                }

                .col-sm-offset-2 {
                    margin-left: 16.66666667%;
                }

                .col-sm-offset-1 {
                    margin-left: 8.33333333%;
                }

                .col-sm-offset-0 {
                    margin-left: 0%;
                }

                .visible-xs {
                    display: none !important;
                }

                .hidden-xs {
                    display: block !important;
                }

                table.hidden-xs {
                    display: table;
                }

                tr.hidden-xs {
                    display: table-row !important;
                }

                th.hidden-xs,
                td.hidden-xs {
                    display: table-cell !important;
                }

                .hidden-xs.hidden-print {
                    display: none !important;
                }

                .hidden-sm {
                    display: none !important;
                }

                .visible-sm {
                    display: block !important;
                }

                table.visible-sm {
                    display: table;
                }

                tr.visible-sm {
                    display: table-row !important;
                }

                th.visible-sm,
                td.visible-sm {
                    display: table-cell !important;
                }
            }
        </style>

    </head>

    <body class="gray-bg">

        <!-- <div class="wrapper wrapper-content p-xl"> -->
        <page size="STRUK">
            <center><img src="../../img/logo-jsc.jpeg" width="50px" /></center>
            <center>No. Invoice: <?php echo $k1['SalesDrugsNumber']; ?></center>
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
                    <td width="50%" align="right">Invoice Date: <?php echo $k1['CreateAt']; ?></td>
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
                    <td width="5%" align="center"><b>No.</b></td>
                    <td width="60%" align="center"><b>Nama Obat</b></td>
                    <td width="10%" align="center"><b>Qty.</b></td>
                    <td width="25%" align="center"><b>Biaya</b></td>
                </tr>
                <?php
                $no = '1';
                $totaldiskon = 0;
                $kueri2 = $koneksi->query("SELECT * FROM rltn_transdrugsitem WHERE SalesDrugsCode = '$k1[SalesDrugsCode]'");
                while ($k2 = mysqli_fetch_array($kueri2)) {
                    //totaldiskon
                    $totaldiskon = $totaldiskon + $k2['Discount'];
                    $subtotal = $k2['SubTotal'] + $k2['Discount'];
                    $grandbeli = $totalbeli + $totaldiskon;
                    //obat
                    $kueri3 = $koneksi->query("SELECT * FROM mstr_obat WHERE EstablishCode = '$k2[EstablishCode]'");
                    $k3 = mysqli_fetch_array($kueri3);
                ?>
                    <tr>
                        <td width="5%" align="center"><?php echo $no; ?></td>
                        <td width="60%" align="center"><?php echo $k3['DrugsName']; ?></td>
                        <td width="10%" align="center"><?php echo $k2['Unit']; ?> (<?php echo $k3['Unit']; ?>)</td>
                        <td width="25%" align="center">Rp. <?php echo format_rupiah($subtotal); ?></td>
                    </tr>
                <?php
                    $no++;
                }
                ?>
            </table>
            <br>
            <b style="font-size: 10px;">Dibayar dengan:</b>
            <br>
            <table width="100%" style="font-size: 10px;">
                <tr>
                    <td width="15%" align="left" colspan="2">
                        <?php
                        $no = 1;
                        $kueri4 = $koneksi2->query("SELECT * FROM trxn_pembayaran WHERE no_reg = '$k1[SalesDrugsCode]'");
                        while ($k4 = mysqli_fetch_array($kueri4)) {
                            $kueri5 = $koneksi2->query("SELECT * FROM mstr_jenis_bayar WHERE id = '$k4[type]'");
                            $k5 = mysqli_fetch_array($kueri5);

                            if ($k4['bank'] == '-') {
                                $bank = "";
                            } elseif ($k4['bank'] == '0') {
                                $bank = "";
                            } else {
                                $kueri6 = $koneksi2->query("SELECT * FROM mstr_bank WHERE id = '$k4[bank]'");
                                $k6 = mysqli_fetch_array($kueri6);
                                $bank = $k6['bank'];
                            }
                        ?>
                            <?php echo $no; ?>. <b><?php echo $k5['nama']; ?> : Rp. <?php echo format_rupiah($k4['uang']); ?>&nbsp;&nbsp;&nbsp;</b><br>
                            <!--<b><?php echo $k5['nama']; ?> (cara bayar) | <?php echo $bank; ?> (bank): Rp. <?php echo format_rupiah($k4['uang']); ?>&nbsp;&nbsp;&nbsp;</b><br>-->
                        <?php
                            $no++;
                        }
                        ?>
                    </td>
                    <td width="15%" align="left"><b>Total Biaya</b></td>
                    <td width="35%" align="right">Rp. <?php echo format_rupiah($grandbeli); ?>&nbsp;&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td width="15%" align="left" colspan="2"><b>Kembali: Rp. <?php echo format_rupiah($k1['InsufficientPayment']); ?>&nbsp;&nbsp;&nbsp;</b></td>
                    <td width="15%" align="left"><b>Discount</b></td>
                    <td width="35%" align="right">Rp. <?php echo format_rupiah($totaldiskon); ?>&nbsp;&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td width="15%" align="left"></td>
                    <td width="35%" align="right"></td>
                    <td width="15%" align="left"><b>Delivery</b></td>
                    <td width="35%" align="right">Rp. <?php echo format_rupiah($k1['DeliveryPayment']); ?>&nbsp;&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td width="15%" align="left"></td>
                    <td width="35%" align="right"></td>
                    <td width="15%" align="left"><b>Grand Total</b></td>
                    <td width="35%" align="right"><b>Rp. <?php echo format_rupiah($k1['GrandTotalPayment']); ?></b>&nbsp;&nbsp;&nbsp;</td>
                </tr>
            </table>
            <br>
            <br>
            <b style="font-size: 10px;">Catatan: Obat yang sudah dibeli tidak dapat ditukar / dikembalikan</b>
            <br>
        </page>
        <!-- </div> -->

        <!-- Mainly scripts 
        <script src="../js/jquery-2.1.1.js"></script>
        <script src="../js/bootstrap.min.js"></script>-->

    </body>

    </html>


    <script>
        window.print();
    </script>
<?php
}
?>