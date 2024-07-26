<?php
header('Content-Type: application/json');
require_once('../../database/database.php');

if ($_SERVER["REQUEST_METHOD"]) {
    $usuarioId = $_POST['eliminarUsuarioId'];

    // Preparar la consulta SQL para eliminar
    $stmt = $conexion->prepare("UPDATE Usuarios SET Estatus_Usuario=0 WHERE Id_Usuario= ?");
    $stmt->bind_param("i", $usuarioId);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo json_encode(array("status" => "success", "message" => "El usuario ha sido deshabilitado exitosamente."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error al deshabilitar el usuario. Por favor, intenta nuevamente."));
    }
    // Cerrar la consulta preparada
    $stmt->close();
    exit();
}
