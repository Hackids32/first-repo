<?php
if(empty($_SESSION['username']) AND empty($_SESSION['passuser']))
{
    echo"<script>window.location='index.php';</script>";
}
else
{
    $year = date('Y');
    $month = date('m');
    //check establishcode
    $cek = $koneksi->query("SELECT EstablishCode FROM mstr_obat WHERE EstablishCode like '%$year.$month%' ORDER BY EstablishCode DESC");
    $ce = mysqli_fetch_array($cek);
    $cek2 = $koneksi->query("SELECT * FROM mstr_obat WHERE DrugsEstablishId = '$_GET[id]'");
    $row = mysqli_fetch_array($cek2);
    if(empty($ce['EstablishCode']))
    {
        $ec = $year.$month.'EST'.'00001';
    }
    else
    {
        $ec = $ce['EstablishCode'] + 1;
    }
    ?>

<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Edit Obat</h5>
                        </div>
                        <div class="ibox-content">
                            <form method="POST" action="obat-update">   
                            <input type="hidden" name="id" value="<?php echo $row['DrugsEstablishId']; ?>">
                            <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="font-normal">Tgl. Input</label>
                                                    <div class="input-group date">
                                                        <input name="tgl_input" class="form-control" value="<?php echo $row['EstablishDate']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Establish Code</label>
                                                    <div class="input-group">
                                                        <input name="establish_code" class="form-control" value="<?php echo $row['EstablishCode']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Kode Obat</label>
                                                    <div class="input-group">
                                                        <input type="text" name="kode_obat" class="form-control" placeholder="Kode Obat" value="<?php echo $row['DefinedCode']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Nama Obat</label>
                                                    <div class="input-group">
                                                        <input name="nama_obat" type="text" class="form-control" placeholder="Nama Obat" value="<?php echo $row['DrugsName']; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Nama Generik</label>
                                                    <div class="input-group">
                                                        <input name="nama_generik" type="text" class="form-control" placeholder="Nama Generik" value="<?php echo $row['Generic']; ?>" required>
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
                                                            if($p['DrugsPositionCode'] == $row['DrugsPositionCode'])
                                                            {
                                                                ?>
                                                                <option value="<?php echo $p['DrugsPositionCode']; ?>" selected><?php echo $p['DrugsPositionCode']; ?></option>
                                                                <?php
                                                            }
                                                            else
                                                            {
                                                                ?>
                                                                <option value="<?php echo $p['DrugsPositionCode']; ?>"><?php echo $p['DrugsPositionCode']; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Jenis Obat</label>
                                                    <div class="input-group">
                                                        <select name="jenis" class="form-control" required>
                                                        <?php
                                                            if($row['DrugsType']=='1')
                                                            {
                                                                ?>
                                                                <option value="1" selected>Umum</option>
                                                                <option value="2">Racikan</option>
                                                                <?php
                                                            }
                                                            else
                                                            {
                                                                ?>
                                                                <option value="1">Umum</option>
                                                                <option value="2" selected>Racikan</option>
                                                                <?php
                                                            }
                                                        ?>
                                                        </select> 
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="font-normal">Nama Distributor</label>
                                                    <div class="input-group">
                                                        <select name="distributor" class="select2_demo_1 form-control" required>
                                                        <?php
                                                        $distri = $koneksi->query("SELECT * FROM mstr_distributor");
                                                        while($d = mysqli_fetch_array($distri))
                                                        {
                                                            if($d['DistributorCode'] == $row['DistributorCode'])
                                                            {
                                                                ?>
                                                                <option value="<?php echo $d['DistributorCode']; ?>" selected><?php echo $d['DistributorCode']; ?> (<?php echo $d['DistributorName']; ?>)</option>
                                                                <?php
                                                            }
                                                            else
                                                            {
                                                                ?>
                                                                <option value="<?php echo $d['DistributorCode']; ?>"><?php echo $d['DistributorCode']; ?> (<?php echo $d['DistributorName']; ?>)</option>
                                                                <?php
                                                            }
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
                                                            if($pt['PrincipleCode'] == $row['PrincipleCode'])
                                                            {
                                                                ?>
                                                                <option value="<?php echo $pt['PrincipleCode']; ?>" selected><?php echo $pt['PrincipleCode']; ?> (<?php echo $pt['PrincipleName']; ?>)</option>
                                                                <?php
                                                            }
                                                            else
                                                            {
                                                                ?>
                                                                <option value="<?php echo $pt['PrincipleCode']; ?>"><?php echo $pt['PrincipleCode']; ?> (<?php echo $pt['PrincipleName']; ?>)</option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Tipe Obat</label>
                                                    <div class="input-group">
                                                        <input type="text" name="tipe" class="form-control" value="<?php echo $row['Unit']; ?>" required>
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
                                                        <input type="text" name="ukuran" class="form-control" placeholder="Ukuran / Isi" value="<?php echo $row['Strength']; ?>"  required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Harga Dasar</label>
                                                    <div class="input-group">
                                                    <input name="harga_dasar" type="text" class="form-control" placeholder="Harga Dasar" value="<?php echo $row['BasicPrice']; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Harga Jual</label>
                                                    <div class="input-group">
                                                    <input name="harga_jual" type="text" class="form-control" placeholder="Harga Jual" value="<?php echo $row['SellingPrice']; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Biaya Jasa</label>
                                                    <div class="input-group">
                                                    <input name="biaya_jasa" type="text" class="form-control" placeholder="Biaya Jasa" value="<?php echo $row['SeviceFactorPrice']; ?>" required>
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