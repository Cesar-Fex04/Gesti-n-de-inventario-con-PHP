<?php
include 'inc/header.php';
Session::CheckSession();
?>

<?php
if (isset($_GET['id'])) {
    $userid = (int)$_GET['id'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changepass'])) {
    $changePass = $users->changePasswordBysingelUserId($userid, $_POST);
}

if (isset($changePass)) {
    echo $changePass;
}
?>

<style>
    /* Estilos para el contenedor del mensaje y la imagen */
    .welcome-container {
        display: flex; /* Utiliza Flexbox para alinear elementos verticalmente */
        flex-direction: column; /* Cambia la dirección a columna para que los elementos estén uno debajo del otro */
        align-items: center; /* Centrar horizontalmente */
        justify-content: center; /* Centrar verticalmente */
        height: 550px; /* Ajusta la altura deseada del contenedor */
        width: 100%; /* Ajusta el ancho al 100% del contenedor padre */
        max-width: 580px; /* Establece un ancho máximo para la tarjeta */
        padding: 20px;
        margin: 0 auto; /* Centra el contenedor horizontalmente */
        background-color: #ffffff /* Color de fondo opcional */
    }

    /* Estilo para el mensaje de bienvenida */
    .welcome-message {
        font-family: 'Playfair Display', serif; /* Fuente elegante */
        font-size: 48px; /* Tamaño más grande */
        font-weight: 700; /* Negrita */
        color: #2c3e50; /* Color gris oscuro */
        text-align: center; /* Centrar el texto */
        margin-bottom: 40px; /* Añadir margen inferior */
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.1); /* Sombra suave al texto */
    }

    /* Estilo para la imagen */
    .welcome-image {
        max-width: 100%; /* Ajustar la imagen al ancho del contenedor */
        height: auto; /* Mantener la proporción de la imagen */
    }

    .card {
        border: 1px solid #ccc; /* Añadir un borde a la tarjeta */
        border-radius: 20px; /* Añadir bordes redondeados */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Añadir sombra suave */
        margin: 10px; /* Añadir margen exterior */
        padding: 20px; /* Añadir relleno interior */
    }
</style>

<div class="card">
    <div class="welcome-container">
        <!-- Mensaje de bienvenida en la parte superior -->
        <div class="welcome-message">
            Welcome to our page
        </div>

        <!-- Imagen en la parte inferior -->
        <div>
            <img src="welcome.png" alt="Inventario" class="welcome-image">
        </div>
    </div>
</div>



<?php
include 'inc/footer.php';
?>
