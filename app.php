<?php
session_start();
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<script>window.location='index.php';</script>";
} else {
    include "config/koneksi.php";
    include "config/koneksi2.php";
    include "config/fungsi_kode_otomatis.php";
    include "config/class_paging.php";
    include "config/fungsi_rupiah.php";
    include "config/fungsi_indotgl.php";
    include "config/library.php";
    include "config/fungsi_combobox.php";
    include "config/fungsi_seo.php";
    include "config/fungsi_thumb.php";
    include "detect.php";
    require_once("assets/phpmailer/class.smtp.php");
    require_once("assets/phpmailer/class.phpmailer.php");
    require 'assets/phpmailer/PHPMailerAutoload.php';
?>
    <!DOCTYPE html>
    <html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>JSC System | v.2</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

        <!-- DataTables -->
        <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">

        <link href="css/plugins/iCheck/custom.css" rel="stylesheet">

        <link href="css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

        <link href="css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">

        <link href="css/plugins/cropper/cropper.min.css" rel="stylesheet">

        <link href="css/plugins/switchery/switchery.css" rel="stylesheet">

        <link href="css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet">

        <link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">

        <link href="css/plugins/ionRangeSlider/ion.rangeSlider.css" rel="stylesheet">

        <link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

        <link href="css/plugins/clockpicker/clockpicker.css" rel="stylesheet">

        <link href="css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">

        <link href="css/plugins/select2/select2.min.css" rel="stylesheet">
        <link href="css/plugins/select2/select2-bootstrap4.min.css" rel="stylesheet">

        <link href="css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">

        <link href="css/plugins/dualListbox/bootstrap-duallistbox.min.css" rel="stylesheet">

        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">


    </head>

    <body>

        <div id="wrapper">

            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu">
                        <li class="nav-header">
                            <div class="dropdown profile-element">
                                <img alt="image" class="rounded-circle" src="img/user.jpg" width="50px" />
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="block m-t-xs font-bold"><?php echo $_SESSION['username']; ?></span>
                                    <span class="text-muted text-xs block">Administrator <b class="caret"></b></span>
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
                            <a href="dashboard"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-cubes"></i> <span class="nav-label">Master</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li><a href="obat"><i class="fa fa-chevron-right" aria-hidden="true"></i> Obat</a></li>
                                <li><a href="stok-obat"><i class="fa fa-chevron-right" aria-hidden="true"></i> Stok Obat</a></li>
                                <li><a href="satuan-obat"><i class="fa fa-chevron-right" aria-hidden="true"></i> Satuan Obat</a></li>
                                <li><a href="distributor"><i class="fa fa-chevron-right" aria-hidden="true"></i> Distributor</a></li>
                                <li><a href="principle"><i class="fa fa-chevron-right" aria-hidden="true"></i> Prinsipal</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Transaksi</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li><a href="transaksi-kasir"><i class="fa fa-chevron-right" aria-hidden="true"></i> Kasir</a></li>
                                <li><a href="list-invoice"><i class="fa fa-chevron-right" aria-hidden="true"></i> List Invoice</a></li>
                                <li><a href="kasir-eod"><i class="fa fa-chevron-right" aria-hidden="true"></i> End of Day</a></li>
                                <li><a href="po"><i class="fa fa-chevron-right" aria-hidden="true"></i> Pemesanan Obat</a></li>
                                <li><a href="list-po"><i class="fa fa-chevron-right" aria-hidden="true"></i> Penerimaan Obat</a></li>
                                <li><a href="stok-opname"><i class="fa fa-chevron-right" aria-hidden="true"></i> Stock Opname</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-print"></i> <span class="nav-label">Report</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li><a href="graph_flot.html"><i class="fa fa-chevron-right" aria-hidden="true"></i> Stok Awal Tahun</a></li>
                                <li><a href="stok-obat"><i class="fa fa-chevron-right" aria-hidden="true"></i> Stok Penerimaan Penjualan</a></li>
                                <li><a href="satuan-obat"><i class="fa fa-chevron-right" aria-hidden="true"></i> Rekap Stok Obat</a></li>
                                <li><a href="distributor"><i class="fa fa-chevron-right" aria-hidden="true"></i> Pemesanan Obat</a></li>
                                <li><a href="prinsipal"><i class="fa fa-chevron-right" aria-hidden="true"></i> Penerimaan Obat</a></li>
                                <li><a href="prinsipal"><i class="fa fa-chevron-right" aria-hidden="true"></i> Penerimaan Kasir</a></li>
                                <li><a href="prinsipal"><i class="fa fa-chevron-right" aria-hidden="true"></i> Pembayaran</a></li>
                                <li><a href="prinsipal"><i class="fa fa-chevron-right" aria-hidden="true"></i> End of Day</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="rbac"><i class="fa fa-gears"></i> <span class="nav-label">Akses Kontrol</span></a>
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
                                    <a href="logout">
                                        <i class="fa fa-sign-out"></i> Log out
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </nav>
                </div>

                <?php include "routing.php"; ?>

                <div class="footer fixed">
                    <div class="float-right">
                        version <strong>2</strong>
                    </div>
                    <div>
                        <strong>Copyright</strong> Jakarta Skin Center &copy; 2014-<?php echo date('Y'); ?>
                    </div>
                </div>

            </div>
        </div>

        <!-- Mainly scripts -->
        <script src="js/jquery.js"></script>
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.js"></script>

        <!-- DataTables -->
        <script src="js/plugins/dataTables/datatables.min.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="js/inspinia.js"></script>
        <script src="js/plugins/pace/pace.min.js"></script>
        <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <!-- JSKnob -->
        <script src="js/plugins/jsKnob/jquery.knob.js"></script>

        <!-- Input Mask-->
        <script src="js/plugins/jqueryMask/jquery.mask.min.js"></script>

        <!-- Data picker -->
        <script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

        <!-- NouSlider -->
        <script src="js/plugins/nouslider/jquery.nouislider.min.js"></script>

        <!-- Switchery -->
        <script src="js/plugins/switchery/switchery.js"></script>

        <!-- IonRangeSlider -->
        <script src="js/plugins/ionRangeSlider/ion.rangeSlider.min.js"></script>

        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js"></script>

        <!-- MENU -->
        <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

        <!-- Color picker -->
        <script src="js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>

        <!-- Clock picker -->
        <script src="js/plugins/clockpicker/clockpicker.js"></script>

        <!-- Image cropper -->
        <script src="js/plugins/cropper/cropper.min.js"></script>

        <!-- Date range use moment.js same as full calendar plugin -->
        <script src="js/plugins/fullcalendar/moment.min.js"></script>

        <!-- Date range picker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js"></script>

        <!-- Select2 -->
        <script src="js/plugins/select2/select2.full.min.js"></script>

        <!-- TouchSpin -->
        <script src="js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

        <!-- Tags Input -->
        <script src="js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

        <!-- Dual Listbox -->
        <script src="js/plugins/dualListbox/jquery.bootstrap-duallistbox.js"></script>

        <script>
            $(document).ready(function() {

                /*$('.tagsinput').tagsinput({
                    tagClass: 'label label-primary'
                });

                var $image = $(".image-crop > img")
                var $cropped = $($image).cropper({
                    aspectRatio: 1.618,
                    preview: ".img-preview",
                    done: function(data) {
                        // Output the result data for cropping image.
                    }
                });

                var $inputImage = $("#inputImage");
                if (window.FileReader) {
                    $inputImage.change(function() {
                        var fileReader = new FileReader(),
                                files = this.files,
                                file;

                        if (!files.length) {
                            return;
                        }

                        file = files[0];

                        if (/^image\/\w+$/.test(file.type)) {
                            fileReader.readAsDataURL(file);
                            fileReader.onload = function () {
                                $inputImage.val("");
                                $image.cropper("reset", true).cropper("replace", this.result);
                            };
                        } else {
                            showMessage("Please choose an image file.");
                        }
                    });
                } else {
                    $inputImage.addClass("hide");
                }

                $("#download").click(function (link) {
                    link.target.href = $cropped.cropper('getCroppedCanvas', { width: 620, height: 520 }).toDataURL("image/png").replace("image/png", "application/octet-stream");
                    link.target.download = 'cropped.png';
                });


                $("#zoomIn").click(function() {
                    $image.cropper("zoom", 0.1);
                });

                $("#zoomOut").click(function() {
                    $image.cropper("zoom", -0.1);
                });

                $("#rotateLeft").click(function() {
                    $image.cropper("rotate", 45);
                });

                $("#rotateRight").click(function() {
                    $image.cropper("rotate", -45);
                });

                $("#setDrag").click(function() {
                    $image.cropper("setDragMode", "crop");
                });*/

                var mem = $('#data_1 .input-group.date').datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true,
                    format: "yyyy-mm-dd"
                });

                var yearsAgo = new Date();
                yearsAgo.setFullYear(yearsAgo.getFullYear() - 20);

                $('#selector').datepicker('setDate', yearsAgo);


                $('#data_2 .input-group.date').datepicker({
                    startView: 1,
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    autoclose: true,
                    format: "dd/mm/yyyy"
                });

                $('#data_3 .input-group.date').datepicker({
                    startView: 2,
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    autoclose: true
                });

                $('#data_4 .input-group.date').datepicker({
                    minViewMode: 1,
                    keyboardNavigation: false,
                    forceParse: false,
                    forceParse: false,
                    autoclose: true,
                    todayHighlight: true
                });

                $('#data_5 .input-daterange').datepicker({
                    keyboardNavigation: false,
                    forceParse: false,
                    autoclose: true
                });

                /*var elem = document.querySelector('.js-switch');
                var switchery = new Switchery(elem, { color: '#1AB394' });

                var elem_2 = document.querySelector('.js-switch_2');
                var switchery_2 = new Switchery(elem_2, { color: '#ED5565' });

                var elem_3 = document.querySelector('.js-switch_3');
                var switchery_3 = new Switchery(elem_3, { color: '#1AB394' });

                var elem_4 = document.querySelector('.js-switch_4');
                var switchery_4 = new Switchery(elem_4, { color: '#f8ac59' });
                    switchery_4.disable();

                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green'
                });

                $('.demo1').colorpicker();

                var divStyle = $('.back-change')[0].style;
                $('#demo_apidemo').colorpicker({
                    color: divStyle.backgroundColor
                }).on('changeColor', function(ev) {
                            divStyle.backgroundColor = ev.color.toHex();
                        });

                $('.clockpicker').clockpicker();

                $('input[name="daterange"]').daterangepicker();

                $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

                $('#reportrange').daterangepicker({
                    format: 'MM/DD/YYYY',
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment(),
                    minDate: '01/01/2012',
                    maxDate: '12/31/2015',
                    dateLimit: { days: 60 },
                    showDropdowns: true,
                    showWeekNumbers: true,
                    timePicker: false,
                    timePickerIncrement: 1,
                    timePicker12Hour: true,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    opens: 'right',
                    drops: 'down',
                    buttonClasses: ['btn', 'btn-sm'],
                    applyClass: 'btn-primary',
                    cancelClass: 'btn-default',
                    separator: ' to ',
                    locale: {
                        applyLabel: 'Submit',
                        cancelLabel: 'Cancel',
                        fromLabel: 'From',
                        toLabel: 'To',
                        customRangeLabel: 'Custom',
                        daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                        monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                        firstDay: 1
                    }
                }, function(start, end, label) {
                    console.log(start.toISOString(), end.toISOString(), label);
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                });*/

                $(".select2_demo_1").select2({
                    theme: 'bootstrap4',
                });
                $(".select2_demo_2").select2({
                    theme: 'bootstrap4',
                });
                $(".select2_demo_3").select2({
                    theme: 'bootstrap4',
                    placeholder: "Select a state",
                    allowClear: true
                });
            });
        </script>

        <script>
            // Upgrade button class name
            $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';

            $(document).ready(function() {
                $('.dataTables-example').DataTable({
                    pageLength: 25,
                    responsive: true,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [{
                            extend: 'copy'
                        },
                        {
                            extend: 'csv'
                        },
                        {
                            extend: 'excel',
                            title: 'ExampleFile'
                        },
                        {
                            extend: 'pdf',
                            title: 'ExampleFile'
                        },

                        {
                            extend: 'print',
                            customize: function(win) {
                                $(win.document.body).addClass('white-bg');
                                $(win.document.body).css('font-size', '10px');

                                $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                            }
                        }
                    ]

                });

            });
        </script>
        <script>
            function hanyaAngka(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))

                    return false;
                return true;
            }
        </script>
        <script>
            $(function() {

                $('.table1').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "ajax/ajax_kontak.php?action=table_data",
                        "dataType": "json",
                        "type": "POST"
                    },
                    "columns": [{
                            "data": "no"
                        },
                        {
                            "data": "no_reg"
                        },
                        {
                            "data": "tgl"
                        },
                        {
                            "data": "no_pasien"
                        },
                        {
                            "data": "nama"
                        },
                        {
                            "data": "aksi"
                        },
                    ]

                });
            });

            $(function() {
                $('.table2').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "ajax/ajax_pasien.php?action=table_data",
                        "dataType": "json",
                        "type": "POST"
                    },
                    "columns": [{
                            "data": "no"
                        },
                        {
                            "data": "no_kartu"
                        },
                        {
                            "data": "nama"
                        },
                        {
                            "data": "sex"
                        },
                        {
                            "data": "tanggal_lahir"
                        },
                        {
                            "data": "aksi"
                        },
                    ]

                });
            });

            $(function() {
                $('.table3').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "ajax/list_invoice.php?action=table_data",
                        "dataType": "json",
                        "type": "POST"
                    },
                    "columns": [{
                            "data": "no"
                        },
                        {
                            "data": "SalesDrugsCode"
                        },
                        {
                            "data": "SalesDrugsNumber"
                        },
                        {
                            "data": "PasienId"
                        },
                        {
                            "data": "CustomerName"
                        },
                        {
                            "data": "CustomerType"
                        },
                        {
                            "data": "GrandTotalPayment"
                        },
                        {
                            "data": "RegisterAt"
                        },
                        {
                            "data": "Status"
                        },
                        {
                            "data": "aksi"
                        },
                    ]

                });
            });

            $(function() {
                $('#id_dokter').change(function() {
                    localStorage.setItem('id_dokter', this.value);
                });
                if (localStorage.getItem('id_dokter')) {
                    $('#id_dokter').val(localStorage.getItem('id_dokter'));
                }
            });
        </script>

    </body>

    </html>
<?php
}
?>