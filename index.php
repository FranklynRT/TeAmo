<?php
// CONEXIÓN
$conexion = new mysqli("localhost", "root", "", "romance");
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

$mostrar_personaje = false;
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['respuesta'])) {
    $respuesta = $_POST['respuesta'];
    $conexion->query("INSERT INTO respuestas (respuesta) VALUES ('$respuesta')");
    if ($respuesta === "si") {
        $mostrar_personaje = true;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>¿Quieres ser mi novia?</title>
  <style>
    /* Fondo animado de corazones */
    body {
      margin: 0;
      padding: 0;
      overflow-x: hidden;
      font-family: 'Comic Sans MS', cursive;
    }

    body::before {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: linear-gradient(to bottom right, #ffe6f0, #ffe6fa);
      z-index: -2;
    }

    body::after {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url('15736417.png'); /* Imagen de corazones */
      background-repeat: repeat;
      opacity: 0.15;
      z-index: -1;
      animation: moveBackground 30s linear infinite;
    }

    @keyframes moveBackground {
      0% { background-position: 0 0; }
      100% { background-position: 1000px 1000px; }
    }

    .contenedor {
      background: rgba(255, 255, 255, 0.9);
      padding: 40px;
      border-radius: 20px;
      display: inline-block;
      box-shadow: 0 4px 12px rgba(0,0,0,0.3);
      text-align: center;
      margin-top: 80px;
    }

    h1 {
      color: #d63384;
      font-size: 2.5em;
      margin-bottom: 30px;
    }

    .botones button {
      margin: 15px;
      padding: 15px 35px;
      font-size: 20px;
      border: none;
      border-radius: 15px;
      cursor: pointer;
      transition: transform 0.3s, background 0.3s;
    }

    .si {
      background-color: #ff69b4;
      color: white;
    }

    .no {
      background-color: #f8d7da;
      color: #721c24;
    }

    .mensaje {
      font-size: 24px;
      color: #d63384;
      margin-top: 20px;
    }

    .personaje img {
      width: 250px;
      margin-top: 20px;
      border-radius: 20px;
      box-shadow: 0 0 10px rgba(0,0,0,0.5);
    }

    #mensajesExtra {
      margin-top: 15px;
      font-size: 18px;
      color: #c2185b;
      min-height: 24px;
    }

    html, body {
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: flex-start;
    }
  </style>
</head>
<body>

<div class="contenedor">
<?php if ($mostrar_personaje): ?>
  <h1>¡Dijiste que sí! 💖</h1>
  <div class="mensaje">Ay mi niña linda, mi María hermosa. ¡Te amo muchísimo! 😍</div>
  <div class="personaje">
    <img src="15.png" alt="Personaje romántico">
  </div>
<?php else: ?>
  <h1>¿Quieres ser mi novia?</h1>
  <div class="botones">
    <form method="post" id="formSi">
      <input type="hidden" name="respuesta" value="si">
      <button class="si" type="submit" id="botonSi">Sí ❤️</button>
    </form>
    <button class="no" id="noBtn" onclick="hacerBroma()">No 💔</button>
    <div id="mensajesExtra"></div>
  </div>
<?php endif; ?>
</div>

<script>
let contador = 0;
const mensajes = [
  "¿Estás segura? 🥺",
  "Porfis acepta 😢",
  "No te vas a arrepentir 😍",
  "Sé que en el fondo tú quieres 💘",
  "Merezco una oportunidad 💞",
  "Te prometo ser detallista 💐",
  "Ay mi niña linda 💖",
  "Haré que cada día sea especial 🌟",
  "Tu sonrisa me enamora 😍",
  "No puedo dejar de pensar en ti 💭"
];

function hacerBroma() {
  const mensajeDiv = document.getElementById('mensajesExtra');
  const botonSi = document.getElementById('botonSi');

  if (contador < mensajes.length) {
    mensajeDiv.textContent = mensajes[contador];
  } else {
    mensajeDiv.textContent = "¡Vamos, di que sí! 💓";
  }

  // Aumentar el tamaño del botón "Sí ❤️"
  botonSi.style.transform = `scale(${1 + 0.1 * contador})`;

  contador++;
}
</script>

</body>
</html>
<?php $conexion->close(); ?>
