<?php
require_once(__DIR__ . '/database/database.php');

session_start();

$response = array('status' => '', 'message' => '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
    $contrasena = isset($_POST['contrasena']) ? trim($_POST['contrasena']) : '';

    if ($conexion) {
        // Consulta la tabla Usuarios para obtener la contraseña encriptada
        $stmt = $conexion->prepare("SELECT * FROM Usuarios WHERE Codigo_Usuario = ?");
        $stmt->bind_param('s', $usuario);
        $stmt->execute();
        $consultaUsuario = $stmt->get_result();

        if ($consultaUsuario->num_rows > 0) {
            $usuarioData = $consultaUsuario->fetch_assoc();
            $contrasenaEncriptada = $usuarioData['Contrasena_Usuario'];

            // Encriptar la contraseña ingresada por el usuario para compararla
            $contrasenaIngresadaEncriptada = encriptarContrasena($contrasena);

            // Verifica la contraseña encriptada
            if ($contrasenaIngresadaEncriptada === $contrasenaEncriptada) {
                $_SESSION['usuario'] = $usuarioData;
                $response['status'] = 'success';
                $response['message'] = 'Acceso permitido';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Contraseña incorrecta';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Usuario no encontrado';
        }
        $stmt->close();
        $conexion->close();
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error de conexión a la base de datos';
    }
    echo json_encode($response);
    exit();
}

function encriptarContrasena($contrasena)
{
    $contrasenaEncriptada = openssl_encrypt($contrasena, 'AES-256-CBC', ENCRYPTION_KEY, OPENSSL_RAW_DATA, ENCRYPTION_IV);
    return base64_encode($contrasenaEncriptada);
}

include './components/head.php'

?>

<div class="container">
    <div class="left">
        <div class="header">
            <img src="./assets/logo_ts_negro.png" class="animation a1 logo" alt="Logo">
            <br>
            <h2 class="animation a1">Iniciar Sesión</h2>
        </div>
        <div>
            <form id="loginForm" method="post" class="form">
                <input type="text" class="form-field animation a3" placeholder="Usuario" required name="usuario">
                <div class="form-field animation a4">
                    <input type="password" id="contrasena" placeholder="Contraseña" required name="contrasena" class="input__password">
                    <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                </div>
                <button class="animation a6" type="submit" id="liveToastBtn">Ingresar</button>
            </form>
            <span class="text__alert"></span>
        </div>
    </div>
    <div class="right"></div>
</div>

<?php include './components/scripts-js.php' ?>
<script>
    $(document).ready(function() {
        $('#loginForm').submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: 'index.php',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        setTimeout(function() {
                            window.location.href = './pages/dashboard/sidebard.php';
                        }, 3000); // Redirige después de 3 segundos (3000 milisegundos)
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function() {
                    toastr.error('Error en el servidor. Intente nuevamente.');
                }
            });
        });
        $('#togglePassword').on('click', function() {
            const passwordField = $('#contrasena');
            const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
            passwordField.attr('type', type);
            $(this).toggleClass('fa-eye fa-eye-slash');
        });
    });
</script>
<?php include './components/end-head.php' ?>
