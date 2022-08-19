<?php
if(empty($_SESSION['username']) AND empty($_SESSION['passuser']))
{
    echo"<script>window.location='index.php';</script>";
}
else
{
    $year = date('Y');
    $month = date('m');
    $tgl = $year.$month;
    //check establishcode
    $cek = $koneksi->query("SELECT EstablishCode FROM mstr_obat WHERE EstablishCode like '%$tgl%' ORDER BY EstablishCode DESC");
    $ce = mysqli_fetch_array($cek);
    if(empty($ce['EstablishCode']))
    {
        $generate = $year.$month.'EST'.'000001';
    }
    else
    {
        $str = 'EST';
        $str2 = substr($ce['EstablishCode'],-6);
        $str3 = $str2 + 1;
        $str4 = str_pad($str3,6,0,STR_PAD_LEFT);
        $prefix = $year.$month.$str;
        $generate = $prefix.$str4;
    }
    ?>

<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Tambah Obat</h5>
                        </div>
                        <div class="ibox-content">
                            <form method="POST" action="obat-simpan">   
                            <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group" id="data_1">
                                                    <label class="font-normal">Tgl. Input</label>
                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" placeholder="2022-01-01" value="<?php echo date('Y'); ?>-<?php echo date('m'); ?>-<?php echo date('d'); ?>" name="tgl_input" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Establish Code</label>
                                                    <div class="input-group">
                                                        <input name="establish_code" class="form-control" value="<?php echo $generate; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Kode Obat</label>
                                                    <div class="input-group">
                                                        <input type="text" name="kode_obat" class="form-control" placeholder="Kode Obat" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Nama Obat</label>
                                                    <div class="input-group">
                                                        <input name="nama_obat" type="text" class="form-control" placeholder="Nama Obat" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Nama Generik</label>
                                                    <div class="input-group">
                                                        <input name="nama_generik" type="text" class="form-control" placeholder="Nama Generik" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Posisi Obat</label>
                                                    <div class="input-group">
                                                        <select name="pot" class="form-control" required>
                                                            <?php
                                                            $pot = $koneksi->query("SELECT * FROM mstr_drugsposition");
                                                            while($p = mysqli_fetch_array($pot))
                                                            {
                                                                ?>
                                                                <option value="<?php echo $p['DrugsPositionCode']; ?>"><?php echo $p['DrugsPositionCode']; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Jenis Obat</label>
                                                    <div class="input-group">
                                                        <select name="jenis" class="form-control" required>
                                                            <option value="1" selected>Umum</option>
                                                            <option value="2">Racikan</option>
                                                        </select>   
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="font-normal">Nama Distributor</label>
                                                    <div class="input-group">
                                                        <select name="distributor" class="select2_demo_2 form-control" required>
                                                            <?php
                                                            $distri = $koneksi->query("SELECT * FROM mstr_distributor");
                                                            while($d = mysqli_fetch_array($distri))
                                                            {
                                                                ?>
                                                                <option value="<?php echo $d['DistributorCode']; ?>"><?php echo $d['DistributorCode']; ?> (<?php echo $d['DistributorName']; ?>)</option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select> 
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Nama Pabrikan</label>
                                                    <div class="input-group">
                                                        <select name="pabrikan" class="select2_demo_2 form-control" required>
                                                            <?php
                                                            $pabrikan = $koneksi->query("SELECT * FROM mstr_principle");
                                                            while($pt = mysqli_fetch_array($pabrikan))
                                                            {
                                                                ?>
                                                                <option value="<?php echo $pt['PrincipleCode']; ?>"><?php echo $pt['PrincipleCode']; ?> (<?php echo $pt['PrincipleName']; ?>)</option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Tipe Obat</label>
                                                    <div class="input-group">
                                                        <input type="text" name="tipe" class="form-control" placeholder="Unit" required>
                                                    </div>
                                                </div>
                                                
                                                <!--select name="tipe" class="form-control" required>
                                                    <?php
                                                    $tipe = $koneksi->query("SELECT * FROM mstr_drugsunit");
                                                    while($t = mysqli_fetch_array($tipe))
                                                    {
                                                        if($t['DrugsUnitName'] == $e['Unit'])
                                                        {
                                                            ?>
                                                            <option value="<?php echo $t['DrugsUnitName']; ?>" selected><?php echo $t['DrugsUnitName']; ?></option>
                                                            <?php
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <option value="<?php echo $t['DrugsUnitName']; ?>"><?php echo $t['DrugsUnitName']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>-->
                                                <div class="form-group">
                                                    <label class="font-normal">Ukuran / Isi</label>
                                                    <div class="input-group">
                                                        <input type="text" name="ukuran" class="form-control" placeholder="Ukuran / Isi" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Harga Dasar</label>
                                                    <div class="input-group">
                                                    <input name="harga_dasar" type="text" class="form-control" placeholder="Harga Dasar" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Harga Jual</label>
                                                    <div class="input-group">
                                                    <input name="harga_jual" type="text" class="form-control" placeholder="Harga Jual" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Biaya Jasa</label>
                                                    <div class="input-group">
                                                    <input name="biaya_jasa" type="text" class="form-control" placeholder="Biaya Jasa" required>
                                                    </div>
                                                </div>
                                            </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-check-square-o" aria-hidden="true"></i> Simpan</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
</div>
<?php
}
?>