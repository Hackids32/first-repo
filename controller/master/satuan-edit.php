<?php
if(empty($_SESSION['username']) AND empty($_SESSION['passuser']))
{
    echo"<script>window.location='index.php';</script>";
}
else
{
    $edit = $koneksi->query("SELECT * FROM mstr_drugsunit WHERE DrugsUnitId = '$_GET[id]'");
    $row = mysqli_fetch_array($edit);
    ?>
<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Edit Satuan Obat</h5>
                        </div>
                        <div class="ibox-content">
                            <form method="POST" action="satuan-obat-update">   
                            <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="font-normal">Kode Satuan Obat</label>
                                                    <div class="input-group">
                                                        <input type="text" name="kode_satuan" class="form-control" value="<?php echo $row['DrugsUnitCode']; ?>" readonly>
                                                        <input type="hidden" name="id" class="form-control" value="<?php echo $row['DrugsUnitId']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Nama Satuan Obat</label>
                                                    <div class="input-group">
                                                        <input name="nama_satuan" type="text" class="form-control" placeholder="Nama Satuan Obat" value="<?php echo $row['DrugsUnitName']; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Keterangan</label>
                                                    <div class="input-group">
                                                        <input name="keterangan" type="text" class="form-control" placeholder="Keterangan" value="<?php echo $row['Description']; ?>" required>
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