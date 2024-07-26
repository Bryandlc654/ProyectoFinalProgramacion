<?php
session_start();
include '../../database/database.php';

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
}
