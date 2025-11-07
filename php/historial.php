<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {
  echo json_encode(["error" => "No autenticado"]);
  exit();
}

$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT fecha, tipo, categoria, monto FROM transacciones WHERE usuario_id = ? ORDER BY fecha DESC";
$stmt = $conexion->prepare($sql);
$stmt->execute([$usuario_id]);
$movimientos = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($movimientos);
?>