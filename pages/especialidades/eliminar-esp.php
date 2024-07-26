<?php
header('Content-Type: application/json');
require_once('../../database/database.php');

if ($_SERVER["REQUEST_METHOD"]) {
    $esp_idEdit = $_POST['esp_idEdit'];

    // Preparar la consulta SQL para eliminar
    $stmt = $conexion->prepare("DELETE FROM Especialidades where Id_Especialidad=?");
    $stmt->bind_param("i", $esp_idEdit);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo json_encode(array("status" => "success", "message" => "Eliminado exitosamente."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error al eliminar. ."));
    }
    // Cerrar la consulta preparada
    $stmt->close();
    exit();
}
