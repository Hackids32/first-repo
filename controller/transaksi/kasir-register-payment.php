<?php
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<script>window.location='index.php';</script>";
} else {
    $total = 0;
    $kueri = $koneksi->query("SELECT * FROM trxn_saledrugs WHERE SalesDrugsCode = '$_GET[id]' ORDER BY SaleDrugsId DESC LIMIT 1");
    $k = mysqli_fetch_array($kueri);
    $kueri2 = $koneksi->query("SELECT * FROM rltn_transdrugsitem_tmp WHERE SalesDrugsCode = '$_GET[id]'");
    while ($l = mysqli_fetch_array($kueri2)) {
        $total = $total + $l['SubTotal'];
    }
?>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Pembayaran</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="row">

                            <div class="col-md-12">

                                <!-- Calculate -->
                                <form id="formD" name="formD" action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="font-normal"><b>No. Invoice:</b></label>
                                                <div class="input-group date">
                                                    <?php echo $k['SalesDrugsNumber']; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="font-normal"><b>Total:</b></label>
                                                <div class="input-group date">
                                                    Rp. <?php echo format_rupiah($total); ?>
                                                    <input type="hidden" name="total" class="form-control" value="<?php echo $total; ?>">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="font-normal"><b>No. Reg:</b></label>
                                                <div class="input-group date">
                                                    <?php echo $k['SalesDrugsCode']; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="font-normal"><b>Delivery:</b></label>
                                                <div class="input-group date">
                                                    <select name="delivery" OnChange="OnChange(this.value)" onKeyPress="return isNumberKey(event)" class="form-control">
                                                        <option value="" selected>-- Biaya Kirim --</option>
                                                        <option value="0">Rp. 0</option>
                                                        <option value="15000">Rp. 15.000</option>
                                                        <option value="20000">Rp. 20.000</option>
                                                        <option value="25000">Rp. 25.000</option>
                                                        <option value="30000">Rp. 30.000</option>
                                                        <option value="35000">Rp. 35.000</option>
                                                        <option value="40000">Rp. 40.000</option>
                                                        <option value="45000">Rp. 45.000</option>
                                                        <option value="50000">Rp. 50.000</option>
                                                        <option value="55000">Rp. 55.000</option>
                                                        <option value="60000">Rp. 60.000</option>
                                                        <option value="65000">Rp. 65.000</option>
                                                        <option value="70000">Rp. 70.000</option>
                                                        <option value="75000">Rp. 75.000</option>
                                                        <option value="80000">Rp. 80.000</option>
                                                        <option value="85000">Rp. 85.000</option>
                                                        <option value="90000">Rp. 90.000</option>
                                                        <option value="95000">Rp. 95.000</option>
                                                        <option value="100000">Rp. 100.000</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="font-normal"><b>Tanggal:</b></label>
                                                <div class="input-group date">
                                                    <?php echo $k['CreateAt']; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="font-normal"><b>Total Bayar:</b></label>
                                                <div class="input-group date">
                                                    <input type="text" name="grand" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <hr>

                                <form method="POST" action="">
                                    <button type="submit" name="simpan" value="simpan" class="btn btn-primary">Proses Bayar</button>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="font-normal"><b>Cara Bayar:</b></label>
                                                <div class="input-group date">
                                                    <select name="bayar" OnChange="OnChange(this.value)" onKeyPress="return isNumberKey(event)" class="form-control">
                                                        <?php
                                                        $cara = $koneksi2->query("SELECT * FROM mstr_jenis_bayar ORDER BY id ASC");
                                                        while ($b = mysqli_fetch_array($cara)) {
                                                        ?>
                                                            <option value="<?php echo $b['id']; ?>"><?php echo $b['nama']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="font-normal"><b>Nama Bank:</b></label>
                                                <div class="input-group date">
                                                    <select name="bank" OnChange="OnChange(this.value)" onKeyPress="return isNumberKey(event)" class="form-control">
                                                        <option value="0" selected>-- Opsional --</option>
                                                        <?php
                                                        $bank = $koneksi2->query("SELECT * FROM mstr_bank ORDER BY id ASC");
                                                        while ($c = mysqli_fetch_array($bank)) {
                                                        ?>
                                                            <option value="<?php echo $c['id']; ?>"><?php echo $c['bank']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="font-normal"><b>Card No:</b></label>
                                                <div class="input-group date">
                                                    <input type="text" name="kartu" value="-" class="form-control" OnFocusOut="OnFocusOut(this.value)" onKeyPress="return isNumberKey(event)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="font-normal"><b>Jumlah Bayar:</b></label>
                                                <div class="input-group date">
                                                    <input type="text" name="kartu2" value="-" class="form-control" onKeyPress="return isNumberKey(event)">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="font-normal"><b>&nbsp;</b></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="font-normal"><b>Kembali:</b></label>
                                                <div class="input-group date">
                                                    <input type="text" name="kembali" value="0" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                                <!--End of Calculate -->
                            </div>
                        </div>

                        <script type="text/javascript" language="Javascript">
                            function OnChange(value) {
                                total = document.formD.total.value;
                                delivery = document.formD.delivery.value;
                                grand = parseInt(total) + parseInt(delivery);
                                document.formD.grand.value = grand;
                                //document.formD.jml_bayar2.value = jml_bayar2;
                                //kembali1 = parseInt(total) + parseInt(delivery);
                                //kembali2 = parseInt(jml_bayar2);

                                //jml_bayar2 = document.formD.jml_bayar2.value;
                                //$jml_bayar3 = parseInt(jml_bayar) + parseInt(jml_bayar2);
                                //kembali = (parseInt(total) + parseInt(delivery)) - (parseInt(jml_bayar_) + parseInt(jml_bayar2));

                                /*bayar = document.formD.bayar.value;
                                bank = document.formD.bank.value;
                                bayar2 = document.formD.bayar2.value;
                                bank2 = document.formD.bank2.value;
                                document.formD.grand.value = grand;

                                document.formD.kembali.value = kembali2;
                                document.formD2.grand2.value = grand;
                                document.formD2.delivery2.value = delivery;
                                document.formD2.bayar3.value = bayar;
                                document.formD2.bank3.value = bank;
                                document.formD2.bayar4.value = bayar2;
                                document.formD2.bank4.value = bank2;*/
                            }

                            function OnFocusOut(value) {
                                total = document.formD.total.value;
                                delivery = document.formD.delivery.value;
                                kartu = document.formD.kartu.value;
                                kembali = parseInt(total) + parseInt(delivery);
                                jml_bayar = document.formD.total.value;
                                kartu2 = document.formD.kartu2.value;
                                jml_bayar2 = document.formD.jml_bayar2.value;
                                jml_bayar_ = document.formD.jml_bayar_.value;
                                document.formD.kembali.value = kembali;
                                document.formD2.kartu3.value = kartu;
                                document.formD2.kartu4.value = kartu2;
                                document.formD2.jml_bayar3.value = jml_bayar;
                                document.formD2.jml_bayar4.value = jml_bayar2;
                            }
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
<script>
    // Retrieve
    document.getElementById("no_pasien").value = localStorage.getItem("no_pasien");
    document.getElementById("nama").value = localStorage.getItem("nama");
    document.getElementById("hp").value = localStorage.getItem("hp");
</script>