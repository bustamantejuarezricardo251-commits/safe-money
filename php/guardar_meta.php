<?php
session_start();
require 'conexion.php';
header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
  echo json_encode(["error" => "No autenticado"]);
  exit();
}

$usuario_id = $_SESSION['usuario_id'];
$nombre     = $_POST['nombre_meta'] ?? null;
$descripcion= $_POST['descripcion_meta'] ?? null;
$categoria  = $_POST['categoria'] ?? null;
$cantidad   = $_POST['cantidad'] ?? null;
$inicio     = $_POST['fecha_inicio'] ?? null;
$fin        = $_POST['fecha_fin'] ?? null;

if (!$nombre || !$descripcion || !$categoria || !$cantidad || !$inicio || !$fin) {
  echo json_encode(["error" => "Datos incompletos"]);
  exit();
}

$sql = "INSERT INTO metas (usuario_id, nombre_meta, descripcion_meta, categoria, cantidad, cantidad_acumulada, fecha_inicio, fecha_fin)
        VALUES (?, ?, ?, ?, ?, 0, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->execute([$usuario_id, $nombre, $descripcion, $categoria, $cantidad, $inicio, $fin]);

echo json_encode(["estado" => "ok"]);
?>