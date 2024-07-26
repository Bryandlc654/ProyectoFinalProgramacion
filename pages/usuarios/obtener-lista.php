<?php
session_start();
include '../../database/database.php';

$sql = "SELECT * FROM Usuarios where Estatus_Usuario =1";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $contador = 1;
    while ($fila = mysqli_fetch_array($resultado)) {
        echo "<tr>";
        echo "<td class='border-bottom-0'>";
        echo "<button class='btn btn-warning me-2 editar-usuario' data-id='" . $fila[0] . "' data-bs-toggle='modal' data-bs-target='#ModalEditUser'><i class='ti ti-pencil'></i></button>";
        echo "<button class='btn btn-danger me-2 eliminar-usuario' data-id='" . $fila[0] . "' data-bs-toggle='modal' data-bs-target='#ModalDeleteUser'><i class='ti ti-minus'></i></button>";
        echo  "</td>";
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

        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No se encontraron datos.</td></tr>";
}
