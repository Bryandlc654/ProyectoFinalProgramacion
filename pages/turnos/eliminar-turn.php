<?php
header('Content-Type: application/json');
require_once('../../database/database.php');

if ($_SERVER["REQUEST_METHOD"]) {
    $turn_idEdit= $_POST['turn_idEdit'];

    // Preparar la consulta SQL para eliminar
    $stmt = $conexion->prepare("DELETE FROM Turnos where Id_Turno=?");
    $stmt->bind_param("i", $turn_idEdit);

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
