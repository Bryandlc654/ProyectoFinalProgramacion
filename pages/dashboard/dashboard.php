<?php
include '../../database/database.php';

session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Redirige a la página de inicio de sesión si no está autenticado
    header("Location: ../../index.php");
    exit();
}



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


$sqlmat = "SELECT 
            m.Id_Matricula,
            m.Codigo_Matricula,
            u.Codigo_Usuario,
            CONCAT(u.Nombre_Usuario, ' ', u.Apellidos_Usuario) AS Nombre_Usuario,
            m.Fecha_Matricula,
            m.Ficha_Matricula
        FROM Matriculas m
        JOIN Usuarios u ON m.Id_Usuario = u.Id_Usuario
        JOIN Aulas a ON m.Id_Aula = a.Id_Aula
        JOIN Especialidades e ON a.Id_Especialidad = e.Id_Especialidad";

$resultmat = mysqli_query($conexion, $sqlmat);

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
<div class="table-responsive">
    <table class="table text-nowrap mb-0 align-middle">
        <thead class="text-dark fs-4">
            <tr>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">N°</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Código matrícula</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Codigo usuario</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Nombre usuario</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Fecha</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Ficha</h6>
                </th>
                
            </tr>
        </thead>
        <tbody id="listamatriculas">
            <?php
            $contador = 1;
            while ($fila = mysqli_fetch_array($resultmat)) {
                echo "<tr>";
                echo "<td class='border-bottom-0'>" . $contador++ . "</td>";
                echo "<td class='border-bottom-0'>" . $fila['Codigo_Matricula'] . "</td>";
                echo "<td class='border-bottom-0'>" . $fila['Codigo_Usuario'] . "</td>";
                echo "<td class='border-bottom-0'>" . $fila['Nombre_Usuario'] . "</td>";
                echo "<td class='border-bottom-0'>" . $fila['Fecha_Matricula'] . "</td>";
                echo "<td class='border-bottom-0'>";
                echo "<button class='btn btn-primary ver-pdf' data-pdf='" . $fila['Ficha_Matricula'] . "' data-bs-toggle='modal' data-bs-target='#ModalVerPDF'><i class='ti ti-eye'></i> Ver Ficha</button>";
                echo "</td>";
                echo "</tr>";
            } ?>
        </tbody>
    </table>
</div>
<!-- Modal para ver el PDF -->
<div class="modal fade" id="ModalVerPDF" tabindex="-1" aria-labelledby="ModalVerPDFLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalVerPDFLabel">Ficha de Matrícula</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="pdfViewer" src="" frameborder="0" style="width: 100%; height: 600px;"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(document).on('click', '.ver-pdf', function() {
            var pdfUrl = $(this).data('pdf');
            $('#pdfViewer').attr('src', pdfUrl);
        });
    });
</script>