<?php
session_start();
require 'conexion.php';
require '../fpdf/fpdf.php';

if (!isset($_SESSION['usuario_id'])) {
  die("No autenticado");
}

$usuario_id = $_SESSION['usuario_id'];
$mes_actual = date("m");
$anio_actual = date("Y");

$sql = "SELECT tipo, categoria, monto, fecha FROM transacciones WHERE usuario_id = ? AND MONTH(fecha) = ? AND YEAR(fecha) = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$usuario_id, $mes_actual, $anio_actual]);
$movimientos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Informe mensual - Safe Money', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(5);

foreach ($movimientos as $mov) {
  $pdf->Cell(0, 10, "{$mov['fecha']} - {$mov['tipo']} - {$mov['categoria']} - $ {$mov['monto']}", 0, 1);
}

$pdf->Output();
?>