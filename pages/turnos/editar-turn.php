<?php
header('Content-Type: application/json');
require_once('../../database/database.php');

// Verificar si se ha enviado el formulario para editar 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idturnEdit = $_POST['idturnEdit'];
    $nombreturnEdit = $_POST['nombreturnEdit'];
    $hoRarioturnEdit = $_POST['hoRarioturnEdit'];


    // Preparar la consulta SQL para actualizar 
    $stmt = $conexion->prepare("UPDATE Turnos SET Nombre_Turno=?,Horario_Turno=? WHERE Id_Turno= ?");
    $stmt->bind_param("ssi", $nombreturnEdit, $hoRarioturnEdit, $idturnEdit);

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
