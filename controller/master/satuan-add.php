<?php
if(empty($_SESSION['username']) AND empty($_SESSION['passuser']))
{
    echo"<script>window.location='index.php';</script>";
}
else
{
    $prefix = date('Ymd').'DU';
    $generate = autonumber("mstr_drugsunit","DrugsUnitId",4,$prefix);
    ?>
<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Tambah Satuan Obat</h5>
                        </div>
                        <div class="ibox-content">
                            <form method="POST" action="satuan-obat-simpan">   
                            <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="font-normal">Kode Satuan Obat</label>
                                                    <div class="input-group">
                                                        <input type="text" name="kode_satuan" class="form-control" value="<?php echo $generate; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Nama Satuan Obat</label>
                                                    <div class="input-group">
                                                        <input name="nama_satuan" type="text" class="form-control" placeholder="Nama Satuan Obat" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Keterangan</label>
                                                    <div class="input-group">
                                                        <input name="keterangan" type="text" class="form-control" placeholder="Keterangan" required>
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