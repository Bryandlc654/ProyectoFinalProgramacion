<?php
session_start();
include '../../database/database.php';

$sql = "SELECT * FROM Usuarios where Estatus_Usuario =0";
$resultado = $conexion->query($sql);
while ($fila = mysqli_fetch_array($resultado)) {
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
    echo "<button title='Habilitar usuario' class='btn btn-success me-2 habilitar-usuario' data-id='" . $fila[0] . "' data-bs-toggle='modal' data-bs-target='#ModalActivateUser'><i class='ti ti-check'></i></button>";
    echo  "</td>";
    echo "</tr>";
}
