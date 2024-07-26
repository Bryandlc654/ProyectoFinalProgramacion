<?php
include '../../database/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = $_POST['query'];

    if (!empty($query)) {
        $sql = "SELECT * FROM Usuarios WHERE Codigo_Usuario LIKE ? AND Estatus_Usuario = 1";
        $stmt = $conexion->prepare($sql);
        $searchQuery = '%' . $query . '%';
        $stmt->bind_param("s", $searchQuery);
        $stmt->execute();
        $result = $stmt->get_result();

        $users = array();
        while ($row = $result->fetch_assoc()) {
            $row['rolUser'] = getRoleName($row['Id_Rol']); // Add this line to get role name
            $users[] = $row;
        }
        $stmt->close();
        echo json_encode($users);
    } else {
        $sql = "SELECT * FROM Usuarios WHERE Estatus_Usuario = 1";
        $result = mysqli_query($conexion, $sql);

        $users = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $row['rolUser'] = getRoleName($row['Id_Rol']); // Add this line to get role name
            $users[] = $row;
        }
        echo json_encode($users);
    }

    mysqli_close($conexion);
}

// Function to get role name based on role ID
function getRoleName($roleId) {
    switch ($roleId) {
        case 1:
            return 'Administrador';
        case 2:
            return 'Asistente';
        case 3:
            return 'Docente';
        case 4:
            return 'Estudiante';
        default:
            return 'Rol no asignado';
    }
}
