<?php
header('Content-Type: application/json');
require_once('../../database/database.php');

// Verificar si se ha enviado el formulario para editar una aula
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idespEdit = $_POST['idespEdit'];
    $nombresEsp = $_POST['nombresEspEdit'];


    // Preparar la consulta SQL para actualizar la aula
    $stmt = $conexion->prepare("UPDATE Especialidades SET Nombre_Especialidad=? WHERE Id_Especialidad= ?");
    $stmt->bind_param("si", $nombresEsp, $idespEdit);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo json_encode(array("status" => "success", "message" => "Actualizado correctamente."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error al actualizar"));
    }
    // Cerrar la consulta preparada
    $stmt->close();
    exit();
}
