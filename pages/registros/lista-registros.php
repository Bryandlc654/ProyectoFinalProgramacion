<?php
include '../../database/database.php';

session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Redirige a la página de inicio de sesión si no está autenticado
    header("Location: ../../index.php");
    exit();
}

$sql = "SELECT Registros.Id_Registro, Usuarios.Nombre_Usuario, Usuarios.Codigo_Usuario, Registros.Fecha_Registro, Registros.Hora_Registro, Registros.Accion_Registro, Registros.Tabla_Registro, Registros.IdDato_Registro
        FROM Registros
        JOIN Usuarios ON Registros.Id_Usuario = Usuarios.Id_Usuario";
$result = mysqli_query($conexion, $sql);

mysqli_close($conexion);
?>

<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5 class="card-title fw-semibold">Registros</h5>
                    <input type="date" id="fechaRegistro" class="form-control w-auto" onchange="filtrarPorFecha()">
                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">N°</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Nombre de Usuario</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Código de Usuario</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Fecha de Registro</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Hora de Registro</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Acción</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Tabla</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">ID Dato</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="listaReg">
                            <?php
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
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function filtrarPorFecha() {
    const fecha = document.getElementById('fechaRegistro').value;
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('listaReg').innerHTML = this.responseText;
        }
    };
    xhttp.open("POST", "../registros/filtrar_registros.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("fecha=" + fecha);
}
</script>
