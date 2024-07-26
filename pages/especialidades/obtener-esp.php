<?php
header('Content-Type: application/json');
require_once('../../database/database.php');


// Verificar si se ha enviado el ID de la sede
if ($_SERVER["REQUEST_METHOD"]) {
    $esp_idEdit = $_POST['esp_idEdit'];

    // Preparar la consulta SQL para obtener los detalles de la sede
    $stmt = $conexion->prepare("SELECT Id_Especialidad,Nombre_Especialidad FROM Especialidades WHERE Id_Especialidad = ?");
    $stmt->bind_param("i", $esp_idEdit);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Obtener el resultado de la consulta
        $result = $stmt->get_result();

        // Verificar si se encontraron resultados
        if ($result->num_rows > 0) {
            // Obtener los detalles de la sede y devolverlos en formato JSON
            $especialidad = $result->fetch_assoc();
            echo json_encode($especialidad);
        } else {
            // No se encontraron detalles de la sede con el ID proporcionado
            echo json_encode(array("error" => "No se encontraron detalles con el ID proporcionado."));
        }
    } else {
        // Error al ejecutar la consulta
        echo json_encode(array("error" => "Error al obtener los detalles ."));
    }

    // Cerrar la consulta preparada
    $stmt->close();
} else {
    // No se proporcionó el ID de la sede en la solicitud
    echo json_encode(array("error" => "No se proporcionó el ID ."));
}
