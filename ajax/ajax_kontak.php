<?php
require_once 'koneksi.php';

if ($_GET['action'] == "table_data") {


    $columns = array(
        0 => 'id',
        1 => 'no_reg',
        2 => 'tgl',
        3 => 'no_pasien',
        4 => 'nama',
        5 => 'id',
    );

    //$querycount = $mysqli->query("SELECT count(id) as jumlah FROM tbl_kontak");
    $querycount = $mysqli->query("SELECT count(trxn_registrasi.id) as jumlah FROM trxn_registrasi, mstr_pasien WHERE trxn_registrasi.no_pasien = mstr_pasien.no_kartu");
    $datacount = $querycount->fetch_array();


    $totalData = $datacount['jumlah'];

    $totalFiltered = $totalData;

    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order']['0']['column']];
    $dir = $_POST['order']['0']['dir'];

    if (empty($_POST['search']['value'])) {
        $query = $mysqli->query("SELECT trxn_registrasi.id,trxn_registrasi.no_reg,trxn_registrasi.tgl,trxn_registrasi.no_pasien,mstr_pasien.nama FROM trxn_registrasi, mstr_pasien WHERE trxn_registrasi.no_pasien = mstr_pasien.no_kartu order by $order $dir 
        																LIMIT $limit 
        																OFFSET $start");
    } else {
        $search = $_POST['search']['value'];
        /*$query = $mysqli->query("SELECT trxn_registrasi.id,trxn_registrasi.no_reg,trxn_registrasi.tgl,trxn_registrasi.no_pasien,mstr_pasien.nama FROM trxn_registrasi, mstr_pasien WHERE trxn_registrasi.no_pasien = mstr_pasien.no_kartu AND trxn_registrasi.no_reg LIKE '%$search%' 
            															or trxn_registrasi.tgl LIKE '%$search%' 
                                                                        or trxn_registrasi.no_pasien LIKE '%$search%'
                                                                        or mstr_pasien.nama LIKE '%$search%'
            															order by $order $dir 
            															LIMIT $limit 
            															OFFSET $start");*/

        $query = $mysqli->query("SELECT trxn_registrasi.id,trxn_registrasi.no_reg,trxn_registrasi.tgl,trxn_registrasi.no_pasien,mstr_pasien.nama FROM trxn_registrasi, mstr_pasien WHERE trxn_registrasi.no_pasien = mstr_pasien.no_kartu AND mstr_pasien.nama LIKE '%$search%'
order by $order $dir 
LIMIT $limit 
OFFSET $start");


        $querycount = $mysqli->query("SELECT count(trxn_registrasi.id) as jumlah FROM trxn_registrasi, mstr_pasien WHERE trxn_registrasi.no_pasien = mstr_pasien.no_kartu AND mstr_pasien.nama LIKE '%$search%'");
        $datacount = $querycount->fetch_array();
        $totalFiltered = $datacount['jumlah'];
    }

    $data = array();
    if (!empty($query)) {
        $no = $start + 1;
        while ($r = $query->fetch_array()) {
            $nestedData['no'] = $no;
            $nestedData['no_reg'] = $r['no_reg'];
            $nestedData['tgl'] = $r['tgl'];
            $nestedData['no_pasien'] = $r['no_pasien'];
            $nestedData['nama'] = $r['nama'];
            $nestedData['aksi'] = "<a href='register-add-$r[no_reg]' class='btn-warning btn-sm'>Add</a>";
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
