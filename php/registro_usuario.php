<?php
require 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = $_POST['nombre'];
  $edad = $_POST['edad'];
  $correo = $_POST['correo'];
  $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

  $sql = "INSERT INTO usuarios (nombre, edad, correo, contrasena) VALUES (?, ?, ?, ?)";
  $stmt = $conexion->prepare($sql);
  try {
    $stmt->execute([$nombre, $edad, $correo, $contrasena]);
    header("Location: ../html/login.html?registro=exitoso");
  } catch (PDOException $e) {
    echo "Error al registrar: " . $e->getMessage();
  }
}
?>