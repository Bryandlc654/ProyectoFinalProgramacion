<?php
header('Content-Type: application/json');
require_once('../../database/database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $especialidadAula = $_POST['especialidadAula'];
    $semestreAula = $_POST['semestreAula'];
    $seccionAula = $_POST['seccionAula'];
    $periodoAula = $_POST['periodoAula'];
    $turnoAula = $_POST['turnoAula'];

    $stmt = $conexion->prepare("INSERT INTO Aulas(Id_Especialidad,Semestre_Especialidad,Seccion_Especialidad,Perido_Especialidad,Id_Turno) VALUES (?,?,?,?,?)");
    $stmt->bind_param("isssi", $especialidadAula, $semestreAula, $seccionAula, $periodoAula, $turnoAula);
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
