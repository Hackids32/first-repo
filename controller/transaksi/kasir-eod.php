<?php
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<script>window.location='index.php';</script>";
} else {
    $today = date('Y-m-d');
    $kueri = $koneksi->query("SELECT * FROM trxn_saledrugs ORDER BY SaleDrugsId DESC LIMIT 1");
    $k = mysqli_fetch_array($kueri);
    $kueri1 = $koneksi2->query("SELECT * FROM trxn_pendapatan_detail WHERE tgl = '$today'");
    $k1 = mysqli_num_rows($kueri1);
    $k2 = mysqli_fetch_array($kueri1);
    if ($k1 == 0) {
?>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Laporan Kasir End of Day</h5>
                        </div>
                        <div class="ibox-content">

                            <form method="post" action="kasir-eod-cari">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <b>PT. Sarana Kirana Nirmala</b><br>
                                            106 Jalan Radio Dalam, 600/10<br>
                                            Jakarta Selatan, VT 11440<br>
                                            P: (123) 601-4590<br>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" id="data_1">
                                            <label class="font-normal"><b>Tgl. EoD</b></label>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" class="form-control" placeholder="2022-01-01" value="<?php echo date('Y'); ?>-<?php echo date('m'); ?>-<?php echo date('d'); ?>" name="tgl_input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="font-normal">&nbsp;</label><br>
                                            <div class="input-group">
                                                <button class="btn btn-primary" type="submit" name="cari"><i class="fa fa-search" aria-hidden="true"></i> Cari</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>

                            <div class="row">

                                <div class="col-md-12">
                                    <center>
                                        <h1>LAPORAN END OF DAY</h1>
                                        <b><?php echo tgl_indo($today); ?></b>
                                    </center>
                                    <br>
                                </div>

                            </div>

                            <form id="formD" name="formD" method="POST" action="">
                                <div class="row">

                                    <div class="col-md-6">
                                        <table width="100%" class="table">
                                            <tr>
                                                <td align="center"><b>No.</b></td>
                                                <td align="center"><b>Kasir</b></td>
                                                <td align="center"><b>Jenis</b></td>
                                                <td align="center"><b>Bayar</b></td>
                                                <td align="center"><b>Total</b></td>
                                            </tr>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $total = 0;
                                                $kueri1 = $koneksi->query("SELECT * FROM trxn_saledrugs WHERE RegisterAt = '$today' AND iter = '0'");
                                                while ($k1 = mysqli_fetch_array($kueri1)) {
                                                    if ($k1['CustomerType'] == '1') {
                                                        $tipe = "Pasien Register";
                                                    } elseif ($k1['CustomerType'] == '2') {
                                                        $tipe = "Pasien Umum";
                                                    } elseif ($k1['CustomerType'] == '3') {
                                                        $tipe = "Pasien";
                                                    }
                                                    //cek payment method
                                                    $kueri2 = $koneksi2->query("SELECT * FROM trxn_pembayaran, mstr_jenis_bayar WHERE trxn_pembayaran.type = mstr_jenis_bayar.id AND trxn_pembayaran.no_reg = '$k1[SalesDrugsCode]'");
                                                    $k2 = mysqli_fetch_array($kueri2);
                                                ?>
                                                    <tr>
                                                        <td><?php echo $no; ?></td>
                                                        <td><?php echo $k1['CreateBy']; ?></td>
                                                        <td>APOTIK-<?php echo $tipe; ?></td>
                                                        <td><?php echo $k2['nama']; ?></td>
                                                        <td align="right">Rp. <?php echo format_rupiah($k2['jumlah']); ?></td>
                                                    </tr>
                                                <?php
                                                    $no++;
                                                    $total = $total + $k2['jumlah'];
                                                }
                                                $tax = 0;
                                                $grand = $total + $tax;
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="4" align="right">Gross:</td>
                                                    <td align="right">Rp. <?php echo format_rupiah($total); ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" align="right">Sub Total:</td>
                                                    <td align="right">Rp. <?php echo format_rupiah($total); ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" align="right">Tax:</td>
                                                    <td align="right">Rp. 0</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" align="right">Total:</td>
                                                    <td align="right">Rp. <?php echo format_rupiah($grand); ?></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div class="col-md-6">
                                        <table class="table">
                                            <tr>
                                                <th width="25%">Gross:</th>
                                                <th width="25%"><input type="text" name="gross" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                                <th width="25%">Modal:</th>
                                                <th width="25%"><input type="text" name="modal" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                            </tr>
                                            <tr>
                                                <th width="25%">P 100.000:</th>
                                                <th width="25%"><input type="text" name="p100k" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                                <th width="25%">P 2.000:</th>
                                                <th width="25%"><input type="text" name="p2k" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                            </tr>
                                            <tr>
                                                <th width="25%">P 50.000:</th>
                                                <th width="25%"><input type="text" name="p50k" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                                <th width="25%">P 1.000:</th>
                                                <th width="25%"><input type="text" name="p1000" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                            </tr>
                                            <tr>
                                                <th width="25%">P 20.000:</th>
                                                <th width="25%"><input type="text" name="p20k" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                                <th width="25%">P 500:</th>
                                                <th width="25%"><input type="text" name="p500" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                            </tr>
                                            <tr>
                                                <th width="25%">P 10.000:</th>
                                                <th width="25%"><input type="text" name="p10k" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                                <th width="25%">P 200:</th>
                                                <th width="25%"><input type="text" name="p200" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                            </tr>
                                            <tr>
                                                <th width="25%">P 5.000:</th>
                                                <th width="25%"><input type="text" name="p5k" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                                <th width="25%">P 100:</th>
                                                <th width="25%"><input type="text" name="p100" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                            </tr>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3" align="right">Gross Rp:</td>
                                                    <td align="right"><input type="text" name="gross2" value="0" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" align="right">Sub Total Rp:</td>
                                                    <td align="right"><input type="text" id="sub" name="subtotal" value="0" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" align="right">Modal Rp:</td>
                                                    <td align="right"><input type="text" name="modal2" value="0" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" align="right">Total Rp:</td>
                                                    <td align="right"><input type="text" name="grandtotal" value="0" readonly></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div class="col-md-12">
                                        <button style="float:right;" type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-check-square-o" aria-hidden="true"></i> Closing</button>
                                    </div>

                                </div>
                            </form>
                            <?php
                            if (isset($_POST['simpan'])) {
                                $today = date('Y-m-d');
                                $todays = date('Y-m-d H:i:s');
                                //check shift
                                $kueri1 = $koneksi2->query("SELECT * FROM trxn_pendapatan_detail WHERE tgl = '$today'");
                                $k1 = mysqli_num_rows($kueri1);
                                $k2 = mysqli_fetch_array($kueri1);
                                if ($k1 == 0) {
                                    $simpan = $koneksi2->query("INSERT INTO trxn_pendapatan_detail (klinik_id,
                                                                                                tgl,
                                                                                                gross,
                                                                                                p100000,
                                                                                                p50000,
                                                                                                p20000,
                                                                                                p10000,
                                                                                                p5000,
                                                                                                p2000,
                                                                                                p1000,
                                                                                                p500,
                                                                                                p200,
                                                                                                p100,
                                                                                                keterangan,
                                                                                                status,
                                                                                                createAt,
                                                                                                createBy,
                                                                                                modifiedAt,
                                                                                                modifiedBy) VALUES ('3',
                                                                                                '$today',
                                                                                                '$_POST[grandtotal]',
                                                                                                '$_POST[p100k]',
                                                                                                '$_POST[p50k]',
                                                                                                '$_POST[p20k]',
                                                                                                '$_POST[p10k]',
                                                                                                '$_POST[p5k]',
                                                                                                '$_POST[p2k]',
                                                                                                '$_POST[p1000]',
                                                                                                '$_POST[p500]',
                                                                                                '$_POST[p200]',
                                                                                                '$_POST[p100]',
                                                                                                '',
                                                                                                '1',
                                                                                                '$todays',
                                                                                                '$_SESSION[namauser]',
                                                                                                '$todays',
                                                                                                '$_SESSION[namauser]')");
                                    //update
                                    $update = $koneksi->query("UPDATE trxn_saledrugs SET iter = '1' WHERE RegisterAt = '$today' AND iter = '0'");
                                    if ($simpan) {
                                        echo "<script>window.location='kasir-eod';</script>";
                                    }
                                } else {
                                    if ($k2['createBy'] == $_SESSION['namauser']) {
                                        echo "<script>alert('Maaf, end of day sudah closing');</script>";
                                        echo "<script>window.location='kasir-eod';</script>";
                                    } else {
                                        $simpan = $koneksi2->query("INSERT INTO trxn_pendapatan_detail (klinik_id,
                                                                                                tgl,
                                                                                                gross,
                                                                                                p100000,
                                                                                                p50000,
                                                                                                p20000,
                                                                                                p10000,
                                                                                                p5000,
                                                                                                p2000,
                                                                                                p1000,
                                                                                                p500,
                                                                                                p200,
                                                                                                p100,
                                                                                                keterangan,
                                                                                                status,
                                                                                                createAt,
                                                                                                createBy,
                                                                                                modifiedAt,
                                                                                                modifiedBy) VALUES ('3',
                                                                                                '$today',
                                                                                                '$_POST[grandtotal]',
                                                                                                '$_POST[p100k]',
                                                                                                '$_POST[p50k]',
                                                                                                '$_POST[p20k]',
                                                                                                '$_POST[p10k]',
                                                                                                '$_POST[p5k]',
                                                                                                '$_POST[p2k]',
                                                                                                '$_POST[p1000]',
                                                                                                '$_POST[p500]',
                                                                                                '$_POST[p200]',
                                                                                                '$_POST[p100]',
                                                                                                '',
                                                                                                '2',
                                                                                                '$todays',
                                                                                                '$_SESSION[namauser]',
                                                                                                '$todays',
                                                                                                '$_SESSION[namauser]')");
                                        //update
                                        $update = $koneksi->query("UPDATE trxn_saledrugs SET iter = '1' WHERE RegisterAt = '$today' AND iter = '0'");

                                        if ($simpan) {
                                            echo "<script>window.location='kasir-eod';</script>";
                                        }
                                    }
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" language="Javascript">
            function OnBlur(value) {
                gross = document.formD.gross.value;
                modal = document.formD.modal.value;
                //100rb
                p100k = document.formD.p100k.value;
                hitung_p100k = parseInt(100000) * parseInt(p100k);
                //50rb
                p50k = document.formD.p50k.value;
                hitung_p50k = parseInt(50000) * parseInt(p50k);
                //20rb
                p20k = document.formD.p20k.value;
                hitung_p20k = parseInt(20000) * parseInt(p20k);
                //10rb
                p10k = document.formD.p10k.value;
                hitung_p10k = parseInt(10000) * parseInt(p10k);
                //5rb
                p5k = document.formD.p5k.value;
                hitung_p5k = parseInt(5000) * parseInt(p5k);
                //2rb
                p2k = document.formD.p2k.value;
                hitung_p2k = parseInt(2000) * parseInt(p2k);
                //1rb
                p1000 = document.formD.p1000.value;
                hitung_p1000 = parseInt(1000) * parseInt(p1000);
                //500
                p500 = document.formD.p500.value;
                hitung_p500 = parseInt(500) * parseInt(p500);
                //200
                p200 = document.formD.p200.value;
                hitung_p200 = parseInt(200) * parseInt(p200);
                //100
                p100 = document.formD.p100.value;
                hitung_p100 = parseInt(100) * parseInt(p100);
                //subtotal
                hitung = parseInt(hitung_p100k) + parseInt(hitung_p50k) + parseInt(hitung_p20k) + parseInt(hitung_p10k) + parseInt(hitung_p5k) + parseInt(hitung_p2k) + parseInt(hitung_p1000) + parseInt(hitung_p500) + parseInt(hitung_p200) + parseInt(hitung_p100);
                //grandtotal
                hitung2 = parseInt(hitung) - parseInt(modal);
                document.formD.gross2.value = gross;
                document.formD.modal2.value = modal;
                document.formD.subtotal.value = hitung;
                document.formD.grandtotal.value = hitung2;

                let html = document.getElementById("sub").value;
                document.getElementById("subtotal").innerHTML = html;

                //format nominal
                var rupiah = document.getElementById("subtotal");
                rupiah.addEventListener("keyup", function(e) {
                    // tambahkan 'Rp.' pada saat form di ketik
                    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                    rupiah.value = formatRupiah(this.value, "Rp. ");
                });

                /* Fungsi formatRupiah */
                function formatRupiah(angka, prefix) {
                    var number_string = angka.replace(/[^,\d]/g, '').toString(),
                        split = number_string.split(','),
                        sisa = split[0].length % 3,
                        rupiah = split[0].substr(0, sisa),
                        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                    // tambahkan titik jika yang di input sudah menjadi angka ribuan
                    if (ribuan) {
                        separator = sisa ? '.' : '';
                        rupiah += separator + ribuan.join('.');
                    }

                    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
                }
            }
        </script>
        <script>
            // Retrieve
            document.getElementById("no_pasien").value = localStorage.getItem("no_pasien");
            document.getElementById("nama").value = localStorage.getItem("nama");
            document.getElementById("hp").value = localStorage.getItem("hp");
        </script>
        <?php
    } else {
        if ($k2['createBy'] == $_SESSION['namauser']) {
        ?>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>Laporan Kasir End of Day</h5>
                            </div>
                            <div class="ibox-content">

                                <form method="post" action="kasir-eod-cari">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <b>PT. Sarana Kirana Nirmala</b><br>
                                                106 Jalan Radio Dalam, 600/10<br>
                                                Jakarta Selatan, VT 11440<br>
                                                P: (123) 601-4590<br>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group" id="data_1">
                                                <label class="font-normal"><b>Tgl. EoD</b></label>
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" placeholder="2022-01-01" value="<?php echo date('Y'); ?>-<?php echo date('m'); ?>-<?php echo date('d'); ?>" name="tgl_input" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="font-normal">&nbsp;</label><br>
                                                <div class="input-group">
                                                    <button class="btn btn-primary" type="submit" name="cari"><i class="fa fa-search" aria-hidden="true"></i> Cari</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </form>

                                <div class="row">

                                    <div class="col-md-12">
                                        <center>
                                            <h1>LAPORAN END OF DAY <span style="color:red;">[Closed]</span></h1>
                                            <b><?php echo tgl_indo($today); ?></b>
                                        </center>
                                        <br>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <table width="100%" class="table">
                                            <tr>
                                                <td align="center"><b>No.</b></td>
                                                <td align="center"><b>Kasir</b></td>
                                                <td align="center"><b>Jenis</b></td>
                                                <td align="center"><b>Bayar</b></td>
                                                <td align="center"><b>Total</b></td>
                                            </tr>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $total = 0;
                                                $kueri1 = $koneksi->query("SELECT * FROM trxn_saledrugs WHERE RegisterAt = '$today' AND iter = '0'");
                                                while ($k1 = mysqli_fetch_array($kueri1)) {
                                                    if ($k1['CustomerType'] == '1') {
                                                        $tipe = "Pasien Register";
                                                    } elseif ($k1['CustomerType'] == '2') {
                                                        $tipe = "Pasien Umum";
                                                    } elseif ($k1['CustomerType'] == '3') {
                                                        $tipe = "Pasien";
                                                    }
                                                    //cek payment method
                                                    $kueri2 = $koneksi2->query("SELECT * FROM trxn_pembayaran, mstr_jenis_bayar WHERE trxn_pembayaran.type = mstr_jenis_bayar.id AND trxn_pembayaran.no_reg = '$k1[SalesDrugsCode]'");
                                                    $k2 = mysqli_fetch_array($kueri2);
                                                ?>
                                                    <tr>
                                                        <td><?php echo $no; ?></td>
                                                        <td><?php echo $k1['CreateBy']; ?></td>
                                                        <td>APOTIK-<?php echo $tipe; ?></td>
                                                        <td><?php echo $k2['nama']; ?></td>
                                                        <td align="right">Rp. <?php echo format_rupiah($k2['jumlah']); ?></td>
                                                    </tr>
                                                <?php
                                                    $no++;
                                                    $total = $total + $k2['jumlah'];
                                                }
                                                $tax = 0;
                                                $grand = $total + $tax;
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="4" align="right">Gross:</td>
                                                    <td align="right">Rp. <?php echo format_rupiah($total); ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" align="right">Sub Total:</td>
                                                    <td align="right">Rp. <?php echo format_rupiah($total); ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" align="right">Tax:</td>
                                                    <td align="right">Rp. 0</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" align="right">Total:</td>
                                                    <td align="right">Rp. <?php echo format_rupiah($grand); ?></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div class="col-md-6">
                                        <table class="table">
                                            <tr>
                                                <th width="25%">Gross:</th>
                                                <th width="25%"><input type="text" name="gross" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                                <th width="25%">Modal:</th>
                                                <th width="25%"><input type="text" name="modal" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                            </tr>
                                            <tr>
                                                <th width="25%">P 100.000:</th>
                                                <th width="25%"><input type="text" name="p100k" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                                <th width="25%">P 2.000:</th>
                                                <th width="25%"><input type="text" name="p2k" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                            </tr>
                                            <tr>
                                                <th width="25%">P 50.000:</th>
                                                <th width="25%"><input type="text" name="p50k" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                                <th width="25%">P 1.000:</th>
                                                <th width="25%"><input type="text" name="p1000" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                            </tr>
                                            <tr>
                                                <th width="25%">P 20.000:</th>
                                                <th width="25%"><input type="text" name="p20k" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                                <th width="25%">P 500:</th>
                                                <th width="25%"><input type="text" name="p500" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                            </tr>
                                            <tr>
                                                <th width="25%">P 10.000:</th>
                                                <th width="25%"><input type="text" name="p10k" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                                <th width="25%">P 200:</th>
                                                <th width="25%"><input type="text" name="p200" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                            </tr>
                                            <tr>
                                                <th width="25%">P 5.000:</th>
                                                <th width="25%"><input type="text" name="p5k" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                                <th width="25%">P 100:</th>
                                                <th width="25%"><input type="text" name="p100" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                            </tr>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3" align="right">Gross Rp:</td>
                                                    <td align="right"><input type="text" name="gross2" value="0" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" align="right">Sub Total Rp:</td>
                                                    <td align="right"><input type="text" id="sub" name="subtotal" value="0" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" align="right">Modal Rp:</td>
                                                    <td align="right"><input type="text" name="modal2" value="0" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" align="right">Total Rp:</td>
                                                    <td align="right"><input type="text" name="grandtotal" value="0" readonly></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>Laporan Kasir End of Day</h5>
                            </div>
                            <div class="ibox-content">

                                <form method="post" action="kasir-eod-cari">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <b>PT. Sarana Kirana Nirmala</b><br>
                                                106 Jalan Radio Dalam, 600/10<br>
                                                Jakarta Selatan, VT 11440<br>
                                                P: (123) 601-4590<br>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group" id="data_1">
                                                <label class="font-normal"><b>Tgl. EoD</b></label>
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" placeholder="2022-01-01" value="<?php echo date('Y'); ?>-<?php echo date('m'); ?>-<?php echo date('d'); ?>" name="tgl_input" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="font-normal">&nbsp;</label><br>
                                                <div class="input-group">
                                                    <button class="btn btn-primary" type="submit" name="cari"><i class="fa fa-search" aria-hidden="true"></i> Cari</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </form>

                                <div class="row">

                                    <div class="col-md-12">
                                        <center>
                                            <h1>LAPORAN END OF DAY</h1>
                                            <b><?php echo tgl_indo($today); ?></b>
                                        </center>
                                        <br>
                                    </div>

                                </div>

                                <form id="formD" name="formD" method="POST" action="">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <table width="100%" class="table">
                                                <tr>
                                                    <td align="center"><b>No.</b></td>
                                                    <td align="center"><b>Kasir</b></td>
                                                    <td align="center"><b>Jenis</b></td>
                                                    <td align="center"><b>Bayar</b></td>
                                                    <td align="center"><b>Total</b></td>
                                                </tr>
                                                <tbody>
                                                    <?php
                                                    $no = 1;
                                                    $total = 0;
                                                    $kueri1 = $koneksi->query("SELECT * FROM trxn_saledrugs WHERE RegisterAt = '$today' AND iter = '0'");
                                                    while ($k1 = mysqli_fetch_array($kueri1)) {
                                                        if ($k1['CustomerType'] == '1') {
                                                            $tipe = "Pasien Register";
                                                        } elseif ($k1['CustomerType'] == '2') {
                                                            $tipe = "Pasien Umum";
                                                        } elseif ($k1['CustomerType'] == '3') {
                                                            $tipe = "Pasien";
                                                        }
                                                        //cek payment method
                                                        $kueri2 = $koneksi2->query("SELECT * FROM trxn_pembayaran, mstr_jenis_bayar WHERE trxn_pembayaran.type = mstr_jenis_bayar.id AND trxn_pembayaran.no_reg = '$k1[SalesDrugsCode]'");
                                                        $k2 = mysqli_fetch_array($kueri2);
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $no; ?></td>
                                                            <td><?php echo $k1['CreateBy']; ?></td>
                                                            <td>APOTIK-<?php echo $tipe; ?></td>
                                                            <td><?php echo $k2['nama']; ?></td>
                                                            <td align="right">Rp. <?php echo format_rupiah($k2['jumlah']); ?></td>
                                                        </tr>
                                                    <?php
                                                        $no++;
                                                        $total = $total + $k2['jumlah'];
                                                    }
                                                    $tax = 0;
                                                    $grand = $total + $tax;
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="4" align="right">Gross:</td>
                                                        <td align="right">Rp. <?php echo format_rupiah($total); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" align="right">Sub Total:</td>
                                                        <td align="right">Rp. <?php echo format_rupiah($total); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" align="right">Tax:</td>
                                                        <td align="right">Rp. 0</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" align="right">Total:</td>
                                                        <td align="right">Rp. <?php echo format_rupiah($grand); ?></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                        <div class="col-md-6">
                                            <table class="table">
                                                <tr>
                                                    <th width="25%">Gross:</th>
                                                    <th width="25%"><input type="text" name="gross" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                                    <th width="25%">Modal:</th>
                                                    <th width="25%"><input type="text" name="modal" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                                </tr>
                                                <tr>
                                                    <th width="25%">P 100.000:</th>
                                                    <th width="25%"><input type="text" name="p100k" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                                    <th width="25%">P 2.000:</th>
                                                    <th width="25%"><input type="text" name="p2k" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                                </tr>
                                                <tr>
                                                    <th width="25%">P 50.000:</th>
                                                    <th width="25%"><input type="text" name="p50k" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                                    <th width="25%">P 1.000:</th>
                                                    <th width="25%"><input type="text" name="p1000" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                                </tr>
                                                <tr>
                                                    <th width="25%">P 20.000:</th>
                                                    <th width="25%"><input type="text" name="p20k" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                                    <th width="25%">P 500:</th>
                                                    <th width="25%"><input type="text" name="p500" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                                </tr>
                                                <tr>
                                                    <th width="25%">P 10.000:</th>
                                                    <th width="25%"><input type="text" name="p10k" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                                    <th width="25%">P 200:</th>
                                                    <th width="25%"><input type="text" name="p200" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                                </tr>
                                                <tr>
                                                    <th width="25%">P 5.000:</th>
                                                    <th width="25%"><input type="text" name="p5k" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                                    <th width="25%">P 100:</th>
                                                    <th width="25%"><input type="text" name="p100" class="form-control" value="0" onkeypress="return hanyaAngka(event)" OnBlur="OnBlur(this.value)"></th>
                                                </tr>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3" align="right">Gross Rp:</td>
                                                        <td align="right"><input type="text" name="gross2" value="0" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" align="right">Sub Total Rp:</td>
                                                        <td align="right"><input type="text" id="sub" name="subtotal" value="0" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" align="right">Modal Rp:</td>
                                                        <td align="right"><input type="text" name="modal2" value="0" readonly></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" align="right">Total Rp:</td>
                                                        <td align="right"><input type="text" name="grandtotal" value="0" readonly></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                        <div class="col-md-12">
                                            <button style="float:right;" type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-check-square-o" aria-hidden="true"></i> Closing</button>
                                        </div>

                                    </div>
                                </form>
                                <?php
                                if (isset($_POST['simpan'])) {
                                    $today = date('Y-m-d');
                                    $todays = date('Y-m-d H:i:s');
                                    //check shift
                                    $kueri1 = $koneksi2->query("SELECT * FROM trxn_pendapatan_detail WHERE tgl = '$today'");
                                    $k1 = mysqli_num_rows($kueri1);
                                    $k2 = mysqli_fetch_array($kueri1);
                                    if ($k1 == 0) {
                                        $simpan = $koneksi2->query("INSERT INTO trxn_pendapatan_detail (klinik_id,
                                                                                                tgl,
                                                                                                gross,
                                                                                                p100000,
                                                                                                p50000,
                                                                                                p20000,
                                                                                                p10000,
                                                                                                p5000,
                                                                                                p2000,
                                                                                                p1000,
                                                                                                p500,
                                                                                                p200,
                                                                                                p100,
                                                                                                keterangan,
                                                                                                status,
                                                                                                createAt,
                                                                                                createBy,
                                                                                                modifiedAt,
                                                                                                modifiedBy) VALUES ('3',
                                                                                                '$today',
                                                                                                '$_POST[grandtotal]',
                                                                                                '$_POST[p100k]',
                                                                                                '$_POST[p50k]',
                                                                                                '$_POST[p20k]',
                                                                                                '$_POST[p10k]',
                                                                                                '$_POST[p5k]',
                                                                                                '$_POST[p2k]',
                                                                                                '$_POST[p1000]',
                                                                                                '$_POST[p500]',
                                                                                                '$_POST[p200]',
                                                                                                '$_POST[p100]',
                                                                                                '',
                                                                                                '1',
                                                                                                '$todays',
                                                                                                '$_SESSION[namauser]',
                                                                                                '$todays',
                                                                                                '$_SESSION[namauser]')");

                                        //update
                                        $update = $koneksi->query("UPDATE trxn_saledrugs SET iter = '1' WHERE RegisterAt = '$today' AND iter = '0'");
                                        if ($simpan) {
                                            echo "<script>window.location='kasir-eod';</script>";
                                        }
                                    } else {
                                        if ($k2['createBy'] == $_SESSION['namauser']) {
                                            echo "<script>alert('Maaf, end of day sudah closing');</script>";
                                            echo "<script>window.location='kasir-eod';</script>";
                                        } else {
                                            $simpan = $koneksi2->query("INSERT INTO trxn_pendapatan_detail (klinik_id,
                                                                                                tgl,
                                                                                                gross,
                                                                                                p100000,
                                                                                                p50000,
                                                                                                p20000,
                                                                                                p10000,
                                                                                                p5000,
                                                                                                p2000,
                                                                                                p1000,
                                                                                                p500,
                                                                                                p200,
                                                                                                p100,
                                                                                                keterangan,
                                                                                                status,
                                                                                                createAt,
                                                                                                createBy,
                                                                                                modifiedAt,
                                                                                                modifiedBy) VALUES ('3',
                                                                                                '$today',
                                                                                                '$_POST[grandtotal]',
                                                                                                '$_POST[p100k]',
                                                                                                '$_POST[p50k]',
                                                                                                '$_POST[p20k]',
                                                                                                '$_POST[p10k]',
                                                                                                '$_POST[p5k]',
                                                                                                '$_POST[p2k]',
                                                                                                '$_POST[p1000]',
                                                                                                '$_POST[p500]',
                                                                                                '$_POST[p200]',
                                                                                                '$_POST[p100]',
                                                                                                '',
                                                                                                '2',
                                                                                                '$todays',
                                                                                                '$_SESSION[namauser]',
                                                                                                '$todays',
                                                                                                '$_SESSION[namauser]')");

                                            //update
                                            $update = $koneksi->query("UPDATE trxn_saledrugs SET iter = '1' WHERE RegisterAt = '$today' AND iter = '0'");

                                            if ($simpan) {
                                                echo "<script>window.location='kasir-eod';</script>";
                                            }
                                        }
                                    }
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript" language="Javascript">
                function OnBlur(value) {
                    gross = document.formD.gross.value;
                    modal = document.formD.modal.value;
                    //100rb
                    p100k = document.formD.p100k.value;
                    hitung_p100k = parseInt(100000) * parseInt(p100k);
                    //50rb
                    p50k = document.formD.p50k.value;
                    hitung_p50k = parseInt(50000) * parseInt(p50k);
                    //20rb
                    p20k = document.formD.p20k.value;
                    hitung_p20k = parseInt(20000) * parseInt(p20k);
                    //10rb
                    p10k = document.formD.p10k.value;
                    hitung_p10k = parseInt(10000) * parseInt(p10k);
                    //5rb
                    p5k = document.formD.p5k.value;
                    hitung_p5k = parseInt(5000) * parseInt(p5k);
                    //2rb
                    p2k = document.formD.p2k.value;
                    hitung_p2k = parseInt(2000) * parseInt(p2k);
                    //1rb
                    p1000 = document.formD.p1000.value;
                    hitung_p1000 = parseInt(1000) * parseInt(p1000);
                    //500
                    p500 = document.formD.p500.value;
                    hitung_p500 = parseInt(500) * parseInt(p500);
                    //200
                    p200 = document.formD.p200.value;
                    hitung_p200 = parseInt(200) * parseInt(p200);
                    //100
                    p100 = document.formD.p100.value;
                    hitung_p100 = parseInt(100) * parseInt(p100);
                    //subtotal
                    hitung = parseInt(hitung_p100k) + parseInt(hitung_p50k) + parseInt(hitung_p20k) + parseInt(hitung_p10k) + parseInt(hitung_p5k) + parseInt(hitung_p2k) + parseInt(hitung_p1000) + parseInt(hitung_p500) + parseInt(hitung_p200) + parseInt(hitung_p100);
                    //grandtotal
                    hitung2 = parseInt(hitung) - parseInt(modal);
                    document.formD.gross2.value = gross;
                    document.formD.modal2.value = modal;
                    document.formD.subtotal.value = hitung;
                    document.formD.grandtotal.value = hitung2;

                    let html = document.getElementById("sub").value;
                    document.getElementById("subtotal").innerHTML = html;

                    //format nominal
                    var rupiah = document.getElementById("subtotal");
                    rupiah.addEventListener("keyup", function(e) {
                        // tambahkan 'Rp.' pada saat form di ketik
                        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                        rupiah.value = formatRupiah(this.value, "Rp. ");
                    });

                    /* Fungsi formatRupiah */
                    function formatRupiah(angka, prefix) {
                        var number_string = angka.replace(/[^,\d]/g, '').toString(),
                            split = number_string.split(','),
                            sisa = split[0].length % 3,
                            rupiah = split[0].substr(0, sisa),
                            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                        // tambahkan titik jika yang di input sudah menjadi angka ribuan
                        if (ribuan) {
                            separator = sisa ? '.' : '';
                            rupiah += separator + ribuan.join('.');
                        }

                        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
                    }
                }
            </script>
            <script>
                // Retrieve
                document.getElementById("no_pasien").value = localStorage.getItem("no_pasien");
                document.getElementById("nama").value = localStorage.getItem("nama");
                document.getElementById("hp").value = localStorage.getItem("hp");
            </script>
<?php
        }
    }
}
?>