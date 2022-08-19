<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <br>
    <div class="container">
        <h2 class="alert alert-success text-center">
            Cara Input dan Tampil Data Tanpa Reload dengan Ajax Jquery
        </h2>
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <form id="forminput">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Cara Bayar</label>
                                <input type="hidden" name="tgl_bayar" id="tgl_bayar" class="form-control" value="<?php echo $k['RegisterAt']; ?>" readonly>
                                <input type="hidden" class="form-control" name="no_invoice" id="no_invoice" value="<?php echo $k['SalesDrugsNumber']; ?>" readonly>
                                <input type="hidden" class="form-control" name="no_reg" id="no_reg" value="<?php echo $k['SalesDrugsCode']; ?>" readonly>
                                <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $k['SalesDrugsCode']; ?>" readonly>
                                <select name="bayar" id="bayar" OnChange="OnChange(this.value)" onKeyPress="return isNumberKey(event)" class="form-control">
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
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nama Bank</label>
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
                            <div class="form-group">
                                <label for="exampleInputPassword1">Card No.</label>
                                <input type="text" name="kartu" value="-" class="form-control" onKeyPress="return isNumberKey(event)">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Total Bayar</label>
                                <input type="text" class="form-control" id="totbay" name="totbay" value="<?php echo $k['GrandTotalPayment']; ?>" readonly>
                                <input type="hidden" class="form-control" id="totbay2" name="totbay2" value="<?php echo $k['GrandTotalPayment']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Jumlah Bayar</label>
                                <input type="text" class="form-control" id="jumbay" name="jumbay" value="<?php echo $k['GrandTotalPayment']; ?>" onfocusout="jumlah()">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Kembali</label>
                                <input type="text" class="form-control" id="kembali" name="kembali" value="0" readonly>
                            </div>
                            <!-- -->
                            <!-- -->

                            <button type="submit" id="tombol-simpan" class="btn btn-primary">Bayar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div id="tabeldata">

                </div>
            </div>
            <script type="text/javascript" language="Javascript">
                function jumlah() {

                    var totbay = document.getElementById('totbay').value;
                    var jumbay = document.getElementById('jumbay').value;
                    var kembali = parseInt(totbay) - parseInt(jumbay);

                    document.getElementById('kembali').value = kembali;
                }

                /*function OnFocusOut(value) {
                    totbay = document.forminput.totbay.value;
                    jml = document.forminput.jumbay.value;
                    grand = parseInt(jml) - parseInt(total);
                    document.forminput.kembali.value = grand;
                }*/
            </script>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>

    <script>
        $(document).ready(function() {
            update();
        });
        $("#tombol-simpan").click(function() {
            //validasi form
            $('#forminput').validate({
                rules: {
                    bayar: {
                        required: true
                    },
                    totbay: {
                        required: true
                    },
                    delivery: {
                        required: true
                    }
                },
                //jika validasi sukses maka lakukan
                submitHandler: function(form) {
                    $.ajax({
                        type: 'POST',
                        url: "simpan.php",
                        data: $('#forminput').serialize(),
                        success: function() {
                            //setelah simpan data, update data terbaru
                            update()
                        }
                    });
                    //kosongkan form nama dan jurusan
                    var totbay = document.getElementById('totbay').value;
                    var jumbay = document.getElementById('jumbay').value;
                    var kembali = parseInt(totbay) - parseInt(jumbay);

                    document.getElementById('totbay').value = kembali;
                    document.getElementById("jumbay").value = "0";
                    document.getElementById("kembali").value = "0";
                    return false;
                }
            });
        });

        //fungsi tampil data
        function update() {
            $.ajax({
                url: 'datamahasiswa.php?id=<?php echo $_GET['id']; ?>',
                type: 'get',
                success: function(data) {
                    $('#tabeldata').html(data);
                }
            });
        }
    </script>
</body>

</html>