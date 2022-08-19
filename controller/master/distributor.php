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
                        <h5>List Distributor</h5>
                        <div class="ibox-tools">
                            <a href="distributor-add" class="btn btn-primary btn-sm">
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
                        <th>Kode Distributor</th>
                        <th>Nama Distributor</th>
                        <th>Nama PIC</th>
                        <th>Email PIC</th>
                        <th>Telepon</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    $kueri = $koneksi->query("SELECT * FROM mstr_distributor ORDER BY DistributorName ASC");
                    while($row = mysqli_fetch_array($kueri))
                    {
                        ?>
                        <tr class="gradeX">
                            <td><a href="distributor-edit-<?php echo $row['DistributorId']; ?>" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-search" aria-hidden="true"></i></a>
                            <a href="distributor-delete-<?php echo $row['DistributorId']; ?>" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $row['DistributorCode']; ?></td>
                            <td><?php echo $row['DistributorName']; ?></td>
                            <td><?php echo $row['PIC']; ?></td>
                            <td><?php echo $row['PICemail']; ?></td>
                            <td><?php echo $row['PhoneNumber']; ?></td>
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
                        <th>Kode Distributor</th>
                        <th>Nama Distributor</th>
                        <th>Nama PIC</th>
                        <th>Email PIC</th>
                        <th>Telepon</th>
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