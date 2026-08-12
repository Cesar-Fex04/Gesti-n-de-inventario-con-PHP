<?php
include 'inc/header.php';
Session::CheckLogin();
?>


<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
  $userLog = $users->userLoginAuthotication($_POST);
}
if (isset($userLog)) {
  echo $userLog;
}

$logout = Session::get('logout');
if (isset($logout)) {
  echo $logout;
}


?>


<div class="card" style="width: auto; margin: 20px; border-radius: 20px; overflow: hidden;"> <!-- Ancho automático, margen y bordes redondeados -->
  <div class="card-body" style="max-height: 300px; overflow-y: auto; border-radius: 20px; background-color: white; padding: 20px;"> <!-- Establecer altura máxima, permitir desplazamiento, agregar bordes redondeados y color de fondo -->
    <h3 class='text-center'><i class="fas fa-sign-in-alt mr-2"></i>User login</h3>
    <div style="width: 100%; max-width: 600px; margin: 0 auto;"> <!-- Contenedor responsivo -->
      <form action="" method="post">
        <div class="form-group">
          <input type="email" name="email" class="form-control" placeholder="Email address" style="border-radius: 15px;">
        </div>
        <div class="form-group">
          <input type="password" name="password" class="form-control" placeholder="Password" style="border-radius: 15px;">
        </div>
        <div class="form-group text-center"> <!-- Centrado del botón -->
          <button type="submit" name="login" class="btn btn-success">Login</button>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
  .form-control {
      border-radius: 15px; /* Bordes redondeados para los campos de entrada */
  }

  /* Estilo para el botón */
  .btn-success {
      border-radius: 15px; /* Bordes redondeados para el botón */
      background-color: #a8e6cf; /* Verde pastel más suave */
      color: white; /* Texto blanco */
      padding: 6px 15px; /* Ajustar tamaño reducido */
      font-size: 14px; /* Fuente más pequeña */
      width: 150px; /* Ancho fijo más pequeño */
      transition: background-color 0.3s ease; /* Transición suave */
  }

  .btn-success:hover {
      background-color: #81c9b7; /* Verde pastel un poco más oscuro al pasar el cursor */
  }

  .card {
      width: auto; /* Ancho automático para ajustarse al contenido */
      margin: auto; /* Margen alrededor de la tarjeta */
      border-radius: 20px; /* Bordes redondeados para la tarjeta */
      overflow: hidden; /* Oculta cualquier desbordamiento de los bordes redondeados */
  }

  .card-body {
      max-height: 300px; /* Altura máxima para el cuerpo de la tarjeta */
      overflow-y: auto; /* Habilitar desplazamiento vertical si el contenido es más alto */
      border-radius: 20px; /* Bordes redondeados para el cuerpo de la tarjeta */
      background-color: white; /* Color de fondo para que el efecto de borde redondeado sea visible */
      padding: 20px; /* Espacio interior */
  }
</style>


<?php
include 'inc/footer.php';
?>
