<?php
include "../../config/koneksi.php";
include "../../config/koneksi2.php";
include "../../config/fungsi_rupiah.php";
$total = 0;
$jml = 0;
$no_reg = $_GET['id'];
$kueri = $koneksi->query("SELECT * FROM trxn_saledrugs WHERE SalesDrugsCode = '$_GET[id]' ORDER BY SaleDrugsId DESC LIMIT 1");
$k = mysqli_fetch_array($kueri);
$kueri2 = $koneksi->query("SELECT * FROM rltn_transdrugsitem_tmp WHERE SalesDrugsCode = '$_GET[id]'");
while ($l = mysqli_fetch_array($kueri2)) {
    $total = $total + $l['SubTotal'];
}
//count pembayaran
$kueri3 = $koneksi2->query("SELECT * FROM trxn_pembayaran WHERE no_reg = '$_GET[id]'");
while ($m = mysqli_fetch_array($kueri3)) {
    $jml = $jml + $m['uang'];
}
$balance = $k['GrandTotalPayment'] - $jml;
?>
<form method="POST" action="simpan-transaksi.php" target="_blank">
    <table class="table table-bordered" width="100%">
        <tr>
            <td width="50%">No. Invoice<br><input type="hidden" name="no_invoice" value="<?php echo $k['SalesDrugsNumber']; ?>" class="form-control" readonly><?php echo $k['SalesDrugsNumber']; ?></td>
            <td width="50%">Total<br><input type="hidden" name="total" value="<?php echo $k['GrandTotalPayment']; ?>" class="form-control" readonly>Rp. <?php echo format_rupiah($k['GrandTotalPayment']); ?></td>
        </tr>
        <tr>
            <td width="50%">No. Reg.<br><input type="hidden" name="no_reg" value="<?php echo $k['SalesDrugsCode']; ?>" class="form-control" readonly><?php echo $k['SalesDrugsCode']; ?></td>
            <td width="50%">Paid<br><input type="hidden" name="paid" value="<?php echo $jml; ?>" class="form-control" readonly>Rp. <?php echo format_rupiah($jml); ?></td>
        </tr>
        <tr>
            <td width="50%">Tanggal<br><input type="hidden" name="tgl" value="<?php echo $k['RegisterAt']; ?>" class="form-control" readonly><?php echo $k['RegisterAt']; ?></td>
            <td width="50%">Balance<br><input type="hidden" name="balance" value="<?php echo $balance; ?>" class="form-control" readonly>Rp. <?php echo format_rupiah($balance); ?></td>
        </tr>
        <tr>
            <td colspan="2" width="100%"><button type="submit" name="simpan" class="btn btn-primary btn-block">Simpan Transaksi</button></td>
        </tr>
    </table>
</form>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">No.</th>
            <th scope="col">Tgl</th>
            <th scope="col">Cara Bayar</th>
            <th scope="col">Nama Bank</th>
            <th scope="col">Card No.</th>
            <th scope="col">Total</th>
            <th scope="col">Bayar</th>
            <th scope="col">Kembali</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $query = $koneksi2->query("SELECT trxn_pembayaran.* , mstr_jenis_bayar.nama, mstr_jenis_bayar.status FROM trxn_pembayaran, mstr_jenis_bayar WHERE trxn_pembayaran.type = mstr_jenis_bayar.id AND trxn_pembayaran.no_reg = '$no_reg'");
        while ($result = mysqli_fetch_array($query)) {
            if ($result['bank'] == '-') {
                $bank = '-';
            } elseif ($result['bank'] == '0') {
                $bank = '-';
            } else {
                $query2 = $koneksi2->query("SELECT * FROM mstr_bank WHERE id = '$result[bank]'");
                $result2 = mysqli_fetch_array($query2);
                $bank = $result2['bank'];
            }

        ?>
            <tr>
                <td>
                    <a href="delete-payment-pasien.php?id=<?php echo $result['id']; ?>" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                </td>
                <td>
                    <?php echo $no++; ?>
                </td>
                <td>
                    <?php echo $result['tgl']; ?>
                </td>
                <td>
                    <?php echo $result['nama']; ?>
                </td>
                <td>
                    <?php echo $bank; ?>
                </td>
                <td>
                    <?php echo $result['card']; ?>
                </td>
                <td>
                    <?php echo $result['jumlah']; ?>
                </td>
                <td>
                    <?php echo $result['uang']; ?>
                </td>
                <td>
                    <?php echo $result['kembali']; ?>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<script>
    localStorage.setItem("balance", "<?php echo $balance; ?>");
    document.getElementById("totbay").value = localStorage.getItem("balance");
    document.getElementById("totbay2").value = localStorage.getItem("balance");
</script>