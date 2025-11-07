<?php
session_start();
require 'conexion.php';
header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
  echo json_encode(["error" => "No autenticado"]);
  exit();
}

$usuario_id = $_SESSION['usuario_id'];
$mensaje = $_POST['mensaje'] ?? '';
$fecha = $_POST['fecha'] ?? '';

if (!$mensaje || !$fecha) {
  echo json_encode(["error" => "Datos incompletos"]);
  exit();
}

$sql = "INSERT INTO alertas (usuario_id, mensaje, fecha) VALUES (?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->execute([$usuario_id, $mensaje, $fecha]);

echo json_encode(["estado" => "ok"]);
?>