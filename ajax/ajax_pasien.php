<?php
require_once 'koneksi.php';

if ($_GET['action'] == "table_data") {


    $columns = array(
        0 => 'id',
        1 => 'no_kartu',
        2 => 'nama',
        3 => 'sex',
        4 => 'tanggal_lahir',
        5 => 'hp',
    );

    //$querycount = $mysqli->query("SELECT count(id) as jumlah FROM tbl_kontak");
    $querycount = $mysqli->query("SELECT count(id) as jumlah FROM mstr_pasien");
    $datacount = $querycount->fetch_array();


    $totalData = $datacount['jumlah'];

    $totalFiltered = $totalData;

    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order']['0']['column']];
    $dir = $_POST['order']['0']['dir'];

    if (empty($_POST['search']['value'])) {
        $query = $mysqli->query("SELECT id,no_kartu,nama,sex,tanggal_lahir,hp FROM mstr_pasien ORDER BY $order $dir 
        																LIMIT $limit 
        																OFFSET $start");
    } else {
        $search = $_POST['search']['value'];

        $query = $mysqli->query("SELECT id,no_kartu,nama,sex,tanggal_lahir,hp FROM mstr_pasien WHERE nama LIKE '%$search%' order by $order $dir LIMIT $limit OFFSET $start");

        $querycount = $mysqli->query("SELECT count(id) as jumlah FROM mstr_pasien WHERE nama LIKE '%$search%'");
        $datacount = $querycount->fetch_array();
        $totalFiltered = $datacount['jumlah'];
    }

    $data = array();
    if (!empty($query)) {
        $no = $start + 1;
        while ($r = $query->fetch_array()) {
            $nestedData['no'] = $no;
            $nestedData['no_kartu'] = $r['no_kartu'];
            $nestedData['nama'] = $r['nama'];
            $nestedData['sex'] = $r['sex'];
            $nestedData['tanggal_lahir'] = $r['tanggal_lahir'];
            $nestedData['aksi'] = "<a href='pasien-add-$r[no_kartu]' class='btn-warning btn-sm'>Add</a>";
            $data[] = $nestedData;
            $no++;
        }
    }

    $json_data = array(
        "draw"            => intval($_POST['draw']),
        "recordsTotal"    => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "data"            => $data
    );

    echo json_encode($json_data);
}
