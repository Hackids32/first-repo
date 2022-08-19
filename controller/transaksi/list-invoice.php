<?php
error_reporting(0);
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<script>window.location='index.php';</script>";
} else {
    $kueri = $koneksi->query("SELECT * FROM trxn_saledrugs WHERE Status = '1' ORDER BY SaleDrugsId DESC LIMIT 1");
    $k = mysqli_fetch_array($kueri);
    $rows = mysqli_num_rows($kueri);

    //cek jika ada transaksi tertunda
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
                        <h5>List Invoice</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table3 table-striped table-sm" width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Register</th>
                                        <th scope="col">No. Invoice</th>
                                        <th scope="col">Kode Pasien</th>
                                        <th scope="col">Nama Pasien</th>
                                        <th scope="col">Cust. Type</th>
                                        <th scope="col">Total Invoice</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- List Data Menggunakan DataTable -->
                                </tbody>
                            </table>
                        </div>
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
    document.getElementById("id_register").value = localStorage.getItem("id_reg");
    document.getElementById("id_registerr").value = localStorage.getItem("id_reg");
    document.getElementById("no_register").value = localStorage.getItem("no_reg");
    document.getElementById("no_pasien").value = localStorage.getItem("no_pasien");
    document.getElementById("nama").value = localStorage.getItem("nama");
    document.getElementById("hp").value = localStorage.getItem("hp");
    document.getElementById("no_resep").value = localStorage.getItem("no_resep");
</script>