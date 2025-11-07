<?php
session_start();
require 'conexion.php';
header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
  echo json_encode([]);
  exit();
}

$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT mensaje, fecha FROM alertas WHERE usuario_id = ? ORDER BY fecha ASC";
$stmt = $conexion->prepare($sql);
$stmt->execute([$usuario_id]);
$alertas = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($alertas);
?>