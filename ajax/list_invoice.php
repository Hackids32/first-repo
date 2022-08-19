<?php
require_once 'koneksi2.php';

//if ($_GET['action'] == "table_data") {


$columns = array(
    0 => 'SaleDrugsId',
    1 => 'SalesDrugsCode',
    2 => 'SalesDrugsNumber',
    3 => 'CustomerName',
    4 => 'PasienId',
    5 => 'CustomerType',
    6 => 'GrandTotalPayment',
    7 => 'RegisterAt',
    8 => 'Status',
);

//$querycount = $mysqli->query("SELECT count(id) as jumlah FROM tbl_kontak");
$querycount = $mysqli->query("SELECT count(SaleDrugsId) as jumlah FROM trxn_saledrugs");
$datacount = $querycount->fetch_array();


$totalData = $datacount['jumlah'];

$totalFiltered = $totalData;

$limit = $_POST['length'];
$start = $_POST['start'];
$order = $columns[$_POST['order']['0']['column']];
$dir = $_POST['order']['0']['dir'];

if (empty($_POST['search']['value'])) {
    $query = $mysqli->query("SELECT SaleDrugsId,SalesDrugsCode,SalesDrugsNumber,CustomerName,PasienId,CustomerType,GrandTotalPayment,RegisterAt,Status FROM trxn_saledrugs ORDER BY $order $dir LIMIT $limit OFFSET $start");
} else {
    $search = $_POST['search']['value'];

    $query = $mysqli->query("SELECT SaleDrugsId,SalesDrugsCode,SalesDrugsNumber,CustomerName,PasienId,CustomerType,GrandTotalPayment,RegisterAt,Status FROM trxn_saledrugs WHERE SalesDrugsCode LIKE '%$search%' order by $order $dir LIMIT $limit OFFSET $start");

    $querycount = $mysqli->query("SELECT count(SaleDrugsId) as jumlah FROM trxn_saledrugs WHERE SalesDrugsCode LIKE '%$search%'");
    $datacount = $querycount->fetch_array();
    $totalFiltered = $datacount['jumlah'];
}

$data = array();
if (!empty($query)) {
    $no = $start + 1;
    while ($r = $query->fetch_array()) {
        $nestedData['no'] = $no;
        $nestedData['SalesDrugsCode'] = $r['SalesDrugsCode'];
        $nestedData['SalesDrugsNumber'] = $r['SalesDrugsNumber'];
        $nestedData['CustomerName'] = $r['CustomerName'];
        $nestedData['PasienId'] = $r['PasienId'];
        if ($r['CustomerType'] == '1') {
            $tipe = 'Pasien Register';
            $url = 'edit-register';
        } elseif ($r['CustomerType'] == '2') {
            $tipe = 'Umum';
            $url = 'edit-umum';
        } elseif ($r['CustomerType'] == '3') {
            $tipe = 'Pasien';
            $url = 'edit-pasien';
        }
        $nestedData['CustomerType'] = $tipe;
        $nestedData['GrandTotalPayment'] = rupiah($r['GrandTotalPayment']);
        $nestedData['RegisterAt'] = $r['RegisterAt'];
        if ($r['Status'] == '1') {
            $status = 'Baru / Belum Bayar';
        } elseif ($r['Status'] == '2') {
            $status = 'Sudah Bayar';
        }
        $nestedData['Status'] = $status;
        $nestedData['aksi'] = "<a href='controller/transaksi/kwitansi.php?id=$r[SalesDrugsNumber]' target='_blank' class='btn-danger btn-sm'><i class='fa fa-print' aria-hidden='true'></i></a>
        <a href='controller/transaksi/cetak_umum.php?id=$r[SalesDrugsCode]' target='_blank' class='btn-warning btn-sm'><i class='fa fa-file' aria-hidden='true'></i></a>
        <a href='$url-$r[SalesDrugsCode]' class='btn-primary btn-sm'><i class='fa fa-pencil' aria-hidden='true'></i></a>";
        $data[] = $nestedData;
        $no++;
    }
}

//function format rupiah
function rupiah($angka)
{
    $hasil_rupiah = "Rp. " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}

$json_data = array(
    "draw"            => intval($_POST['draw']),
    "recordsTotal"    => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data"            => $data
);

echo json_encode($json_data);
//}
