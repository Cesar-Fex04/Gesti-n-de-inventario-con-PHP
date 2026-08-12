<?php
include 'inc/header.php';
Session::CheckSession();
$sId = Session::get('roleid');

// CORRECCIÓN: Se cambió === por == para evitar problemas de tipos de datos
if ($sId == '1') { ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addUser'])) {
    $userAdd = $users->addNewUserByAdmin($_POST);
}

if (isset($userAdd)) {
    echo $userAdd; 
}
?>

<style>
/* General Styles */
* {
    box-sizing: border-box;
}

/* Card Styles */
.card {
    width: 80%;
    max-height: auto;
    overflow-y: auto;
    border-radius: 30px;
    background-color: white;
    margin: auto;
    padding: 40px 20px;
}

/* Form Styles */
form {
    display: flex;
    flex-direction: column;
    align-items: center; 
}

label {
    margin-bottom: 2px; 
    font-family: 'Arial', sans-serif;
    font-size: 14px;
    font-weight: bold;
    color: #777; 
    text-align: left; 
    width: 100%; 
}

.form-group {
    display: flex;
    flex-direction: column;
    align-items: flex-start; 
    width: 100%;
    max-width: 500px; 
    margin-bottom: 5px; 
}

/* Input and Select Styles */
input, select {
    width: 100%; 
    height: 20px; 
    padding: 12px;
    border: 2px solid #ccc;
    border-radius: 30px;
    font-family: 'Arial', sans-serif;
    font-size: 18px;
    transition: border-color 0.3s ease;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    background-color: #fff;
}


input:focus, select:focus {
    border-color: #ab6dfc; 
    outline: none; 
    box-shadow: 0 0 5px rgba(171, 109, 252, 0.5); 
}

/* Button Styles */
.btn-success {
    background-color: #b8e6b8; 
    border-color: #b8e6b8; 
    color: #fff; 
    border-radius: 30px; 
    padding: 10px 20px; 
    font-size: 18px; 
    cursor: pointer; 
    margin-top: 20px; 
}

/* Centrar el botón */
.btn-container {
    display: flex; 
    justify-content: center; 
    width: 100%; 
}

.btn-success:hover {
    background-color: #a5d5a5; 
    border-color: #a5d5a5; 
    color: #fff; 
}

/* Header Styles */
h3 {
    font-family: 'Poppins', sans-serif; 
    font-size: 32px; 
    font-weight: bold; 
    color: #4a4a4a; 
    text-align: center; 
    margin-top: 0; 
    margin-bottom: 20px; 
}
</style>

<div class="card">
    <h3 class='text-center'>Add New User</h3>
    <div style="width:600px; margin:0px auto">
        <form action="" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="username">Nombre de usuario</label>
                <input type="text" name="username" id="username" class="form-control"  required>
            </div>
            <div class="form-group">
                <label for="email">Correo electronico</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="mobile">Numero telefonico</label>
                <input type="text" name="mobile" class="form-control"  required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="roleid">Rol de usuario</label>
                <select class="form-control" name="roleid" id="roleid" required>
                    <option value="" disabled selected>Select user role</option>
                    <option value="1">Admin</option>
                    <option value="2">Editor</option>
                    <option value="3">User only</option>
                </select>
            </div>
            <div class="btn-container">
                <button type="submit" name="addUser" class="btn btn-success">Register</button>
            </div>
        </form>
    </div>
</div>

<?php
} else {
    header('Location:index.php');
}
?>

<?php
include 'inc/footer.php';
?>