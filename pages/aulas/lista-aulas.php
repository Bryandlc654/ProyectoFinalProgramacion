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

$sql = "
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
$result = mysqli_query($conexion, $sql);

$sqlEsp = "SELECT * FROM Especialidades";
$resultEsp = mysqli_query($conexion, $sqlEsp);
$resultado_Esp = $conexion->query($sqlEsp);


$esps = array();
if ($resultado_Esp->num_rows > 0) {
    while ($fila_Esp = $resultado_Esp->fetch_assoc()) {
        $esps[] = $fila_Esp;
    }
}

$sqlturn = "SELECT * FROM Turnos";
$resultturn = mysqli_query($conexion, $sqlturn);
$resultado_turn = $conexion->query($sqlturn);


$turns = array();
if ($resultado_turn->num_rows > 0) {
    while ($fila_turn = $resultado_turn->fetch_assoc()) {
        $turns[] = $fila_turn;
    }
}

?>

<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5 class="card-title fw-semibold">Aulas</h5>
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalRegisterAula"><i class="ti ti-plus me-2"></i>Agregar aula</a>

                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">N°</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Especialidad</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Semestre</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Seccion</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Periodo</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Turno</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Acciones</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="listaAulas">
                            <?php
                            $contador = 1;
                            while ($fila = mysqli_fetch_array($result)) {

                                echo "<tr>";
                                echo "<td class='border-bottom-0'>" . $contador++ . "</td>";
                                echo "<td class='border-bottom-0'>" . $fila[1] . "</td>";
                                echo "<td class='border-bottom-0'>" . $fila[2] . "</td>";
                                echo "<td class='border-bottom-0'>" . $fila[3] . "</td>";
                                echo "<td class='border-bottom-0'>" . $fila[4] . "</td>";
                                echo "<td class='border-bottom-0'>" . $fila[5] . "</td>";
                                echo "<td class='border-bottom-0'>";
                                echo "<button class='btn btn-warning me-2 editar-aula' data-id='" . $fila[0] . "' data-bs-toggle='modal' data-bs-target='#ModalEditAula'><i class='ti ti-pencil'></i></button>";
                                echo "<button class='btn btn-danger me-2 eliminar-aula' data-id='" . $fila[0] . "' data-bs-toggle='modal' data-bs-target='#ModalDeleteAula'><i class='ti ti-minus'></i></button>";
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

<?php
require './modals-aulas.php';
?>