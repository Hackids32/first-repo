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
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>List Obat</h5>
                        <div class="ibox-tools">
                            <a href="obat-add" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i> Tambah Data
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>No.</th>
                        <th>Kode Obat</th>
                        <th>Nama Obat</th>
                        <th>Nama Distributor</th>
                        <th>Tipe Obat</th>
                        <th>Harga</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    $kueri = $koneksi->query("SELECT * FROM mstr_obat,mstr_distributor WHERE mstr_obat.DistributorCode = mstr_distributor.DistributorCode");
                    while($row = mysqli_fetch_array($kueri))
                    {
                        //edit
                        $edit = $koneksi->query("SELECT * FROM mstr_obat WHERE DrugsEstablishId = '$row[DrugsEstablishId]'");
                        $e = mysqli_fetch_array($edit);
                        ?>
                        <tr class="gradeX">
                            <td><a href="obat-edit-<?php echo $row['DrugsEstablishId']; ?>" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-search" aria-hidden="true"></i></a>
                            <a href="obat-delete-<?php echo $row['DrugsEstablishId']; ?>" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $row['DefinedCode']; ?></td>
                            <td><?php echo $row['DrugsName']; ?></td>
                            <td><?php echo $row['DistributorName']; ?></td>
                            <td><?php echo $row['Unit']; ?></td>
                            <td>Rp. <?php echo format_rupiah($row['SellingPrice']); ?></td>
                        </tr>
                        <!--Modal Edit-->
                        <div class="modal inmodal fade" id="myModal<?php echo $row['DrugsEstablishId']; ?>" role="dialog"  aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                <form method="POST" action="obat-update">
                                    <input type="hidden" name="id" value="<?php echo $row['DrugsEstablishId']; ?>">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Edit Obat</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Posisi Obat</label>
                                                <select name="pot" class="form-control" required>
                                                    <?php
                                                    $pot = $koneksi->query("SELECT * FROM mstr_drugsposition");
                                                    while($p = mysqli_fetch_array($pot))
                                                    {
                                                        if($p['DrugsPositionCode'] == $e['DrugsPositionCode'])
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
                                                <label>Jenis Obat</label>
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
                                            <div class="col-md-6">
                                                <label>Nama Distributor</label>
                                                <select name="distributor" class="select2_demo_1 form-control" required>
                                                    <?php
                                                    $distri = $koneksi->query("SELECT * FROM mstr_distributor");
                                                    while($d = mysqli_fetch_array($distri))
                                                    {
                                                        if($d['DistributorCode'] == $e['DistributorCode'])
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
                                                <label>Nama Pabrikan</label>
                                                <select name="pabrikan" class="select2_demo_2 form-control" required>
                                                    <?php
                                                    $pabrikan = $koneksi->query("SELECT * FROM mstr_principle");
                                                    while($pt = mysqli_fetch_array($pabrikan))
                                                    {
                                                        if($pt['PrincipleCode'] == $e['PrincipleCode'])
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
                                                <label>Tipe Obat</label>
                                                <input type="text" name="tipe" class="form-control" value="<?php echo $e['Unit']; ?>" required>
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
                                                <label>Ukuran / Isi</label>
                                                <input name="ukuran" class="form-control" value="<?php echo $row['Strength']; ?>" required>
                                                <label>Harga Dasar</label>
                                                <input name="harga_dasar" class="form-control" value="<?php echo $row['BasicPrice']; ?>" required>
                                                <label>Harga Jual</label>
                                                <input name="harga_jual" class="form-control" value="<?php echo $row['SellingPrice']; ?>" required>
                                                <label>Biaya Jasa</label>
                                                <input name="biaya_jasa" class="form-control" value="<?php echo $row['SeviceFactorPrice']; ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                        <?php
                        $no++;

                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                    <th>#</th>
                        <th>No.</th>
                        <th>Kode Obat</th>
                        <th>Nama Obat</th>
                        <th>Nama Distributor</th>
                        <th>Tipe Obat</th>
                        <th>Harga</th>
                    </tr>
                    </tfoot>
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