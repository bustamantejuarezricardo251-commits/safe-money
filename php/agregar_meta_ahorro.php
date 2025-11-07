<?php
session_start();
require 'conexion.php';
header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
  echo json_encode(["error" => "No autenticado"]);
  exit();
}

$usuario_id = $_SESSION['usuario_id'];
$meta_id = $_POST['meta_id'] ?? '';
$monto = $_POST['monto'] ?? '';

if (!$meta_id || !$monto || $monto <= 0) {
  echo json_encode(["error" => "Datos inválidos"]);
  exit();
}

// Actualizar acumulado
$sql = "UPDATE metas SET cantidad_acumulada = cantidad_acumulada + ? WHERE id = ? AND usuario_id = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$monto, $meta_id, $usuario_id]);

// Registrar gasto con categoría ahorro
$sqlGasto = "INSERT INTO gastos (usuario_id, descripcion, monto, categoria, fecha) VALUES (?, ?, ?, ?, NOW())";
$stmtGasto = $conexion->prepare($sqlGasto);
$stmtGasto->execute([$usuario_id, "Ahorro para meta ID $meta_id", $monto, "ahorro"]);

echo json_encode(["estado" => "ok"]);
?>