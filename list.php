<?php
require_once __DIR__ . '/helpers.php';

$sql = "SELECT * FROM employee";
$stmt = connection()->prepare($sql);
$stmt->execute();
$employees = $stmt->fetchAll(PDO::FETCH_OBJ);
if ( $employees ) {
    echo json_encode($employees, JSON_UNESCAPED_UNICODE);
} else {
    redirec('/');
}