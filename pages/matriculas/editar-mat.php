<?php
header('Content-Type: application/json; charset=utf-8');
require_once('../../database/database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idMatricula = $_POST['idMatriculaEdit'];
    $fechaMatricula = $_POST['fechaMatriculaEdit'];
    $idAula = $_POST['especialidadAulaEdit'];
    $idUsuario = $_POST['idMatriculaEditUser'];

    // Obtener el código de matrícula basado en el ID de matrícula
    $stmt = $conexion->prepare("SELECT Codigo_Matricula FROM Matriculas WHERE Id_Matricula = ?");
    $stmt->bind_param("i", $idMatricula);
    $stmt->execute();
    $result = $stmt->get_result();
    $matricula = $result->fetch_assoc();
    $codigoMatricula = $matricula['Codigo_Matricula'];
    $stmt->close();

    // Obtener información del usuario
    $stmt = $conexion->prepare("SELECT * FROM Usuarios WHERE Id_Usuario = ?");
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();
    $stmt->close();

    // Obtener información del aula
    $stmt = $conexion->prepare("SELECT A.*, E.Nombre_Especialidad, T.Nombre_Turno, T.Horario_Turno 
                                FROM Aulas A
                                JOIN Especialidades E ON A.Id_Especialidad = E.Id_Especialidad
                                JOIN Turnos T ON A.Id_Turno = T.Id_Turno
                                WHERE A.Id_Aula = ?");
    $stmt->bind_param("i", $idAula);
    $stmt->execute();
    $result = $stmt->get_result();
    $aula = $result->fetch_assoc();
    $stmt->close();

    // Generar el nuevo PDF
    require('../../fpdf/fpdf.php');

    class PDF extends FPDF
    {
        // Cabecera de página
        function Header()
        {
            $this->Image('../../assets/logo_ts_negro.png', 10, 8, 33);
            $this->SetFont('Arial', 'B', 15);
            $this->Cell(80);
            $this->Cell(30, 10, mb_convert_encoding('Ficha de Matricula', 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');
            $this->Ln(20);
        }

        // Pie de página
        function Footer()
        {
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, mb_convert_encoding('Page ' . $this->PageNo() . '/{nb}', 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');
        }
    }

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);

    // Información del estudiante y matrícula en tabla
    $pdf->Cell(0, 10, '', 0, 1); // Espaciado
    $pdf->Cell(0, 10, '', 0, 1); // Espaciado
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(60, 10, mb_convert_encoding('Código de Matrícula:', 'ISO-8859-1', 'UTF-8'), 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, mb_convert_encoding($codigoMatricula, 'ISO-8859-1', 'UTF-8'), 1, 1);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(60, 10, mb_convert_encoding('Fecha de Matrícula:', 'ISO-8859-1', 'UTF-8'), 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, mb_convert_encoding($fechaMatricula, 'ISO-8859-1', 'UTF-8'), 1, 1);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(60, 10, mb_convert_encoding('Nombre del Estudiante:', 'ISO-8859-1', 'UTF-8'), 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, mb_convert_encoding($usuario['Nombre_Usuario'] . ' ' . $usuario['Apellidos_Usuario'], 'ISO-8859-1', 'UTF-8'), 1, 1);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(60, 10, mb_convert_encoding('Especialidad:', 'ISO-8859-1', 'UTF-8'), 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, mb_convert_encoding($aula['Nombre_Especialidad'], 'ISO-8859-1', 'UTF-8'), 1, 1);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(60, 10, mb_convert_encoding('Turno:', 'ISO-8859-1', 'UTF-8'), 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, mb_convert_encoding($aula['Nombre_Turno'] . ' (' . $aula['Horario_Turno'] . ')', 'ISO-8859-1', 'UTF-8'), 1, 1);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(60, 10, mb_convert_encoding('Semestre:', 'ISO-8859-1', 'UTF-8'), 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, mb_convert_encoding($aula['Semestre_Especialidad'], 'ISO-8859-1', 'UTF-8'), 1, 1);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(60, 10, mb_convert_encoding('Sección:', 'ISO-8859-1', 'UTF-8'), 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, mb_convert_encoding($aula['Seccion_Especialidad'], 'ISO-8859-1', 'UTF-8'), 1, 1);

    // Información adicional del estudiante
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(60, 10, mb_convert_encoding('Documento:', 'ISO-8859-1', 'UTF-8'), 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, mb_convert_encoding($usuario['NroDocumento_Usuario'], 'ISO-8859-1', 'UTF-8'), 1, 1);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(60, 10, mb_convert_encoding('Correo:', 'ISO-8859-1', 'UTF-8'), 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, mb_convert_encoding($usuario['Correo_Usuario'], 'ISO-8859-1', 'UTF-8'), 1, 1);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(60, 10, mb_convert_encoding('Celular:', 'ISO-8859-1', 'UTF-8'), 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, mb_convert_encoding($usuario['Celular_Usuario'], 'ISO-8859-1', 'UTF-8'), 1, 1);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(60, 10, mb_convert_encoding('Fecha de Nacimiento:', 'ISO-8859-1', 'UTF-8'), 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, mb_convert_encoding($usuario['FechaNacimiento_Usuario'], 'ISO-8859-1', 'UTF-8'), 1, 1);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(60, 10, mb_convert_encoding('Dirección:', 'ISO-8859-1', 'UTF-8'), 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, mb_convert_encoding($usuario['Direccion_Usuario'], 'ISO-8859-1', 'UTF-8'), 1, 1);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(60, 10, mb_convert_encoding('Género:', 'ISO-8859-1', 'UTF-8'), 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, mb_convert_encoding($usuario['Genero_Usuario'], 'ISO-8859-1', 'UTF-8'), 1, 1);

    $pdf->Output('F', '../../Fichas/' . $codigoMatricula . '.pdf');

    $fichaMatricula = '../../Fichas/' . $codigoMatricula . '.pdf';

    // Actualizar la base de datos
    $stmt = $conexion->prepare("UPDATE Matriculas SET Fecha_Matricula = ?, Id_Aula = ?, Ficha_Matricula = ? WHERE Id_Matricula = ?");
    $stmt->bind_param("sisi", $fechaMatricula, $idAula, $fichaMatricula, $idMatricula);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Matrícula actualizada correctamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al actualizar la matrícula.']);
    }

    $stmt->close();
}
