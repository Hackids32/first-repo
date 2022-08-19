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
    require_once("../../assets/phpmailer/class.smtp.php");
    require_once("../../assets/phpmailer/class.phpmailer.php");
    require '../../assets/phpmailer/PHPMailerAutoload.php';

    $total = 0;
    $jml = 0;
    $kueri = $koneksi->query("SELECT * FROM trxn_saledrugs WHERE SalesDrugsCode = '$_GET[id]' ORDER BY SaleDrugsId DESC LIMIT 1");
    $k = mysqli_fetch_array($kueri);
    $kueri2 = $koneksi->query("SELECT * FROM rltn_transdrugsitem_tmp WHERE SalesDrugsCode = '$_GET[id]'");
    while ($l = mysqli_fetch_array($kueri2)) {
        $total = $total + $l['SubTotal'];
    }
    //count pembayaran
    $kueri3 = $koneksi2->query("SELECT * FROM trxn_pembayaran WHERE no_reg = '$_GET[id]'");
    while ($m = mysqli_fetch_array($kueri3)) {
        $jml = $jml + $m['uang'];
    }
    $balance = $k['GrandTotalPayment'] - $jml;
?>
    <!DOCTYPE html>
    <html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>JSC System | v.2.4.9</title>

        <link href="../../css/bootstrap.min.css" rel="stylesheet">
        <link href="../../font-awesome/css/font-awesome.css" rel="stylesheet">

        <!-- DataTables -->
        <link href="../../css/plugins/dataTables/datatables.min.css" rel="stylesheet">

        <link href="../../css/plugins/iCheck/custom.css" rel="stylesheet">

        <link href="../../css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

        <link href="../../css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">

        <link href="../../css/plugins/cropper/cropper.min.css" rel="stylesheet">

        <link href="../../css/plugins/switchery/switchery.css" rel="stylesheet">

        <link href="../../css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet">

        <link href="../../css/plugins/datapicker/datepicker3.css" rel="stylesheet">

        <link href="../../css/plugins/ionRangeSlider/ion.rangeSlider.css" rel="stylesheet">

        <link href="../../css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

        <link href="../../css/plugins/clockpicker/clockpicker.css" rel="stylesheet">

        <link href="../../css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">

        <link href="../../css/plugins/select2/select2.min.css" rel="stylesheet">
        <link href="../../css/plugins/select2/select2-bootstrap4.min.css" rel="stylesheet">

        <link href="../../css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">

        <link href="../../css/plugins/dualListbox/bootstrap-duallistbox.min.css" rel="stylesheet">

        <link href="../../css/animate.css" rel="stylesheet">
        <link href="../../css/style.css" rel="stylesheet">


    </head>

    <body>

        <div id="wrapper">

            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu">
                        <li class="nav-header">
                            <div class="dropdown profile-element">
                                <img alt="image" class="rounded-circle" src="../../img/user.jpg" width="50px" />
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="block m-t-xs font-bold"><?php echo $_SESSION['username']; ?></span>
                                    <span class="text-muted text-xs block">Art Director <b class="caret"></b></span>
                                </a>
                                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                    <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                                    <li><a class="dropdown-item" href="contacts.html">Contacts</a></li>
                                    <li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li>
                                    <li class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="login.html">Logout</a></li>
                                </ul>
                            </div>
                            <div class="logo-element">
                                JSC
                            </div>
                        </li>
                        <li class="active">
                            <a href="../../dashboard"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Master</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li><a href="../../obat"><i class="fa fa-chevron-right" aria-hidden="true"></i> Obat</a></li>
                                <li><a href="../../stok-obat"><i class="fa fa-chevron-right" aria-hidden="true"></i> Stok Obat</a></li>
                                <li><a href="../../satuan-obat"><i class="fa fa-chevron-right" aria-hidden="true"></i> Satuan Obat</a></li>
                                <li><a href="../../distributor"><i class="fa fa-chevron-right" aria-hidden="true"></i> Distributor</a></li>
                                <li><a href="../../principle"><i class="fa fa-chevron-right" aria-hidden="true"></i> Prinsipal</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Transaksi</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li><a href="../../transaksi-kasir"><i class="fa fa-chevron-right" aria-hidden="true"></i> Kasir</a></li>
                                <li><a href="../../list-invoice"><i class="fa fa-chevron-right" aria-hidden="true"></i> List Invoice</a></li>
                                <li><a href="../../kasir-eod"><i class="fa fa-chevron-right" aria-hidden="true"></i> End of Day</a></li>
                                <li><a href="../../po"><i class="fa fa-chevron-right" aria-hidden="true"></i> Pemesanan Obat</a></li>
                                <li><a href="../../list-po"><i class="fa fa-chevron-right" aria-hidden="true"></i> Penerimaan Obat</a></li>
                                <li><a href="../../stok-opname"><i class="fa fa-chevron-right" aria-hidden="true"></i> Stock Opname</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-print"></i> <span class="nav-label">Report</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li><a href="../../graph_flot.html"><i class="fa fa-chevron-right" aria-hidden="true"></i> Stok Awal Tahun</a></li>
                                <li><a href="../../stok-obat"><i class="fa fa-chevron-right" aria-hidden="true"></i> Stok Penerimaan Penjualan</a></li>
                                <li><a href="../../satuan-obat"><i class="fa fa-chevron-right" aria-hidden="true"></i> Rekap Stok Obat</a></li>
                                <li><a href="../../distributor"><i class="fa fa-chevron-right" aria-hidden="true"></i> Pemesanan Obat</a></li>
                                <li><a href="../../prinsipal"><i class="fa fa-chevron-right" aria-hidden="true"></i> Penerimaan Obat</a></li>
                                <li><a href="../../prinsipal"><i class="fa fa-chevron-right" aria-hidden="true"></i> Penerimaan Kasir</a></li>
                                <li><a href="../../prinsipal"><i class="fa fa-chevron-right" aria-hidden="true"></i> Pembayaran</a></li>
                                <li><a href="../../prinsipal"><i class="fa fa-chevron-right" aria-hidden="true"></i> End of Day</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="../../rbac"><i class="fa fa-gears"></i> <span class="nav-label">Akses Kontrol</span></a>
                        </li>
                    </ul>

                </div>
            </nav>

            <div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom">
                    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header">
                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                            <ul class="nav navbar-top-links navbar-left">
                                <li>
                                    <span class="m-r-sm text-muted welcome-message">Hai <?php echo $_SESSION['username']; ?>, Welcome to JSC System
                                </li>

                                <li>
                                    <a href="../../logout">
                                        <i class="fa fa-sign-out"></i> Log out
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </nav>
                </div>
                <!--Start-->
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5>Transaksi Pembayaran</h5>
                                    <div class="ibox-tools">

                                    </div>
                                </div>
                                <div class="ibox-content">

                                    <div class="row">

                                        <div class="col-12">
                                            <div id="tabeldata">

                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <form id="forminput">
                                                        <div class="row">
                                                            <div class="col-md-2">
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
                                                            </div>
                                                            <div class="col-md-2">
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
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Card No.</label>
                                                                    <input type="text" name="kartu" value="-" class="form-control" onKeyPress="return isNumberKey(event)">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Total Bayar</label>
                                                                    <input type="text" class="form-control" id="totbay" name="totbay" value="<?php echo $k['GrandTotalPayment']; ?>" readonly>
                                                                    <input type="hidden" class="form-control" id="totbay2" name="totbay2" value="<?php echo $k['GrandTotalPayment']; ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Jumlah Bayar</label>
                                                                    <input type="text" class="form-control" id="jumbay" name="jumbay" value="<?php echo $k['GrandTotalPayment']; ?>" onfocusout="jumlah()">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Kembali</label>
                                                                    <input type="text" class="form-control" id="kembali" name="kembali" value="0" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- -->
                                                        <!-- -->

                                                        <button type="submit" id="tombol-simpan" class="btn btn-primary">Bayar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <script type="text/javascript" language="Javascript">
                                            function jumlah() {

                                                var totbay = document.getElementById('totbay').value;
                                                var jumbay = document.getElementById('jumbay').value;
                                                var kembali = parseInt(totbay) - parseInt(jumbay);

                                                document.getElementById('kembali').value = kembali;
                                            }

                                            // Retrieve
                                            document.getElementById("totbay").value = localStorage.getItem("balance");
                                            document.getElementById("totbay2").value = localStorage.getItem("balance");
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End-->
                <div class="footer fixed">
                    <div class="float-right">
                        version <strong>2.4.9</strong>
                    </div>
                    <div>
                        <strong>Copyright</strong> Jakarta Skin Center &copy; 2014-<?php echo date('Y'); ?>
                    </div>
                </div>

            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>
        <!--<script src="../../js/jquery.js"></script>
        <script src="../../js/jquery-3.1.1.min.js"></script>-->
        <script src="../../js/popper.min.js"></script>
        <script src="../../js/bootstrap.js"></script>
        <script src="../../js/inspinia.js"></script>
        <script src="../../js/plugins/pace/pace.min.js"></script>
        <script src="../../js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="../../js/plugins/jsKnob/jquery.knob.js"></script>
        <script src="../../js/plugins/metisMenu/jquery.metisMenu.js"></script>

        <script>
            function hanyaAngka(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))

                    return false;
                return true;
            }
        </script>



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
                    url: 'data-register.php?id=<?php echo $_GET['id']; ?>',
                    type: 'get',
                    success: function(data) {
                        $('#tabeldata').html(data);
                    }
                });
            }
        </script>

    </body>

    </html>
<?php
}
?>