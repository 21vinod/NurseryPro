<?php
session_start();
require_once('../model/pdo.php');

function fetchDataFromDatabase($pdo, $page, $recordsPerPage)
{
    $offset = ($page - 1) * $recordsPerPage;
    $stmt = $pdo->query("SELECT * FROM items LIMIT $offset, $recordsPerPage");
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $data;
}

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$recordsPerPage = 5; 
$data['records'] = fetchDataFromDatabase($pdo, $page, $recordsPerPage);
$totalRecords = 20;
$data['total_pages'] = ceil($totalRecords / $recordsPerPage);

header('Content-Type: application/json');
echo json_encode($data);
?>