<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

// Configuración de la base de datos
$host = 'localhost';
$dbname = 'db_admin';
$user = 'root'; // Cambia esto por tu usuario de la base de datos
$password = ''; // Cambia esto por tu contraseña de la base de datos

// Conexión a la base de datos
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión a la base de datos: " . $e->getMessage());
}

// Consulta para obtener el email y la contraseña
$query = "SELECT email, password FROM tbl_users WHERE id = :user_id"; // Ajusta el ID de usuario según lo necesites
$stmt = $pdo->prepare($query);
$stmt->execute(['user_id' => 1]); // Reemplaza '1' con el ID del usuario que deseas utilizar

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("No se encontró el usuario especificado.");
}

$email = $user['email'];
$password = $user['password']; // Este es el hash de la contraseña; asegúrate de no enviar contraseñas sin cifrar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $tableContent = $data['table'] ?? '';

    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP de Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $email; // Usa el email extraído de la base de datos
        $mail->Password = $password; // Usa la contraseña extraída (si es una contraseña de aplicación o sin restricciones)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configuración del correo
        $mail->setFrom($email, 'Nombre Remitente');
        $mail->addAddress('destinatario@correo.com', 'Nombre Destinatario'); // Destinatario

        $mail->isHTML(true);
        $mail->Subject = 'Lista de productos';
        $mail->Body    = '<html><body><h1>Lista de Productos</h1>' . $tableContent . '</body></html>';

        $mail->send();
        echo 'Correo enviado exitosamente';
    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
}
?>
