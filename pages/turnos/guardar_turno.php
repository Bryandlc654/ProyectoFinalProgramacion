<?php
header('Content-Type: application/json');
require_once('../../database/database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombreTurn = $_POST['nombreturn'];
    $horarioTurn = $_POST['hoRarioturn'];

    $stmt = $conexion->prepare("INSERT INTO Turnos(Nombre_Turno,Horario_Turno) VALUES (?,?)");
    $stmt->bind_param("ss", $nombreTurn, $horarioTurn);
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
