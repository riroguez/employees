<?php 
require_once __DIR__ . '/helpers.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = s($_POST['name']);
    $lastName = s($_POST['lastname']);
    $position = s($_POST['position']);
    $salary = s($_POST['salary']);
    $idEmployee = s($_POST['idEmployee']);

    if (!validate($name, 2, 50)) {
        $res = ['msg' => 'El nombre es requerido o, sobrepaso los 50 caracteres perminitidos', 'type' => 'danger'];
    } else if (!validate($lastName, 2, 50)) {
        $res = ['msg' => 'El nombre es requerido o, sobrepaso los 50 caracteres perminitidos', 'type' => 'danger'];
    } else if (!validate($position, 2, 50)) {
        $res = ['msg' => 'El puesto es requerido o, sobrepaso los 50 caracteres perminitidos', 'type' => 'danger'];
    } else if (!validate($salary, 2, 10)) {
        $res = ['msg' => 'El salario es requerido o, sobrepaso los 10 caracteres perminitidos', 'type' => 'danger'];
    } else {
        if ( empty($idEmployee )) {
            $sql = "INSERT INTO employee (name, lastname, position, salary) VALUES (:name, :lastname, :position, :salary)";
            $stmt = connection()->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':lastname', $lastName, PDO::PARAM_STR);
            $stmt->bindParam(':position', $position, PDO::PARAM_STR);
            $stmt->bindParam(':salary', $salary, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $res = ['msg' => 'El empleado fue creado exitosamente', 'type' => 'success'];
            } else {
                $res = ['msg' => 'Hubo un error al insertar el empleado', 'type' => 'danger'];
            }
        } else {
            $sql = "UPDATE employee SET name = :name, lastname = :lastname, position = :position, salary = :salary WHERE id = :id";
            $stmt = connection()->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':lastname', $lastName, PDO::PARAM_STR);
            $stmt->bindParam(':position', $position, PDO::PARAM_STR);
            $stmt->bindParam(':salary', $salary, PDO::PARAM_STR);
            $stmt->bindParam(':id', $idEmployee, PDO::PARAM_INT);

            if ( $stmt->execute() ) {
                $res = ['msg' => 'El empleado fue actualizado exitosamente', 'type' => 'success'];
            } else {
                $res = ['msg' => 'Hubo un error al actualizar el empleado', 'type' => 'danger'];
            }
        }

    }
} else {
    $res = ['msg' => 'Error desconocido', 'type' => 'danger'];
}
echo json_encode($res, JSON_UNESCAPED_UNICODE);
die();