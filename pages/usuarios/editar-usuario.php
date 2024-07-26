<?php
header('Content-Type: application/json');
require_once('../../database/database.php');

// Verificar si se ha enviado el formulario para editar una aula
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUserEdit = $_POST['idUserEdit'];
    $nombresUserEdit = $_POST['nombresUserEdit'];
    $ApellidosUserEdit = $_POST['ApellidosUserEdit'];
    $ndocumentosUserEdit = $_POST['ndocumentosUserEdit'];
    $correoUserEdit = $_POST['correoUserEdit'];
    $celularUserEdit = $_POST['celularUserEdit'];
    $fnacimientoUserEdit = $_POST['fnacimientoUserEdit'];
    $direccionoUserEdit = $_POST['direccionoUserEdit'];
    $generoUserEdit = $_POST['generoUserEdit'];
    $fregistroUserEdit = $_POST['fregistroUserEdit'];
    $estadoUserEdit = $_POST['estadoUserEdit'];
    $rolUserEdit = $_POST['rolUserEdit'];
    $contrasena = encriptarContrasena($ndocumentosUserEdit);
   

    // Preparar la consulta SQL para actualizar la aula
    $stmt = $conexion->prepare("UPDATE Usuarios SET Codigo_Usuario=?,Contrasena_Usuario=?,Nombre_Usuario=?,Apellidos_Usuario=?,NroDocumento_Usuario=?,Correo_Usuario=?,Celular_Usuario=?,FechaNacimiento_Usuario=?,Direccion_Usuario=?,Genero_Usuario=?,FechaRegistro_Usuario=?,Estatus_Usuario=?,Id_Rol=? WHERE Id_Usuario= ?");
    $stmt->bind_param("ssssssssssssii", $ndocumentosUserEdit, $contrasena, $nombresUserEdit, $ApellidosUserEdit, $ndocumentosUserEdit, $correoUserEdit, $celularUserEdit, $fnacimientoUserEdit, $direccionoUserEdit, $generoUserEdit, $fregistroUserEdit, $estadoUserEdit, $rolUserEdit, $idUserEdit);

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

function encriptarContrasena($contrasena)
{
    $contrasenaEncriptada = openssl_encrypt($contrasena, 'AES-256-CBC', ENCRYPTION_KEY, OPENSSL_RAW_DATA, ENCRYPTION_IV);
    return base64_encode($contrasenaEncriptada);
}