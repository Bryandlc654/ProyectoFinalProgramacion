<?php
session_start();
include '../../database/database.php';

$usuario = $_SESSION['usuario'];
$nombreUsuario = $usuario['Nombre_Usuario'];
$rolUsuario = $usuario['Id_Rol'];

switch ($rolUsuario) {
    case 1:
        $rolUser = 'Administrador';
        break;
    case 2:
        $rolUser = 'Asistente';
        break;
    case 3:
        $rolUser = 'Docente';
        break;
    case 4:
        $rolUser = 'Estudiante';
        break;
    default:
        $rolUser = 'Rol no asignado';
        break;
}

require './contadores.php'
?>

<h3 class="font-weight-bold">Hola, <?php echo $nombreUsuario; ?></h3>
<span><?php echo $rolUser; ?></span>
<br>
<br>
<br>

<div class="row gap-3">
    <div class="col card overflow-hidden">
        <div class="card-body p-4">
            <h5 class="card-title mb-9 fw-semibold">Usuarios Registrados</h5>
            <div class="row align-items-center">
                <div class="col-8">
                    <h4 class="fw-semibold mb-3"><?php echo "$totalUsuarios"; ?></h4>
                </div>
                <div class="col-4">
                    <div class="d-flex justify-content-center">
                        <div id="breakup"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col card overflow-hidden">
        <div class="card-body p-4">
            <h5 class="card-title mb-9 fw-semibold">Usuarios Deshabilitados</h5>
            <div class="row align-items-center">
                <div class="col-8">
                    <h4 class="fw-semibold mb-3"><?php echo "$totalUsuariosDeshabilitados"; ?></h4>
                </div>
                <div class="col-4">
                    <div class="d-flex justify-content-center">
                        <div id="breakup"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col card overflow-hidden">
        <div class="card-body p-4">
            <h5 class="card-title mb-9 fw-semibold">Administradores</h5>
            <div class="row align-items-center">
                <div class="col-8">
                    <h4 class="fw-semibold mb-3"><?php echo "$totalUsuariosAdmin"; ?></h4>
                </div>
                <div class="col-4">
                    <div class="d-flex justify-content-center">
                        <div id="breakup"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row gap-3">
    <div class="col card overflow-hidden">
        <div class="card-body p-4">
            <h5 class="card-title mb-9 fw-semibold">Asistentes</h5>
            <div class="row align-items-center">
                <div class="col-8">
                    <h4 class="fw-semibold mb-3"><?php echo "$totalUsuariosAsist"; ?></h4>
                </div>
                <div class="col-4">
                    <div class="d-flex justify-content-center">
                        <div id="breakup"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col card overflow-hidden">
        <div class="card-body p-4">
            <h5 class="card-title mb-9 fw-semibold">Docentes</h5>
            <div class="row align-items-center">
                <div class="col-8">
                    <h4 class="fw-semibold mb-3"><?php echo "$totalUsuariosDoc"; ?></h4>
                </div>
                <div class="col-4">
                    <div class="d-flex justify-content-center">
                        <div id="breakup"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col card overflow-hidden">
        <div class="card-body p-4">
            <h5 class="card-title mb-9 fw-semibold">Estudiantes</h5>
            <div class="row align-items-center">
                <div class="col-8">
                    <h4 class="fw-semibold mb-3"><?php echo "$totalUsuariosEst"; ?></h4>
                </div>
                <div class="col-4">
                    <div class="d-flex justify-content-center">
                        <div id="breakup"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>