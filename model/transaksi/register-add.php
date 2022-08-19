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

    $update = $koneksi2->query("SELECT * FROM trxn_registrasi, mstr_pasien WHERE trxn_registrasi.no_pasien = mstr_pasien.no_kartu AND trxn_registrasi.no_reg = '$id'");
    $row = mysqli_fetch_array($update);
}
?>
<script>
    // Set item
    var htmlString = "<?php echo $row['no_reg']; ?>";
    var nama = "<?php echo $row['nama']; ?>";
    var no_pasien = "<?php echo $row['no_pasien']; ?>";
    var hp = "<?php echo $row['hp']; ?>";
    var id_dokter = "<?php echo $row['no_dokter']; ?>";
    localStorage.setItem("no_reg", htmlString);
    localStorage.setItem("no_pasien", no_pasien);
    localStorage.setItem("nama", nama);
    localStorage.setItem("hp", hp);
    localStorage.setItem("id_dokter", id_dokter);
    window.location = 'kasir-register';
</script>