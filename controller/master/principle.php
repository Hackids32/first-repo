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
                        <h5>List Principle</h5>
                        <div class="ibox-tools">
                            <a href="principle-add" class="btn btn-primary btn-sm">
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
                        <th>Kode Principle</th>
                        <th>Nama Principle</th>
                        <th>Kota</th>
                        <th>Email PIC</th>
                        <th>Telepon</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    $kueri = $koneksi->query("SELECT * FROM mstr_principle ORDER BY PrincipleId ASC");
                    while($row = mysqli_fetch_array($kueri))
                    {
                        ?>
                        <tr class="gradeX">
                            <td><a href="principle-edit-<?php echo $row['PrincipleId']; ?>" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-search" aria-hidden="true"></i></a>
                            <a href="principle-delete-<?php echo $row['PrincipleId']; ?>" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $row['PrincipleCode']; ?></td>
                            <td><?php echo $row['PrincipleName']; ?></td>
                            <td><?php echo $row['City']; ?></td>
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
                        <th>Kode Principle</th>
                        <th>Nama Principle</th>
                        <th>Kota</th>
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