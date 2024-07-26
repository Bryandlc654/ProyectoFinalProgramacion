<?php
header('Content-Type: application/json');
require_once('../../database/database.php'); // Ajusta la ruta si es necesario

// Configurar la zona horaria a la de Perú
date_default_timezone_set('America/Lima');

$response = array('status' => '', 'message' => '');

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombres = $_POST['nombresUser'];
        $idUsuario = $_POST['idUser'];
        $apellidos = $_POST['apellidosUser'];
        $ndocumento = $_POST['ndocumentosUser'];
        $correo = $_POST['correoUser'];
        $celular = $_POST['celularUser'];
        $fnacimiento = $_POST['fnacimientoUser'];
        $direccion = $_POST['direccionoUser'];
        $genero = $_POST['generoUser'];
        $fregistro = $_POST['fregistroUser'];
        $estado = $_POST['estadoUser'];
        $rol = $_POST['rolUser'];

        $codigoUsuario = $ndocumento;
        $contrasena = encriptarContrasena($ndocumento);

        if ($conexion) {
            // Verificar si el número de documento ya existe
            $stmtCheck = $conexion->prepare("SELECT COUNT(*) FROM Usuarios WHERE NroDocumento_Usuario = ?");
            $stmtCheck->bind_param('s', $ndocumento);
            $stmtCheck->execute();
            $stmtCheck->bind_result($count);
            $stmtCheck->fetch();
            $stmtCheck->close();

            if ($count > 0) {
                $response['status'] = 'error';
                $response['message'] = 'El número de documento ya está registrado.';
            } else {
                $stmt = $conexion->prepare("INSERT INTO Usuarios (Codigo_Usuario, Contrasena_Usuario, Nombre_Usuario, Apellidos_Usuario, NroDocumento_Usuario, Correo_Usuario, Celular_Usuario, FechaNacimiento_Usuario, Direccion_Usuario, Genero_Usuario, FechaRegistro_Usuario, Estatus_Usuario, Id_Rol) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param('ssssssssssssi', $codigoUsuario, $contrasena, $nombres, $apellidos, $ndocumento, $correo, $celular, $fnacimiento, $direccion, $genero, $fregistro, $estado, $rol);

                if ($stmt->execute()) {
                    $fechaRegistro = date('Y-m-d');
                    $horaRegistro = date('H:i:s');
                    $accion = 'Crear';
                    $tabla = 'Usuarios';

                    $stmtRegistro = $conexion->prepare("INSERT INTO Registros (Id_Usuario, Fecha_Registro, Hora_Registro, Accion_Registro, Tabla_Registro, IdDato_Registro) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmtRegistro->bind_param('issssi', $idUsuario, $fechaRegistro, $horaRegistro, $accion, $tabla, $ndocumento);
                    $stmtRegistro->execute();
                    $stmtRegistro->close();

                    $response['status'] = 'success';
                    $response['message'] = 'Usuario registrado correctamente';
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Error al registrar el usuario';
                }
                $stmt->close();
            }
            $conexion->close();
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error de conexión a la base de datos';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Método de solicitud no permitido';
    }
} catch (Exception $e) {
    $response['status'] = 'error';
    $response['message'] = 'Excepción: ' . $e->getMessage();
}

echo json_encode($response);
exit();

function encriptarContrasena($contrasena)
{
    $contrasenaEncriptada = openssl_encrypt($contrasena, 'AES-256-CBC', ENCRYPTION_KEY, OPENSSL_RAW_DATA, ENCRYPTION_IV);
    return base64_encode($contrasenaEncriptada);
}
?>
