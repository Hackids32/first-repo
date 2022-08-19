<?php
session_start();
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
    echo "<script>window.location='index.php';</script>";
} else {
    include "../../config/koneksi.php";
    include "../../config/koneksi2.php";
    include "../../config/fungsi_kode_otomatis.php";
    include "../../config/class_paging.php";
    include "../../config/fungsi_rupiah.php";
    include "../../config/fungsi_indotgl.php";
    include "../../config/library.php";
    include "../../config/fungsi_combobox.php";
    include "../../config/fungsi_seo.php";
    include "../../config/fungsi_thumb.php";
    include "../../detect.php";

    $id = $_GET['id'];

    $update = $koneksi2->query("SELECT * FROM mstr_pasien WHERE no_kartu = '$id'");
    $row = mysqli_fetch_array($update);
}
?>
<script>
    // Set item
    var nama = "<?php echo $row['nama']; ?>";
    var no_pasien = "<?php echo $row['no_kartu']; ?>";
    var hp = "<?php echo $row['hp']; ?>";

    localStorage.setItem("no_pasien", no_pasien);
    localStorage.setItem("nama", nama);
    localStorage.setItem("hp", hp);
    window.location = 'kasir-pasien';
</script>