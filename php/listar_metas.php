<?php
session_start();
require 'conexion.php';
header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
  echo json_encode([]);
  exit();
}

$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT id, nombre_meta, descripcion_meta, categoria, cantidad, cantidad_acumulada FROM metas WHERE usuario_id = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$usuario_id]);
$metas = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($metas);
?>