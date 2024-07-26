<?php
header('Content-Type: application/json');
require_once('../../database/database.php');

if ($_SERVER["REQUEST_METHOD"]) {
    $mat_idEdit= $_POST['mat_idEdit'];

    // Preparar la consulta SQL para eliminar
    $stmt = $conexion->prepare("DELETE FROM Matriculas where Id_Matricula=?");
    $stmt->bind_param("i", $mat_idEdit);

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
