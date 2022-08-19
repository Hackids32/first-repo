<?php
include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";
include "../../config/fungsi_rupiah.php";
if ($_POST['rowid']) {
    $id = $_POST['rowid'];
    $edit = $koneksi->query("SELECT * FROM rltn_transdrugsitem_tmp WHERE TransDrugItemId = '$id'");
    $r = mysqli_fetch_array($edit, MYSQLI_ASSOC);
?>
    <link href="../../css/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="../../css/plugins/select2/select2-bootstrap4.min.css" rel="stylesheet">
    <form method="POST" action="model/transaksi/detail-umum-save.php">
        <input type="hidden" name="id" value="<?php echo $r['TransDrugItemId']; ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><b>Kode Barang</b></label>
                    <select name="kode_barang" class="form-control select2_demo_3">
                        <?php
                        $con = $koneksi->query("SELECT * FROM mstr_obat ORDER BY DrugsName ASC");
                        while ($data = mysqli_fetch_array($con)) {
                            if ($r['EstablishCode'] == $data['EstablishCode']) {
                                echo "<option value='$data[EstablishCode]' selected>$data[DrugsName] - Rp. $data[SellingPrice]</option>";
                            } else {
                                echo "<option value='$data[EstablishCode]'>$data[DrugsName] - Rp. $data[SellingPrice]</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label><b>Qty</b></label>
                    <input type="text" name="qty" class="form-control" value="<?php echo $r['Unit']; ?>" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label><b>Biaya Jasa</b></label>
                    <input type="text" name="biaya_jasa" class="form-control" value="<?php echo $r['ServicePrice']; ?>" required>
                </div>

                <div class="form-group">
                    <label><b>Diskon Percent (%)</b></label>
                    <input type="text" name="diskon" class="form-control" value="<?php echo $r['DiscPercent']; ?>" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" name="update" class="btn btn-info">Update</button>
            </div>
        </div>
    </form>

    <!-- Select2 -->
    <script src="../../js/plugins/select2/select2.full.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".select2_demo_1").select2({
                theme: 'bootstrap4',
            });
            $(".select2_demo_2").select2({
                theme: 'bootstrap4',
            });
            $(".select2_demo_3").select2({
                theme: 'bootstrap4',
                placeholder: "Select a state",
                allowClear: true
            });
        });
    </script>
<?php } //}

?>