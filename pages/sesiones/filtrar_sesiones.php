<?php
include '../../database/database.php';

session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Redirige a la página de inicio de sesión si no está autenticado
    header("Location: ../../index.php");
    exit();
}

if (isset($_POST['fecha'])) {
    $fecha = $_POST['fecha'];
    $sql = "SELECT Sesiones.Id_Sesion, Usuarios.Nombre_Usuario, Usuarios.Codigo_Usuario, Sesiones.Fecha_Sesion, Sesiones.Hora_Sesion
            FROM Sesiones
            JOIN Usuarios ON Sesiones.Id_Usuario = Usuarios.Id_Usuario
            WHERE Sesiones.Fecha_Sesion = '$fecha'";
    $result = mysqli_query($conexion, $sql);

    $contador = 1;
    while ($fila = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td class='border-bottom-0'>" . $contador++ . "</td>";
        echo "<td class='border-bottom-0'>" . $fila['Nombre_Usuario'] . "</td>";
        echo "<td class='border-bottom-0'>" . $fila['Codigo_Usuario'] . "</td>";
        echo "<td class='border-bottom-0'>" . $fila['Fecha_Sesion'] . "</td>";
        echo "<td class='border-bottom-0'>" . $fila['Hora_Sesion'] . "</td>";
        echo "</tr>";
    }

    mysqli_close($conexion);
}
?>
