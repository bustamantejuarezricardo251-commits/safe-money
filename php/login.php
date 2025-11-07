<?php
session_start();
require 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $correo = $_POST['correo'];
  $contrasena = $_POST['contrasena'];

  $sql = "SELECT * FROM usuarios WHERE correo = ?";
  $stmt = $conexion->prepare($sql);
  $stmt->execute([$correo]);
  $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['nombre'] = $usuario['nombre'];
    header("Location: ../html/dashboard.html");
  } else {
    echo "Correo o contraseña incorrectos.";
  }
}
?>