<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {
  echo json_encode(["error" => "No autenticado"]);
  exit();
}

$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT categoria, SUM(monto) AS total FROM transacciones WHERE usuario_id = ? AND tipo = 'gasto' GROUP BY categoria";
$stmt = $conexion->prepare($sql);
$stmt->execute([$usuario_id]);
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($resultados);
?>