<?php
include("conexion.php");

// 4. Recibir datos del formulario (index.html)
$habitacion = $_POST['habitacion'];
$checkin    = $_POST['checkin'];
$checkout   = $_POST['checkout'];
$huespedes  = $_POST['huespedes'];

// 5. Insertar datos en la tabla "reservas"
$sql = "INSERT INTO reservas (habitacion, checkin, checkout, huespedes) 
        VALUES ('$habitacion', '$checkin', '$checkout', '$huespedes')";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reserva Hotel Paraíso</title>
  <style>
    body {
      font-family: Arial, sans-serif;
       background: url('assets/img/banner-vista-mar.jpg') no-repeat center center/cover;
      background-size: cover;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }
    .card {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 20px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
      padding: 30px;
      max-width: 400px;
      text-align: center;
      animation: fadeIn 0.8s ease-in-out;
    }
    h2 {
      color: #2e8b57;
      margin-bottom: 15px;
    }
    p {
      font-size: 16px;
      margin: 6px 0;
    }
    button {
      background-color: #25d366;
      color: white;
      border: none;
      padding: 12px 20px;
      font-size: 16px;
      border-radius: 10px;
      cursor: pointer;
      transition: 0.3s;
      margin-top: 15px;
    }
    button:hover {
      background-color: #1ebc5c;
      transform: scale(1.05);
    }
    a {
      display: inline-block;
      margin-top: 15px;
      text-decoration: none;
      color: #2e8b57;
      font-weight: bold;
    }
    a:hover {
      text-decoration: underline;
    }
    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(-20px);}
      to {opacity: 1; transform: translateY(0);}
    }
  </style>
</head>
<body>
  <div class="card">
    <?php
    if ($conexion->query($sql) === TRUE) {
        echo "<h2>✅ Reserva guardada con éxito</h2>";
        echo "<p><b>Habitación:</b> $habitacion</p>";
        echo "<p><b>Check-in:</b> $checkin</p>";
        echo "<p><b>Check-out:</b> $checkout</p>";
        echo "<p><b>Huéspedes:</b> $huespedes</p>";
        
        // Botón de WhatsApp (con mensaje automático)
        $mensaje = "Hola, quiero confirmar mi reserva: Habitación $habitacion, Check-in $checkin, Check-out $checkout, Huéspedes $huespedes";
        $mensaje = urlencode($mensaje); // Codificar para URL
        
        echo "<button onclick=\"window.location.href='https://wa.me/573128422533?text=$mensaje';\">
                Confirmar por WhatsApp
              </button>";
        
        echo "<br><a href='index.html'>⬅ Volver al inicio</a>";
    } else {
        echo "<h2 style='color:red;'>❌ Error en la reserva</h2>";
        echo "<p>" . $conexion->error . "</p>";
        echo "<a href='index.html'>⬅ Volver al inicio</a>";
    }

    // 6. Cerrar conexión
    $conexion->close();
    ?>
  </div>
</body>
</html>
