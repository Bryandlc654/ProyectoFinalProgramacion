<?php
header('Content-Type: application/json');
require_once('../../database/database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombresEsp = $_POST['nombresEsp'];

    $stmt = $conexion->prepare("INSERT INTO Especialidades (Nombre_Especialidad) VALUES (?)");
    $stmt->bind_param("s", $nombresEsp);
    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo json_encode(array("status" => "success", "message" => "Registrado exitosamente."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error. Por favor, intenta nuevamente."));
    }
    // Cerrar la consulta preparada
    $stmt->close();
    exit();
}
