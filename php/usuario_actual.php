<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
  echo json_encode(["error" => "No autenticado"]);
  exit();
}

require 'conexion.php';

$sql = "SELECT nombre FROM usuarios WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$_SESSION['usuario_id']]);
$nombre = $stmt->fetchColumn();

echo json_encode(["nombre" => $nombre]);
?>