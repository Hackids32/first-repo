<?php
if(empty($_SESSION['username']) AND empty($_SESSION['passuser']))
{
    echo"<script>window.location='index.php';</script>";
}
else
{
    ?>
<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Tambah Principle</h5>
                        </div>
                        <div class="ibox-content">
                            <form method="POST" action="principle-simpan">   
                            <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="font-normal">Nama Principle</label>
                                                    <div class="input-group">
                                                        <input name="nama_principle" type="text" class="form-control" placeholder="Nama Principle" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Kode Manufaktur</label>
                                                    <div class="input-group">
                                                        <input name="kode_manufaktur" type="text" class="form-control" placeholder="Kode Manufaktur">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Alamat 1</label>
                                                    <div class="input-group">
                                                        <input name="alamat" type="text" class="form-control" placeholder="Alamat">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Alamat 2</label>
                                                    <div class="input-group">
                                                        <input name="alamat2" type="text" class="form-control" placeholder="Alamat 2">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Kota</label>
                                                    <div class="input-group">
                                                        <input name="kota" type="text" class="form-control" placeholder="Kota">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Kode Pos</label>
                                                    <div class="input-group">
                                                        <input name="pos" type="text" class="form-control" placeholder="Pos">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="font-normal">Telepon</label>
                                                    <div class="input-group">
                                                        <input name="telepon" type="text" class="form-control" placeholder="Telepon">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Fax</label>
                                                    <div class="input-group">
                                                        <input name="fax" type="text" class="form-control" placeholder="Fax">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Email</label>
                                                    <div class="input-group">
                                                        <input name="email" type="email" class="form-control" placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">PIC</label>
                                                    <div class="input-group">
                                                        <input name="pic" type="text" class="form-control" placeholder="PIC">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Telepon PIC</label>
                                                    <div class="input-group">
                                                        <input name="telepon_pic" type="text" class="form-control" placeholder="Nama PIC">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Email PIC</label>
                                                    <div class="input-group">
                                                        <input name="email_pic" type="email" class="form-control" placeholder="Email PIC">
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