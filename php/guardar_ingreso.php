<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {
  header("Location: ../html/login.html");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $usuario_id = $_SESSION['usuario_id'];
  $monto = $_POST['monto'];
  $categoria = $_POST['categoria'];
  $fecha = date("Y-m-d H:i:s");

  $sql = "INSERT INTO transacciones (usuario_id, tipo, categoria, monto, fecha) VALUES (?, 'ingreso', ?, ?, ?)";
  $stmt = $conexion->prepare($sql);
  try {
    $stmt->execute([$usuario_id, $categoria, $monto, $fecha]);
    header("Location: ../html/dashboard.html");
  } catch (PDOException $e) {
    echo "Error al guardar ingreso: " . $e->getMessage();
  }
}
?>