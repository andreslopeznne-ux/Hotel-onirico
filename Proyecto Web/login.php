<?php
session_start();


$conn = new mysqli("localhost", "root", "", "hotel_paraiso");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['accion'])) {
    $accion = $_POST['accion'];

   
    if ($accion === "login") {
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        $sql = "SELECT id, nombre, password FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();

            if (password_verify($password, $usuario['password'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nombre'] = $usuario['nombre'];

                header("Location: index.html");
                exit();
            } else {
                echo "<script>alert('❌ Contraseña incorrecta'); window.location='login.html';</script>";
            }
        } else {
            echo "<script>alert('❌ Usuario no encontrado'); window.location='login.html';</script>";
        }
    }

   
    if ($accion === "registro") {
        $nombre   = $_POST['nombre'];
        $email    = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nombre, $email, $password);

        if ($stmt->execute()) {
            echo "<script>alert('✅ Usuario registrado correctamente'); window.location='login.html';</script>";
        } else {
            echo "<script>alert('❌ Error al registrar: " . $stmt->error . "'); window.location='registro.html';</script>";
        }
    }
}

$conn->close();
?>
