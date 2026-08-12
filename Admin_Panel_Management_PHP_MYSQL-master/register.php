<?php
include 'inc/header.php';
Session::CheckLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {

  $register = $users->userRegistration($_POST);
}

if (isset($register)) {
  echo $register;
}


 ?>


 <div class="card ">
   <div class="card-header">
          <h3 class='text-center'>User Registration</h3>
        </div>
        <div class="cad-body">



            <div style="width:600px; margin:0px auto">

            <form class="" action="" method="post">
                <div class="form-group pt-3">
                  <input type="text" name="name"  class="form-control" placeholder="Your name">
                </div>
                <div class="form-group">
                  <input type="text" name="username"  class="form-control" placeholder="Your username">
                </div>
                <div class="form-group">
                  <input type="email" name="email"  class="form-control" placeholder="E-mail address">
                </div>
                <div class="form-group">
                  <input type="text" name="mobile"  class="form-control" placeholder="Mobile number">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control" placeholder="Password">
                  <input type="hidden" name="roleid" value="3" class="f orm-control">
                </div>
                <div class="form-group">
                  <button type="submit" name="register" class="btn btn-success">Register</button>
                </div>


            </form>
          </div>


        </div>
      </div>



  <?php
  include 'inc/footer.php';

  ?>
