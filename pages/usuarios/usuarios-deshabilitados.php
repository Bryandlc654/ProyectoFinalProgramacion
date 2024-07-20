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


$sql = "SELECT * FROM Usuarios where Estatus_Usuario =0";
$result = mysqli_query($conexion, $sql);

$sqlRoles = "SELECT * FROM Roles";
$resultRoles = mysqli_query($conexion, $sqlRoles);
mysqli_close($conexion);

?>

<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5 class="card-title fw-semibold">Usuarios</h5>
                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Código</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Nombres</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Apellidos</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">DNI</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Rol</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Acciones</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($fila = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td class='border-bottom-0'>" . $fila[1] . "</td>";
                                echo "<td class='border-bottom-0'>" . $fila[3] . "</td>";
                                echo "<td class='border-bottom-0'>" . $fila[4] . "</td>";
                                echo "<td class='border-bottom-0'>" . $fila[5] . "</td>";
                                switch ($fila[14]) {
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
                                echo "<td class='border-bottom-0'>" . $rolUser . "</td>";
                                echo "<td class='border-bottom-0'>";
                                echo "<a href='#' class='btn btn-primary me-2' data-bs-toggle='modal' data-bs-target='#ModalViewUser'><i class='ti ti-eye'></i></a>";
                                echo "<a href='#' class='btn btn-warning me-2' data-bs-toggle='modal' data-bs-target='#ModalEditUser'><i class='ti ti-pencil'></i></a>";
                                echo "<a href='#' class='btn btn-success me-2' data-bs-toggle='modal' data-bs-target='#ModalActivateUser'><i class='ti ti-minus'></i></a>";
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
require './modals-usuarios.php';
?>