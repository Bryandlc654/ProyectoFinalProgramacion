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
    $sql = "SELECT Registros.Id_Registro, Usuarios.Nombre_Usuario, Usuarios.Codigo_Usuario, Registros.Fecha_Registro, Registros.Hora_Registro, Registros.Accion_Registro, Registros.Tabla_Registro, Registros.IdDato_Registro
            FROM Registros
            JOIN Usuarios ON Registros.Id_Usuario = Usuarios.Id_Usuario
            WHERE Registros.Fecha_Registro = '$fecha'";
    $result = mysqli_query($conexion, $sql);

    $contador = 1;
    while ($fila = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td class='border-bottom-0'>" . $contador++ . "</td>";
        echo "<td class='border-bottom-0'>" . $fila['Nombre_Usuario'] . "</td>";
        echo "<td class='border-bottom-0'>" . $fila['Codigo_Usuario'] . "</td>";
        echo "<td class='border-bottom-0'>" . $fila['Fecha_Registro'] . "</td>";
        echo "<td class='border-bottom-0'>" . $fila['Hora_Registro'] . "</td>";
        echo "<td class='border-bottom-0'>" . $fila['Accion_Registro'] . "</td>";
        echo "<td class='border-bottom-0'>" . $fila['Tabla_Registro'] . "</td>";
        echo "<td class='border-bottom-0'>" . $fila['IdDato_Registro'] . "</td>";
        echo "</tr>";
    }

    mysqli_close($conexion);
}
?>
