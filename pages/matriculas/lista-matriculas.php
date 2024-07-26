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
$FotoUsuario = $usuario['Foto_Usuario'];


$sql = "SELECT 
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

$result = mysqli_query($conexion, $sql);


$sqlaulas = "
SELECT 
    Aulas.Id_Aula,
    Especialidades.Nombre_Especialidad,
    Aulas.Semestre_Especialidad,
    Aulas.Seccion_Especialidad,
    Aulas.Perido_Especialidad,
    Turnos.Nombre_Turno
FROM 
    Aulas
JOIN 
    Especialidades ON Aulas.Id_Especialidad = Especialidades.Id_Especialidad
JOIN 
    Turnos ON Aulas.Id_Turno = Turnos.Id_Turno
";
$resultaulas = mysqli_query($conexion, $sqlaulas);

$resultado_aulas = $conexion->query($sqlaulas);

$aulas = array();
if ($resultado_aulas->num_rows > 0) {
    while ($fila_aula = $resultado_aulas->fetch_assoc()) {
        $aulas[] = $fila_aula;
    }
}


?>

<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5 class="card-title fw-semibold">Matrículas</h5>
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalRegistermat"><i class="ti ti-plus me-2"></i>Agregar matrícula</a>

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
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Acciones</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="listamatriculas">
                            <?php
                            $contador = 1;
                            while ($fila = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td class='border-bottom-0'>" . $contador++ . "</td>";
                                echo "<td class='border-bottom-0'>" . $fila['Codigo_Matricula'] . "</td>";
                                echo "<td class='border-bottom-0'>" . $fila['Codigo_Usuario'] . "</td>";
                                echo "<td class='border-bottom-0'>" . $fila['Nombre_Usuario'] . "</td>";
                                echo "<td class='border-bottom-0'>" . $fila['Fecha_Matricula'] . "</td>";
                                echo "<td class='border-bottom-0'>";
                                echo "<button class='btn btn-primary ver-pdf' data-pdf='" . $fila['Ficha_Matricula'] . "' data-bs-toggle='modal' data-bs-target='#ModalVerPDF'><i class='ti ti-eye'></i> Ver Ficha</button>";
                                echo "</td>";
                                echo "<td class='border-bottom-0'>";
                                echo "<button class='btn btn-warning me-2 editar-matricula' data-id='" . $fila['Id_Matricula'] . "' data-bs-toggle='modal' data-bs-target='#ModalEditmat'><i class='ti ti-pencil'></i></button>";
                                echo "<button class='btn btn-danger me-2 eliminar-matricula' data-id='" . $fila['Id_Matricula'] . "' data-bs-toggle='modal' data-bs-target='#ModalDeleteMatricula'><i class='ti ti-minus'></i></button>";
                                echo  "</td>";
                                echo "</tr>";
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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

<?php
require './modals-matriculas.php';
?>