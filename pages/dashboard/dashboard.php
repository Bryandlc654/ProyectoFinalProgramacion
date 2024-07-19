<?php
session_start();


$usuario = $_SESSION['usuario'];
$nombreUsuario = $usuario['Nombre_Usuario'];
?>

<h3 class="font-weight-bold">Hola, <?php echo $nombreUsuario; ?></h3>
