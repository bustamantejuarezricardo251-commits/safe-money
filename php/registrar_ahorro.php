<?php
session_start();
require 'conexion.php';

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];
$cantidad = $data['cantidad'];
$usuario_id = $_SESSION['usuario_id'];
$fecha = date("Y-m-d H:i:s");

$categoria = "meta_" . $id;

$sql = "INSERT INTO transacciones (usuario_id, tipo, categoria, monto, fecha) VALUES (?, 'gasto', ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->execute([$usuario_id, $categoria, $cantidad, $fecha]);

echo json_encode(["estado" => "ok"]);
?>