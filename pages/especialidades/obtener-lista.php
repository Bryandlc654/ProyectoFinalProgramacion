<?php
session_start();
include '../../database/database.php';

$sql = "SELECT * FROM Especialidades";
$resultado = $conexion->query($sql);


$contador = 1;
while ($fila = mysqli_fetch_array($resultado)) {

    echo "<tr>";
    echo "<td class='border-bottom-0'>" . $contador++ . "</td>";
    echo "<td class='border-bottom-0'>" . $fila[1] . "</td>";
    echo "<td class='border-bottom-0'>";
    echo "<button class='btn btn-warning me-2 editar-esp' data-id='".$fila[0]."' data-bs-toggle='modal' data-bs-target='#ModalEditEsp'><i class='ti ti-pencil'></i></button>";
    echo "<button class='btn btn-danger me-2 eliminar-esp' data-bs-toggle='modal' data-id='" . $fila[0] . "' data-bs-target='#ModalDeleteEsp'><i class='ti ti-minus'></i></button>";
    echo  "</td>";
    echo "</tr>";
} ?>