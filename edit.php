<?php 

require_once __DIR__ . '/helpers.php';

$json = file_get_contents('php://input');
$idEmployee = json_decode($json, true);
$idEmployee = filter_var($idEmployee, FILTER_VALIDATE_INT);

if ( is_numeric($idEmployee) ) {
    $sql = "SELECT * FROM employee WHERE id = :id";
    $stmt = connection()->prepare($sql);
    $stmt->bindParam(':id', $idEmployee, PDO::PARAM_INT);
    $stmt->execute();
    $employee = $stmt->fetch(PDO::FETCH_OBJ);
    if ( $employee ) {
        echo json_encode($employee, JSON_UNESCAPED_UNICODE);
    } else {
        redirec('/');
    }
} else {
    redirec('/');
}