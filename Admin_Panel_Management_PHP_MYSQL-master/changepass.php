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
  h3 {
    font-family: 'Blinker', sans-serif;
    font-size: 40px;
    font-weight: bold;
    color: #333;
    text-align: center;
    margin: 20px 0;
  }

  input {
    display: block;
    width: 100%;
    margin-bottom: 10px;
    padding: 10px;
    
    border-radius: 40px;
    font-family: 'Blinker', sans-serif;
    font-size: 18px;
  }

  label {
    display: block;
    margin-bottom: 5px;
    font-family: 'Blinker', sans-serif;
    font-size: 16px;
    font-weight: bold;
    color: #333;
  }

  .btn-success {
    display: block;
    margin: 20px auto;
    padding: 10px 20px;
    font-size: 16px;
    background-color: #b3d4fc;
    color: #333;
    border: none;
    border-radius: 20px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .btn-success:hover {
    background-color: #a0c9f2;
  }

  .card {
    border-radius: 20px;
    
  }

  .card-body {
    border-radius: 20px;
    background-color: white;
    padding: 20px;
   
    width: 900px; /* Ancho de 400 px */
    margin: 0 auto; /* Centrar horizontalmente */
    height: 400px; /* Alto de 400 px */
    overflow: auto; /* Asegura que el contenido que sobrepase el alto tenga barra de desplazamiento */
  }
</style>


<div class="card">
  <div class="card-body">
    <h3>Change your password</h3>
    <form action="" method="POST">
      <div class="form-group">
      <label for="amount">Contraseña nueva:</label>
        <input type="password" name="old_password" class="form-control" >
      </div>
      <div class="form-group">
      <label for="amount">Contraseña nueva:</label>
        <input type="password" name="new_password" class="form-control">
      </div>
      <div class="form-group">
        <button type="submit" name="changepass" class="btn btn-success">Change password</button>
      </div>
    </form>
  </div>
</div>

<?php
include 'inc/footer.php';
?>
