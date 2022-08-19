<?php
error_reporting(0);
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<script>window.location='index.php';</script>";
} else {
    $kueri = $koneksi->query("SELECT * FROM trxn_saledrugs WHERE Status = '1' ORDER BY SaleDrugsId DESC LIMIT 1");
    $k = mysqli_fetch_array($kueri);
    $rows = mysqli_num_rows($kueri);

    //cek jika ada transaksi tertunda
    if ($rows == 0) {
        $pasienid = isset($k['PasienId']);
        $kueri2 = $koneksi2->query("SELECT * FROM mstr_pasien WHERE no_kartu = '$pasienid'");
        $k2 = mysqli_fetch_array($kueri2);
        //jika tidak ada transaksi tertunda
        $sub = substr(isset($k['SalesDrugsCode']), -5);
        $sub22 = is_numeric($sub + 1);
        $sub2 = isset($sub22);
        $pad = str_pad($sub2, 5, "0", STR_PAD_LEFT);
        $pad2 = str_pad($sub2, 6, "0", STR_PAD_LEFT);
        $kode = date('ymd') . ' ' . $pad . $pad2;
        $kode2 = date('ymd') . ' ' . $pad;

?>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Kasir Register</h5>
                        </div>
                        <div class="ibox-content">

                            <form method="post" action="transaksiregister" id="formD" name="formD">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group" id="data_1">
                                            <label class="font-normal"><b>Tgl. Register</b></label>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" placeholder="2022-01-01" name="tgl_input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="font-normal"><b>No. Register</b></label>
                                            <div class="input-group">
                                                <input type="text" name="id_register" id="id_register" class="form-control" placeholder="ID Register" readonly>
                                                <input type="hidden" name="no_register" id="no_register" class="form-control" placeholder="ID Register" readonly>
                                                <input type="hidden" name="id_register2" class="form-control" placeholder="ID Register" value="<?php echo $kode2; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="font-normal">&nbsp;</label><br>
                                            <div class="input-group">
                                                <a class="btn btn-primary text-white" data-toggle="modal" data-target="#myModal5"><i class="fa fa-search" aria-hidden="true"></i> Cari</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Modal-->
                                    <div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                                                    </button>
                                                    <h4 class="modal-title">Search Register</h4>
                                                    <small class="font-bold">
                                                        You may optionally enter a comparison operator (<, <=,>, >=, <> or =)
                                                                at the beginning of each of your search values to specify how the
                                                                comparison should be done.
                                                    </small>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table-responsive">
                                                        <table class="table1 table-striped table-sm" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">No</th>
                                                                    <th scope="col">ID Reg</th>
                                                                    <th scope="col">Tgl Reg</th>
                                                                    <th scope="col">No. Pasien</th>
                                                                    <th scope="col">Nama Pasien</th>
                                                                    <th scope="col">Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- List Data Menggunakan DataTable -->
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-white" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--End-->

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="font-normal"><b>No. Pasien</b></label>
                                            <div class="input-group">
                                                <input type="text" id="no_pasien" name="no_pasien" placeholder="No. Pasien" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="font-normal"><b>Nama Pasien</b></label>
                                            <div class="input-group">
                                                <input type="text" id="nama" name="nama_pasien" placeholder="Nama Pasien" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="font-normal"><b>No. Resep</b></label>
                                            <div class="input-group">
                                                <input type="text" name="no_resep" id="no_resep" class="form-control" value="0" onkeyup="saveValue(this);" placeholder="No. Resep Dokter">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="font-normal"><b>Pilih Dokter</b></label>
                                            <div class="input-group">
                                                <select name="id_dokter" id="id_dokter" class="form-control select2_demo_2" required>
                                                    <option value="" selected>-- Pilih Dokter --</option>
                                                    <?php
                                                    $dokter = $koneksi2->query("SELECT * FROM mstr_dokter ORDER BY nama ASC");
                                                    while ($d = mysqli_fetch_array($dokter)) {
                                                    ?>
                                                        <option value="<?php echo $d['no_dokter']; ?>"><?php echo $d['nama']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="font-normal"><b>No. Telpon Pasien</b></label>
                                            <div class="input-group">
                                                <input type="text" id="hp" name="telepon" class="form-control" placeholder="No. Telepon" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="font-normal">&nbsp;</label>
                                            <div class="input-group">
                                                <button class="btn btn-primary" type="submit" name="proses" value="header"><i class="fa fa-check" aria-hidden="true"></i> Buat Invoice</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <hr style="height: 5px;background-color: #18A689;border: none;">

                            <form method="post" action="transaksiregister-proses">
                                <div class="row">

                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="font-normal"><b>Pilih Item / Obat</b></label>
                                            <div class="input-group">
                                                <select class="form-control select2_demo_2" name="kode_obat">
                                                    <?php
                                                    $kueri2 = $koneksi->query("SELECT EstablishCode,DrugsName,DefinedCode,stok_awal,SellingPrice FROM mstr_obat ORDER BY DrugsName ASC");
                                                    while ($l = mysqli_fetch_array($kueri2)) {
                                                    ?>
                                                        <option value="<?php echo $l['EstablishCode']; ?>"><?php echo $l['DefinedCode']; ?> - <?php echo $l['DrugsName']; ?> - <?php echo $l['stok_awal']; ?> Qty - Rp.<?php echo $l['SellingPrice']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <input type="hidden" name="id_registerr" id="id_registerr" class="form-control" placeholder="ID Register" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="font-normal"><b>Qty</b></label>
                                            <div class="input-group">
                                                <input type="text" name="qty" class="form-control" placeholder="Qty" value="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="font-normal"><b>Biaya Jasa</b></label>
                                            <div class="input-group">
                                                <input type="text" name="biaya_jasa" onkeypress="return hanyaAngka(event)" class="form-control" value="0" placeholder="Biaya Jasa">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="font-normal"><b>Diskon (Percent %)</b></label>
                                            <div class="input-group">
                                                <input type="text" name="diskon" onkeypress="return hanyaAngka(event)" class="form-control" value="0" placeholder="Diskon">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="font-normal"><b>&nbsp;</b></label><br>
                                            <div class="input-group">
                                                <button type="submit" name="proses" value="add" class="btn btn-primary tombol-simpan"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>

                            <div class="row">
                                <div class="col-md-12">
                                    <!--<form id="formD" name="formD" action="" method="post" enctype="multipart/form-data">-->
                                    <table width="100%" class="table table-border">
                                        <tr>
                                            <th><b>#</b></th>
                                            <th><b>No.</b></th>
                                            <th><b>Kode Item</b></th>
                                            <th><b>Nama Item</b></th>
                                            <th><b>Harga</b></th>
                                            <th><b>Qty</b></th>
                                            <th><b>Biaya Jasa</b></th>
                                            <th><b>Diskon</b></th>
                                            <th><b>Sub Total</b></th>
                                        </tr>
                                        <?php
                                        $no = 1;
                                        $total = 0;
                                        $detail = $koneksi->query("SELECT * FROM rltn_transdrugsitem_tmp WHERE CreateBy = '$_SESSION[username]'  ORDER BY TransDrugItemId ASC");
                                        while ($row = mysqli_fetch_array($detail)) {
                                            $detail2 = $koneksi->query("SELECT EstablishCode, DrugsName FROM mstr_obat WHERE EstablishCode = '$row[EstablishCode]'");
                                            $data = mysqli_fetch_array($detail2)
                                        ?>
                                            <tr>
                                                <td>
                                                    <a href='#myModal' id='custId' data-toggle='modal' data-id="<?php echo $row['TransDrugItemId']; ?>" class="btn btn-warning"><i class='fa fa-pencil'></i></a>
                                                    <a href="register-delete-<?php echo $row['TransDrugItemId']; ?>"><button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
                                                </td>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $row['EstablishCode']; ?></td>
                                                <td><?php echo $data['DrugsName']; ?></td>
                                                <td>Rp. <?php echo format_rupiah($row['EstablishPrice']); ?></td>
                                                <td><?php echo $row['Unit']; ?></td>
                                                <td>Rp. <?php echo format_rupiah($row['ServicePrice']); ?></td>
                                                <td>Rp. <?php echo format_rupiah($row['Discount']); ?></td>
                                                <td>Rp. <?php echo format_rupiah($row['SubTotal']); ?></td>
                                            </tr>
                                        <?php
                                            $no++;
                                            $total = $total + $row['SubTotal'];
                                        }
                                        $totall = $total;
                                        ?>
                                        <tr>
                                            <td colspan="8" align="right"><b>Total:</b></td>
                                            <td><input type="hidden" name="total" class="form-control" onkeyup="OnChange(this.value)" onKeyPress="return isNumberKey(event)" value="<?php echo $totall; ?>" readonly>
                                                Rp. <?php echo format_rupiah($totall); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="8" align="right"><b>Delivery Fee:</b></td>
                                            <td><select name="delivery" OnChange="OnChange(this.value)" onKeyPress="return isNumberKey(event)" class="form-control">
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
                                                </select></td>
                                        </tr>
                                        <tr>
                                            <td colspan="8" align="right"><b>Grand Total:</b></td>
                                            <td><input type="text" name="grand" class="form-control"></td>
                                        </tr>
                                    </table>
                                    <!--Modal-->
                                    <div class="modal inmodal fade" id="myModal6" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                                                    </button>
                                                    <h4 class="modal-title">Edit Detail Item</h4>
                                                    <small class="font-bold">
                                                        You may optionally enter a comparison operator (<, <=,>, >=, <> or =)
                                                                at the beginning of each of your search values to specify how the
                                                                comparison should be done.
                                                    </small>
                                                </div>
                                                <div class="modal-body">

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-white" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End modal-->
                                    <!-- Calculate -->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <!--<a href="kasir-register-payment-<?php echo $id_register; ?>"><button type="button" name="proses" class="btn btn-primary" value="payment">Proses Pembayaran</button></a>
                                            <a href="controller/transaksi/pay.php?id=<?php echo $k['SalesDrugsCode']; ?>"><button type="button" name="proses" class="btn btn-primary" value="payment">Proses Pembayarans</button></a>-->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script type="text/javascript" language="Javascript">
                                function OnChange(value) {
                                    total = document.formD.total.value;
                                    delivery = document.formD.delivery.value;
                                    grand = parseInt(total) + parseInt(delivery);
                                    document.formD.grand.value = grand;
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
                            <script type="text/javascript">
                                document.getElementById("id_dokter").value = getSavedValue("id_dokter"); // set the value to this input
                                document.getElementById("no_resep").value = getSavedValue("no_resep "); // set the value to this input
                                /* Here you can add more inputs to set value. if it's saved */

                                //Save the value function - save it to localStorage as (ID, VALUE)
                                function saveValue(e) {
                                    var id = e.id; // get the sender's id to save it . 
                                    var val = e.value; // get the value. 
                                    localStorage.setItem(id, val); // Every time user writing something, the localStorage's value will override . 
                                }

                                //get the saved value function - return the value of "v" from localStorage. 
                                function getSavedValue(v) {
                                    if (!localStorage.getItem(v)) {
                                        return ""; // You can change this to your defualt value. 
                                    }
                                    return localStorage.getItem(v);
                                }
                            </script>



                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal edit-->
        <div class="modal fade bs-example-modal-lg" id="myModal" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Detail Item</h4>
                    </div>
                    <div class="modal-body">
                        <div class="fetched-data"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Modal edit -->
        <!-- Javascript untuk popup modal edit-->
        <script src="js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#myModal').on('show.bs.modal', function(e) {
                    var rowid = $(e.relatedTarget).data('id');
                    //menggunakan fungsi ajax untuk pengambilan data
                    $.ajax({
                        type: 'post',
                        url: 'model/transaksi/detail.php',
                        data: 'rowid=' + rowid,
                        success: function(data) {
                            $('.fetched-data').html(data); //menampilkan data ke dalam modal
                        }
                    });
                });
            });
        </script>
    <?php
    } else {
        $kueri2 = $koneksi2->query("SELECT * FROM mstr_pasien WHERE no_kartu = '$k[PasienId]'");
        $k2 = mysqli_fetch_array($kueri2);
        //jika ada transaksi tertunda
        $tgl = substr($k['CreateAt'], 0, 10);
        $sub = substr($k['SalesDrugsCode'], -5);
        $sub2 = $sub;
        $pad = str_pad($sub2, 5, "0", STR_PAD_LEFT);
        $pad2 = str_pad($sub2, 6, "0", STR_PAD_LEFT);
        $kode = date('ymd') . ' ' . $pad . $pad2;
        $kode2 = date('ymd') . ' ' . $pad;
        $id_register = $kode2;
        //echo "<script>alert('Selesaikan transaksi tertunda atau hapus transaksi ini');</script>";
    ?>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Kasir Register</h5>
                        </div>
                        <div class="ibox-content">

                            <form method="post" action="transaksiregister">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group" id="data_1">
                                            <label class="font-normal"><b>Tgl. Register</b></label>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" placeholder="2022-01-01" value="<?php echo $tgl; ?>" name="tgl_input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="font-normal"><b>No. Register </b></label>
                                            <div class="input-group">
                                                <input type="text" name="id_register" class="form-control" value="<?php echo $k['SalesDrugsCode']; ?>" readonly>
                                                <input type="hidden" name="no_register" id="no_register" class="form-control" placeholder="ID Register" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="font-normal">&nbsp;</label><br>
                                            <div class="input-group">
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#myModal5" disabled><i class="fa fa-search" aria-hidden="true"></i> Cari</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Modal-->
                                    <div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                                                    </button>
                                                    <h4 class="modal-title">Search Register</h4>
                                                    <small class="font-bold">
                                                        You may optionally enter a comparison operator (<, <=,>, >=, <> or =)
                                                                at the beginning of each of your search values to specify how the
                                                                comparison should be done.
                                                    </small>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table-responsive">
                                                        <table class="table1 table-striped table-sm" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">No</th>
                                                                    <th scope="col">ID Reg</th>
                                                                    <th scope="col">Tgl Reg</th>
                                                                    <th scope="col">No. Pasien</th>
                                                                    <th scope="col">Nama Pasien</th>
                                                                    <th scope="col">Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- List Data Menggunakan DataTable -->
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-white" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End-->

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="font-normal"><b>No. Pasien</b></label>
                                            <div class="input-group">
                                                <input type="text" value="<?php echo $k['PasienId']; ?>" name="no_pasien" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="font-normal"><b>Nama Pasien</b></label>
                                            <div class="input-group">
                                                <input type="text" value="<?php echo $k['CustomerName']; ?>" name="nama_pasien" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="font-normal"><b>No. Resep</b></label>
                                            <div class="input-group">
                                                <input type="text" name="no_resep" class="form-control" value="<?php echo $k['DrugsReceiveNumb']; ?>" placeholder="No. Resep Dokter">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="font-normal"><b>Pilih Dokter</b></label>
                                            <div class="input-group">
                                                <select name="id_dokter" id="id_dokter" class="form-control select2_demo_2" readonly>
                                                    <option value="" selected>-- Pilih Dokter --</option>
                                                    <?php
                                                    $dokter = $koneksi2->query("SELECT * FROM mstr_dokter ORDER BY nama ASC");
                                                    while ($d = mysqli_fetch_array($dokter)) {
                                                        if ($d['no_dokter'] == $k['no_dokter']) {
                                                    ?>
                                                            <option value="<?php echo $d['no_dokter']; ?>" selected><?php echo $d['nama']; ?></option>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <option value="<?php echo $d['no_dokter']; ?>"><?php echo $d['nama']; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="font-normal"><b>No. Telpon Pasien</b></label>
                                            <div class="input-group">
                                                <input type="text" name="telepon" class="form-control" placeholder="No. Telepon" value="<?php echo $k2['hp']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="font-normal">&nbsp;</label>
                                            <div class="input-group">
                                                <button class="btn btn-primary" type="submit" name="proses" value="header" disabled><i class="fa fa-check" aria-hidden="true"></i> Buat Invoice</button>
                                                &nbsp; &nbsp; &nbsp;<a class="btn btn-danger" href="kasir-regdel-<?php echo $k['SalesDrugsCode']; ?>"><i class="fa fa-trash" aria-hidden="true"></i> Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <hr style="height: 5px;background-color: #18A689;border: none;">

                            <form method="post" action="transaksiregister-proses">
                                <div class="row">

                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="font-normal"><b>Pilih Item / Obat</b></label>
                                            <div class="input-group">
                                                <select class="form-control select2_demo_2" name="kode_obat">
                                                    <?php
                                                    $kueri2 = $koneksi->query("SELECT EstablishCode,DrugsName,DefinedCode,stok_awal,SellingPrice FROM mstr_obat ORDER BY DrugsName ASC");
                                                    while ($l = mysqli_fetch_array($kueri2)) {
                                                    ?>
                                                        <option value="<?php echo $l['EstablishCode']; ?>"><?php echo $l['DefinedCode']; ?> - <?php echo $l['DrugsName']; ?> - <?php echo $l['stok_awal']; ?> Qty - Rp.<?php echo $l['SellingPrice']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <input type="hidden" name="id_registerr" value="<?php echo $k['SalesDrugsCode']; ?>" class="form-control" placeholder="ID Register" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="font-normal"><b>Qty</b></label>
                                            <div class="input-group">
                                                <input type="text" name="qty" class="form-control" placeholder="Qty" value="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="font-normal"><b>Biaya Jasa</b></label>
                                            <div class="input-group">
                                                <input type="text" name="biaya_jasa" onkeypress="return hanyaAngka(event)" class="form-control" value="0" placeholder="Biaya Jasa">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="font-normal"><b>Diskon (Percent %)</b></label>
                                            <div class="input-group">
                                                <input type="text" name="diskon" onkeypress="return hanyaAngka(event)" class="form-control" value="0" placeholder="Diskon">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="font-normal"><b>&nbsp;</b></label><br>
                                            <div class="input-group">
                                                <button type="submit" name="proses" value="add" class="btn btn-primary tombol-simpan"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>

                            <div class="row">
                                <div class="col-md-12">
                                    <form id="formD" name="formD" action="transaksiregister-simpan" method="post" enctype="multipart/form-data">
                                        <table width="100%" class="table table-border">
                                            <tr>
                                                <th><b>#</b></th>
                                                <th><b>No.</b></th>
                                                <th><b>Kode Item</b></th>
                                                <th><b>Nama Item</b></th>
                                                <th><b>Harga</b></th>
                                                <th><b>Qty</b></th>
                                                <th><b>Biaya Jasa</b></th>
                                                <th><b>Diskon</b></th>
                                                <th><b>Sub Total</b></th>
                                            </tr>
                                            <?php
                                            $no = 1;
                                            $total = 0;
                                            $detail = $koneksi->query("SELECT * FROM rltn_transdrugsitem_tmp WHERE CreateBy = '$_SESSION[username]'  ORDER BY TransDrugItemId ASC");
                                            while ($row = mysqli_fetch_array($detail)) {
                                                $detail2 = $koneksi->query("SELECT EstablishCode, DrugsName FROM mstr_obat WHERE EstablishCode = '$row[EstablishCode]'");
                                                $data = mysqli_fetch_array($detail2)
                                            ?>
                                                <tr>
                                                    <td>
                                                        <a href='#myModal' id='custId' data-toggle='modal' data-id="<?php echo $row['TransDrugItemId']; ?>" class="btn btn-warning"><i class='fa fa-pencil'></i></a>
                                                        <a href="register-delete-<?php echo $row['TransDrugItemId']; ?>" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    </td>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $row['EstablishCode']; ?></td>
                                                    <td><?php echo $data['DrugsName']; ?></td>
                                                    <td>Rp. <?php echo format_rupiah($row['EstablishPrice']); ?></td>
                                                    <td><?php echo $row['Unit']; ?></td>
                                                    <td>Rp. <?php echo format_rupiah($row['ServicePrice']); ?></td>
                                                    <td>Rp. <?php echo format_rupiah($row['Discount']); ?></td>
                                                    <td>Rp. <?php echo format_rupiah($row['SubTotal']); ?></td>
                                                </tr>
                                            <?php
                                                $no++;
                                                $total = $total + $row['SubTotal'];
                                            }
                                            $totall = $total;
                                            ?>
                                            <tr>
                                                <td colspan="8" align="right"><b>Total:</b></td>
                                                <td><input type="hidden" name="total" class="form-control" onkeyup="OnChange(this.value)" onKeyPress="return isNumberKey(event)" value="<?php echo $totall; ?>" readonly>
                                                    <input type="hidden" name="idr" class="form-control" value="<?php echo $k['SalesDrugsCode']; ?>" readonly>
                                                    Rp. <?php echo format_rupiah($totall); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="8" align="right"><b>Delivery Fee:</b></td>
                                                <td><select name="delivery" OnChange="OnChange(this.value)" onKeyPress="return isNumberKey(event)" class="form-control">
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
                                                    </select></td>
                                            </tr>
                                            <tr>
                                                <td colspan="8" align="right"><b>Grand Total:</b></td>
                                                <td><input type="text" name="grand" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="8" align="right"><b></b></td>
                                                <td><button type="submit" name="proses" class="btn btn-primary" value="payment">Proses Pembayaran</button></td>
                                            </tr>
                                        </table>
                                        <!--Modal-->
                                        <div class="modal inmodal fade" id="myModal6" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                                                        </button>
                                                        <h4 class="modal-title">Edit Detail Item</h4>
                                                        <small class="font-bold">
                                                            You may optionally enter a comparison operator (<, <=,>, >=, <> or =)
                                                                    at the beginning of each of your search values to specify how the
                                                                    comparison should be done.
                                                        </small>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>

                                                        </form>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-white" data-dismiss="modal">
                                                            Close
                                                        </button>
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--End modal-->
                                    </form>
                                    <!-- Calculate -->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <!--<a href="kasir-register-payment-<?php echo $id_register; ?>"><button type="button" name="proses" class="btn btn-primary" value="payment">Proses Pembayaran</button></a>
                                            <a href="controller/transaksi/pay.php?id=<?php echo $k['SalesDrugsCode']; ?>"><button type="button" name="proses" class="btn btn-primary" value="payment">Proses Pembayaran</button></a>-->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script type="text/javascript" language="Javascript">
                                function OnChange(value) {
                                    total = document.formD.total.value;
                                    delivery = document.formD.delivery.value;
                                    grand = parseInt(total) + parseInt(delivery);
                                    document.formD.grand.value = grand;
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
                            <script type="text/javascript">
                                document.getElementById("id_dokter").value = getSavedValue("id_dokter"); // set the value to this input
                                document.getElementById("no_resep").value = getSavedValue("no_resep "); // set the value to this input
                                /* Here you can add more inputs to set value. if it's saved */

                                //Save the value function - save it to localStorage as (ID, VALUE)
                                function saveValue(e) {
                                    var id = e.id; // get the sender's id to save it . 
                                    var val = e.value; // get the value. 
                                    localStorage.setItem(id, val); // Every time user writing something, the localStorage's value will override . 
                                }

                                //get the saved value function - return the value of "v" from localStorage. 
                                function getSavedValue(v) {
                                    if (!localStorage.getItem(v)) {
                                        return ""; // You can change this to your defualt value. 
                                    }
                                    return localStorage.getItem(v);
                                }
                            </script>



                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal edit-->
        <div class="modal fade bs-example-modal-lg" id="myModal" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Detail Item</h4>
                    </div>
                    <div class="modal-body">
                        <div class="fetched-data"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Modal edit -->
        <script src="js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#myModal').on('show.bs.modal', function(e) {
                    var rowid = $(e.relatedTarget).data('id');
                    //menggunakan fungsi ajax untuk pengambilan data
                    $.ajax({
                        type: 'post',
                        url: 'model/transaksi/detail.php',
                        data: 'rowid=' + rowid,
                        success: function(data) {
                            $('.fetched-data').html(data); //menampilkan data ke dalam modal
                        }
                    });
                });
            });
        </script>
<?php
    }
}
?>
<script>
    // Retrieve
    document.getElementById("id_register").value = localStorage.getItem("id_reg");
    document.getElementById("id_registerr").value = localStorage.getItem("id_reg");
    document.getElementById("no_register").value = localStorage.getItem("no_reg");
    document.getElementById("no_pasien").value = localStorage.getItem("no_pasien");
    document.getElementById("nama").value = localStorage.getItem("nama");
    document.getElementById("hp").value = localStorage.getItem("hp");
    document.getElementById("no_resep").value = localStorage.getItem("no_resep");
    document.getElementById("id_dokter").value = localStorage.getItem("id_dokter");
</script>