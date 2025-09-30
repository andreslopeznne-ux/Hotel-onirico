<?php

include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre   = $_POST['nombre'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sss", $nombre, $email, $password);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Usuario registrado correctamente'); window.location='login.html';</script>";
    } else {
        echo "❌ Error al registrar: " . $stmt->error;
    }

    $stmt->close();
}

$conexion->close();
?>








