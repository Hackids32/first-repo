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
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>List Satuan Obat</h5>
                        <div class="ibox-tools">
                            <a href="satuan-obat-add" class="btn btn-primary btn-sm">
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
                        <th>Kode Satuan Obat</th>
                        <th>Nama Satuan Obat</th>
                        <th>Keterangan</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    $kueri = $koneksi->query("SELECT * FROM mstr_drugsunit ORDER BY DrugsUnitName ASC");
                    while($row = mysqli_fetch_array($kueri))
                    {
                        ?>
                        <tr class="gradeX">
                            <td><a href="satuan-obat-edit-<?php echo $row['DrugsUnitId']; ?>" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-search" aria-hidden="true"></i></a>
                            <a href="satuan-obat-delete-<?php echo $row['DrugsUnitId']; ?>" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $row['DrugsUnitCode']; ?></td>
                            <td><?php echo $row['DrugsUnitName']; ?></td>
                            <td><?php echo $row['Description']; ?></td>
                        </tr>
                        <?php
                        $no++;

                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>No.</th>
                        <th>Kode Satuan Obat</th>
                        <th>Nama Satuan Obat</th>
                        <th>Keterangan</th>
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