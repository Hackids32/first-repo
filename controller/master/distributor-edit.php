<?php
if(empty($_SESSION['username']) AND empty($_SESSION['passuser']))
{
    echo"<script>window.location='index.php';</script>";
}
else
{
    $cek2 = $koneksi->query("SELECT * FROM mstr_distributor WHERE DistributorId = '$_GET[id]'");
    $row = mysqli_fetch_array($cek2);
    ?>

<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Edit Distributor</h5>
                        </div>
                        <div class="ibox-content">
                        <form method="POST" action="distributor-update">   
                            <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="font-normal">Kode Distributor</label>
                                                    <div class="input-group">
                                                        <input type="text" name="kode_distributor" class="form-control" value="<?php echo $row['DistributorCode']; ?>" readonly>
                                                        <input type="hidden" name="id" class="form-control" value="<?php echo $row['DistributorId']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Nama Distributor</label>
                                                    <div class="input-group">
                                                        <input name="nama_distributor" type="text" class="form-control" value="<?php echo $row['DistributorName']; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Nama Official</label>
                                                    <div class="input-group">
                                                        <input name="nama_official" type="text" class="form-control" value="<?php echo $row['OfficialName']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Alamat 1</label>
                                                    <div class="input-group">
                                                        <input name="alamat" type="text" class="form-control" value="<?php echo $row['FirstAddress']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Alamat 2</label>
                                                    <div class="input-group">
                                                        <input name="alamat2" type="text" class="form-control" value="<?php echo $row['SecondAddress']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Alamat 3</label>
                                                    <div class="input-group">
                                                        <input name="alamat3" type="text" class="form-control" value="<?php echo $row['ThirdAddress']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Kota</label>
                                                    <div class="input-group">
                                                        <input name="kota" type="text" class="form-control" value="<?php echo $row['City']; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="font-normal">Kode Pos</label>
                                                    <div class="input-group">
                                                        <input name="pos" type="text" class="form-control" value="<?php echo $row['PostalCode']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Telepon</label>
                                                    <div class="input-group">
                                                        <input name="telepon" type="text" class="form-control" value="<?php echo $row['PhoneNumber']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Fax</label>
                                                    <div class="input-group">
                                                        <input name="fax" type="text" class="form-control" value="<?php echo $row['FaxNumber']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Email</label>
                                                    <div class="input-group">
                                                        <input name="email" type="email" class="form-control" value="<?php echo $row['Email']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">PIC</label>
                                                    <div class="input-group">
                                                        <input name="pic" type="text" class="form-control" value="<?php echo $row['PIC']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Telepon PIC</label>
                                                    <div class="input-group">
                                                        <input name="telepon_pic" type="text" class="form-control" value="<?php echo $row['PICphoneNumber']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-normal">Email PIC</label>
                                                    <div class="input-group">
                                                        <input name="email_pic" type="email" class="form-control" value="<?php echo $row['PICemail']; ?>">
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