<?php
include '../../database/database.php';

if (isset($_POST['query'])) {
    $query = $_POST['query'];

    $sql = "SELECT Codigo_Usuario, Nombre_Usuario, Apellidos_Usuario FROM Usuarios WHERE Id_Rol =3 and Codigo_Usuario LIKE ? LIMIT 10 ";
    $stmt = $conexion->prepare($sql);
    $likeQuery = "%{$query}%";
    $stmt->bind_param("s", $likeQuery);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<a href="#" class="list-group-item list-group-item-action suggestion-item" data-codigo="' . $row['Codigo_Usuario'] . '" data-nombre="' . $row['Nombre_Usuario'] . '" data-apellidos="' . $row['Apellidos_Usuario'] . '">' . $row['Codigo_Usuario'] . ' - ' . $row['Nombre_Usuario'] . ' ' . $row['Apellidos_Usuario'] . '</a>';
        }
    } else {
        echo '<a href="#" class="list-group-item list-group-item-action disabled">No hay resultados</a>';
    }

    $stmt->close();
    $conexion->close();
}
