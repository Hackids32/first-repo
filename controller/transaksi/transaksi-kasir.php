<?php
if(empty($_SESSION['username']) AND empty($_SESSION['passuser']))
{
    echo"<script>window.location='index.php';</script>";
}
else
{
    $register = $koneksi->query("SELECT * FROM trxn_saledrugs WHERE CustomerType = '1'");
    $t = mysqli_num_rows($register);
    $umum = $koneksi->query("SELECT * FROM trxn_saledrugs WHERE CustomerType = '2'");
    $u = mysqli_num_rows($umum);
    $pasien = $koneksi->query("SELECT * FROM trxn_saledrugs WHERE CustomerType = '3'");
    $v = mysqli_num_rows($pasien);
    ?>
<div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Pasien Register</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><i class="fa fa-users"></i> <?php echo format_rupiah($t); ?></h1>
                        <div class="stat-percent font-bold text-info"><a href="kasir-register"><button class="btn btn-primary">Daftar</button></a><br></div>
                        <small>Total Pasien</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Umum</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><i class="fa fa-users"></i> <?php echo format_rupiah($u); ?></h1>
                        <div class="stat-percent font-bold text-info"><a href="kasir-umum"><button class="btn btn-primary">Daftar</button></a><br></div>
                        <small>Total Pasien</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Pasien</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><i class="fa fa-users"></i> <?php echo format_rupiah($v); ?></h1>
                        <div class="stat-percent font-bold text-info"><a href="kasir-pasien"><button class="btn btn-primary">Daftar</button></a><br></div>
                        <small>Total Pasien</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Cek Harga</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><i class="fa fa-users"></i> 80,800</h1>
                        <div class="stat-percent font-bold text-info"><a href="cek-harga"><button class="btn btn-primary">Daftar</button></a><br></div>
                        <small>Total Pasien</small>
                    </div>
                </div>
            </div>

        </div>
</div>
<?php
}
?>