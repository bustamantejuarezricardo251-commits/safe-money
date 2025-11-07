<?php
session_start();
require 'conexion.php';
header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
  echo json_encode(["error" => "No autenticado"]);
  exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Calcular lunes y domingo de la semana actual
$lunes = new DateTime();
$lunes->setISODate((int)date('o'), (int)date('W'), 1);
$domingo = clone $lunes;
$domingo->modify('+6 days');

$inicio = $lunes->format('Y-m-d');
$fin = $domingo->format('Y-m-d');

// Total ingresos
$sqlIngresos = "SELECT SUM(monto) FROM transacciones WHERE usuario_id = ? AND tipo = 'ingreso' AND fecha BETWEEN ? AND ?";
$stmt1 = $conexion->prepare($sqlIngresos);
$stmt1->execute([$usuario_id, $inicio, $fin]);
$ingresos = $stmt1->fetchColumn() ?: 0;

// Total gastos
$sqlGastos = "SELECT SUM(monto) FROM transacciones WHERE usuario_id = ? AND tipo = 'gasto' AND fecha BETWEEN ? AND ?";
$stmt2 = $conexion->prepare($sqlGastos);
$stmt2->execute([$usuario_id, $inicio, $fin]);
$gastos = $stmt2->fetchColumn() ?: 0;

// Balance (ahorro)
$balance = $ingresos - $gastos;

echo json_encode([
  "ingresos" => number_format($ingresos, 2),
  "gastos" => number_format($gastos, 2),
  "balance" => number_format($balance, 2)
]);
?>