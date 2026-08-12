<?php
include 'inc/header.php';
Session::CheckSession();
?>

<?php
if (isset($_GET['id'])) {
  $userid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
  $updateUser = $users->updateUserByIdInfo($userid, $_POST);
  
  if ($updateUser) {
    // Redirigir a profile.php después de actualizar
    header('Location: profile.php');
    exit(); // Asegurarse de que no se ejecute más código después de la redirección
  }
}

if (isset($updateUser)) {
  echo $updateUser;
}
?>

<div class="card">
  <div class="card-body pr-2 pl-2" style="height: auto; padding: 10px; border: 1px solid #ccc; border-radius: 20px;">
    <h3 class="user-profile-title">User Profile</h3>
    
    <?php
    $getUinfo = $users->getUserInfoById($userid);
    if ($getUinfo) {
    ?>
    
    <div style="width: 50%; margin: 0 auto; margin-top: 5%;">
      <form action="" method="POST">
        <div class="form-group">
          <label for="name">Tu nombre</label>
          <input type="text" name="name" value="<?php echo $getUinfo->name; ?>" class="form-control">
        </div>
        <div class="form-group">
          <label for="username">Tu nombre de usuario</label>
          <input type="text" name="username" value="<?php echo $getUinfo->username; ?>" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">Correo electronico</label>
          <input type="email" id="email" name="email" value="<?php echo $getUinfo->email; ?>" class="form-control">
        </div>
        <div class="form-group">
          <label for="mobile">Numero de telefono</label>
          <input type="text" id="mobile" name="mobile" value="<?php echo $getUinfo->mobile; ?>" class="form-control">
        </div>

        <?php if (Session::get("roleid") == '1') { ?>
        <div class="form-group">
          <label for="sel1">Seleccciona rol </label>
          <select class="form-control" name="roleid" id="roleid">
            <?php
              if ($getUinfo->roleid == '1') {
                echo "<option value='1' selected='selected'>Admin</option>";
                echo "<option value='2'>Editor</option>";
                echo "<option value='3'>User only</option>";
              } elseif ($getUinfo->roleid == '2') {
                echo "<option value='1'>Admin</option>";
                echo "<option value='2' selected='selected'>Editor</option>";
                echo "<option value='3'>User only</option>";
              } elseif ($getUinfo->roleid == '3') {
                echo "<option value='1'>Admin</option>";
                echo "<option value='2'>Editor</option>";
                echo "<option value='3' selected='selected'>User only</option>";
              }
            ?>
          </select>
        </div>
        <?php } else { ?>
          <input type="hidden" name="roleid" value="<?php echo $getUinfo->roleid; ?>">
        <?php } ?>

        <div class="form-group text-center"> <!-- Centrar botones -->
          <?php if (Session::get("id") == $getUinfo->id || Session::get("roleid") == '1' || Session::get("roleid") == '2') { ?>
            <button type="submit" name="update" class="btn btn-success">Update</button>
            <?php if (Session::get("roleid") != '2') { ?>
              <a class="btn btn-primary" href="changepass.php?id=<?php echo $getUinfo->id; ?>">Password change</a>
            <?php } ?>
          <?php } else { ?>
            <a class="btn btn-primary" href="userlist.php">Ok</a>
          <?php } ?>
        </div>
      </form>
    </div>

    <?php } else {
      header('Location:userlist.php');
    } ?>
  </div>
</div>

<style>
  /* Enlace a Google Fonts */
  @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
  
  .user-profile-title {
      margin-top: 20px; /* Margen superior */
      margin-bottom: 0px; /* Margen inferior */
      color: #696969; /* Color gris oscuro */
      font-family: 'Roboto', sans-serif; /* Fuente estilizada */
      font-weight: 700; /* Negrita */
      text-align: center;
  }

  .form-control {
      border-radius: 15px; /* Bordes redondeados para los campos de entrada */
  }

  .btn-success, .btn-primary {
      border-radius: 15px; /* Bordes redondeados para los botones */
      background-color: #c1e1c5; /* Verde pastel claro */
      color: white;
      padding: 6px 15px;
      font-size: 14px;
      width: auto;
      transition: background-color 0.3s ease;
      display: inline-block;
      margin: 5px;
  }

  .btn-success:hover, .btn-primary:hover {
      background-color: #a4d4a0; /* Verde pastel un poco más oscuro */
  }

  .card {
      border-radius: 20px;
      margin: 20px;
  }

  .card-body {
      border-radius: 20px;
      background-color: white;
      padding: 20px;
  }
</style>

<?php
include 'inc/footer.php';
?>
