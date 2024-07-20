<?php
$totalUsuarios = 0;
if ($conexion) {
    $consultaTotalUsuarios = $conexion->query("SELECT COUNT(*) AS total FROM Usuarios ");
    if ($consultaTotalUsuarios) {
        $resultadoTotalUsuarios = $consultaTotalUsuarios->fetch_assoc();
        $totalUsuarios = $resultadoTotalUsuarios['total'];
    }
}

$totalUsuariosDeshabilitados = 0;
if ($conexion) {
    $consultaTotalUsuariosDeshabilitados = $conexion->query("SELECT COUNT(*) AS total FROM Usuarios where Estatus_Usuario =0 ");
    if ($consultaTotalUsuariosDeshabilitados) {
        $resultadoTotalUsuariosDeshabilitados = $consultaTotalUsuariosDeshabilitados->fetch_assoc();
        $totalUsuariosDeshabilitados = $resultadoTotalUsuariosDeshabilitados['total'];
    }
}

$totalUsuariosAdmin = 0;
if ($conexion) {
    $consultaTotalUsuariosAdmin = $conexion->query("SELECT COUNT(*) AS total FROM Usuarios where Id_Rol =1 and Estatus_Usuario =1");
    if ($consultaTotalUsuariosAdmin) {
        $resultadoTotalUsuariosAdmin = $consultaTotalUsuariosAdmin->fetch_assoc();
        $totalUsuariosAdmin = $resultadoTotalUsuariosAdmin['total'];
    }
}

$totalUsuariosAsist = 0;
if ($conexion) {
    $consultaTotalUsuariosAsist = $conexion->query("SELECT COUNT(*) AS total FROM Usuarios where Id_Rol =2 and Estatus_Usuario =1");
    if ($consultaTotalUsuariosAsist) {
        $resultadoTotalUsuariosAsist = $consultaTotalUsuariosAsist->fetch_assoc();
        $totalUsuariosAsist = $resultadoTotalUsuariosAsist['total'];
    }
}

$totalUsuariosDoc = 0;
if ($conexion) {
    $consultaTotalUsuariosDoc = $conexion->query("SELECT COUNT(*) AS total FROM Usuarios where Id_Rol =3 and Estatus_Usuario =1");
    if ($consultaTotalUsuariosDoc) {
        $resultadoTotalUsuariosDoc = $consultaTotalUsuariosDoc->fetch_assoc();
        $totalUsuariosDoc = $resultadoTotalUsuariosDoc['total'];
    }
}

$totalUsuariosEst = 0;
if ($conexion) {
    $consultaTotalUsuariosEst = $conexion->query("SELECT COUNT(*) AS total FROM Usuarios where Id_Rol =4 and Estatus_Usuario =1");
    if ($consultaTotalUsuariosEst) {
        $resultadoTotalUsuariosEst  = $consultaTotalUsuariosEst->fetch_assoc();
        $totalUsuariosEst = $resultadoTotalUsuariosEst['total'];
    }
}
