<?php
// Configura los parámetros de la base de datos
$host = 'localhost'; 
$user = 'root'; 
$password = ''; // Contraseña vacía
$database = 'db_admin'; 

// Nombre del archivo de respaldo
$backup_file = $database . '_' . date("Y-m-d_H-i-s") . '.sql';

// Lógica para manejar la contraseña vacía
if (empty($password)) {
    // Si no hay contraseña, omitimos el parámetro -p
    $command = "C:\\xampp\\mysql\\bin\\mysqldump.exe --opt -h $host -u $user $database > $backup_file";
} else {
    // Si hay contraseña, la incluimos pegada al -p
    $command = "C:\\xampp\\mysql\\bin\\mysqldump.exe --opt -h $host -u $user -p$password $database > $backup_file";
}

// Ejecutar el comando
system($command, $return_var);

// Verifica si el comando se ejecutó correctamente (0 significa éxito en la consola)
if ($return_var !== 0) {
    die("Error al crear el backup de la base de datos. Código de salida: " . $return_var);
}

// Forzar la descarga del archivo de respaldo
header('Content-Type: application/sql');
header('Content-Disposition: attachment; filename="' . basename($backup_file) . '"');
header('Content-Length: ' . filesize($backup_file));
readfile($backup_file);

// Opcional: Eliminar el archivo del servidor después de la descarga para no ocupar espacio
unlink($backup_file);
exit;
?>