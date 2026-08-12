<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . "/../lib/Session.php";
Session::init();



spl_autoload_register(function ($classes) {

  include 'classes/' . $classes . ".php";

});


$users = new Users();
$product = new Product();





?>



<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>PHP CRUD User Management</title>
  
  <link rel="stylesheet" href="assets/bootstrap.min.css">
  <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">

  <link rel="stylesheet" href="assets/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/style.css">
  <!-- 

 -->
</head>

<body>

<style>
/* */ 
    body {
     background: #e8e8e8;
     display: flex;
      justify-content: center;
      align-items: center;
      margin: 0%;
      font-family: Arial, sans-serif;
    }

h3 {
    font-family: 'Blinker', sans-serif;
    font-size: 40px;
    font-weight: bold;
    color: #333;
  }

input {
    display: block;
    width: 100%;
    margin-bottom: 10px;
    padding: 10px;
    border: 6px solid #ccc;
    border-radius: 10px;
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



  </style>

  <?php


  if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    // Session::set('logout', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
    // <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    // <strong>Success !</strong> You are Logged Out Successfully !</div>');
    Session::destroy();
  }



  ?>

<style>
      .navbar {
        border-radius: 15px; /* Bordes redondeados para el navbar */
        margin: 10px 0; 
    }

    .navbar-nav .nav-link {
        padding: 15px 20px; /* Ajusta el padding */
        transition: background-color 0.3s; /* Transición suave para el efecto hover */
    }

    .navbar-nav .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.2); /* Ligera aclaración al pasar el mouse */
        color: white; /* Mantener el texto blanco */
    }
  </style>



<div class="container">

  <!-- Mostra barra para user --> 

  <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #ab6dfc;">
    <a class="navbar-brand" href="index.php">
      <i class="fas fa-home mr-2"></i>Dashboard
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
        aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ml-auto">

<!-- Mostra barra para administrador --> 
          <?php if (Session::get('id') == TRUE) { ?>
            <?php if (Session::get('roleid') == '1') { ?>

              <li class="nav-item
      <?php
      $path = $_SERVER['SCRIPT_FILENAME'];
      $current = basename($path, '.php');
      if ($current == 'backup') {
          echo " active ";
      }
      ?>">
      <a class="nav-link" href="backup.php"><i class="fas fa-download mr-2"></i></a>
      </li>

      <li class="nav-item">

                <a class="nav-link" href="userlist.php"><i class="fas fa-users mr-2"></i></span></a>
      </li>

      <li class="nav-item

              <?php

              $path = $_SERVER['SCRIPT_FILENAME'];
              $current = basename($path, '.php');
              if ($current == 'addUser') {
                echo " active ";
              }

              ?>">

                <a class="nav-link" href="addUser.php"><i class="fas fa-user-plus mr-2"></i></span></a>
     </li>
     
            <li class="nav-item
            <?php

            $path = $_SERVER['SCRIPT_FILENAME'];
            $current = basename($path, '.php');
            if ($current == 'addProduct') {
              echo "active ";
            }
            ?>

            ">

              <a class="nav-link" href="addProduct.php"><i class="fa fa-cart-plus"></i> <span class="sr-only"></span></a>
              
     </li>

     <?php } #Hasta aqui llegamos a lo que puede ver el administrador con id 1?>
    
    
    
    
    
            <li class="nav-item
            <?php #Los usarios con id 3 solo pueden ver  la lista de productos apartir de aqui

            $path = $_SERVER['SCRIPT_FILENAME'];
            $current = basename($path, '.php');
            if ($current == 'profile') {
              echo "active ";
            }

            ?>

            ">

              <a class="nav-link" href="profile.php?id=<?php echo Session::get("id"); ?>"><i
                  class="fa fa-user"></i><span class="sr-only">(current)</span></a>
     </li>

     <li class="nav-item
            <?php

            $path = $_SERVER['SCRIPT_FILENAME'];
            $current = basename($path, '.php');
            if ($current == 'showProduct') {
              echo "active ";
            }
            ?>

            ">

              <a class="nav-link" href="showProduct.php"><i
                  class="fa fa-shopping-cart"></i><span class="sr-only">(current)</span></a>
     </li>


            <li class="nav-item">
              <a class="nav-link" href="?action=logout"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
            </li>
          <?php } else { ?>

            <li class="nav-item

              <?php

              $path = $_SERVER['SCRIPT_FILENAME'];
              $current = basename($path, '.php');
              if ($current == 'register') {
                echo " active ";
              }

              ?>">
              <a class="nav-link" href="register.php"><i class="fas fa-user-plus mr-2"></i>Register</a>
            </li>
            



          <?php } ?>


        </ul>

      </div>

    </nav>
  