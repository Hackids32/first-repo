<?php
include 'config/config.php';
function format_rupiah($angka)
{
    $rupiah = number_format($angka, 0, ',', '.');
    return $rupiah;
}

// Number of records fetch
$numberofrecords = 10;

if (!isset($_POST['searchTerm'])) {

    // Fetch records
    $stmt = $conn->prepare("SELECT EstablishCode,DrugsName,DefinedCode,stok_awal,SellingPrice FROM mstr_obat ORDER BY DrugsName ASC LIMIT :limit");
    $stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
    $stmt->execute();
    $usersList = $stmt->fetchAll();
} else {

    $search = $_POST['searchTerm']; // Search text

    // Fetch records
    $stmt = $conn->prepare("SELECT EstablishCode,DrugsName,DefinedCode,stok_awal,SellingPrice FROM mstr_obat WHERE DrugsName like :name ORDER BY DrugsName ASC LIMIT :limit");
    $stmt->bindValue(':name', '%' . $search . '%', PDO::PARAM_STR);
    $stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
    $stmt->execute();
    $usersList = $stmt->fetchAll();
}

$response = array();

// Read Data
foreach ($usersList as $user) {
    $response[] = array(
        "id" => $user['EstablishCode'], //for value
        "text" => $user['DrugsName'],
        "html" =>  "<div style='color:black'>" . $user['DrugsName'] . " - Rp. " . format_rupiah($user['SellingPrice']) . "</div><div><small><i>" . $user['EstablishCode'] . "</i></small></div>",
        "title" =>  $user['DrugsName']
    );
}

echo json_encode($response);
