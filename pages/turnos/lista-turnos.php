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


$sql = "SELECT * FROM Turnos";
$result = mysqli_query($conexion, $sql);

mysqli_close($conexion);

?>

<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5 class="card-title fw-semibold">Turnos</h5>
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalRegisterTurn"><i class="ti ti-plus me-2"></i>Agregar tuno</a>

                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">N°</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Nombre Turno</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Horaio del Turno</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Acciones</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="listaTurnos">
                            <?php
                            $contador = 1;
                            while ($fila = mysqli_fetch_array($result)) {

                                echo "<tr>";
                                echo "<td class='border-bottom-0'>" . $contador++ . "</td>";
                                echo "<td class='border-bottom-0'>" . $fila[1] . "</td>";
                                echo "<td class='border-bottom-0'>" . $fila[2] . "</td>";
                                echo "<td class='border-bottom-0'>";
                                echo "<button class='btn btn-warning me-2 editar-turno' data-id='" . $fila[0] . "' data-bs-toggle='modal' data-bs-target='#ModalEditEsp'><i class='ti ti-pencil'></i></button>";
                                echo "<button class='btn btn-danger me-2 eliminar-turno' data-id='" . $fila[0] . "' data-bs-toggle='modal' data-bs-target='#ModalDeleteEsp'><i class='ti ti-minus'></i></button>";
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
require './modals-turnos.php';
?>