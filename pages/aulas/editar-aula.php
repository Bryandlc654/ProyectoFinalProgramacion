<?php
header('Content-Type: application/json');
require_once('../../database/database.php');

// Verificar si se ha enviado el formulario para editar 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idaulaEdit = $_POST['idaulaEdit'];
    $especialidadAulaEdit = $_POST['especialidadAulaEdit'];
    $semestreAulaEdit = $_POST['semestreAulaEdit'];
    $seccionAulaEdit = $_POST['seccionAulaEdit'];
    $periodoAulaEdit = $_POST['periodoAulaEdit'];
    $turnoAulaEdit = $_POST['turnoAulaEdit'];

    // Preparar la consulta SQL para actualizar 
    $stmt = $conexion->prepare("UPDATE Aulas SET Id_Especialidad=?,Semestre_Especialidad=?,Seccion_Especialidad=?,Perido_Especialidad=?,Id_Turno=? WHERE Id_Aula = ?");
    $stmt->bind_param("ssssii", $especialidadAulaEdit, $semestreAulaEdit, $seccionAulaEdit, $periodoAulaEdit, $turnoAulaEdit, $idaulaEdit);

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
