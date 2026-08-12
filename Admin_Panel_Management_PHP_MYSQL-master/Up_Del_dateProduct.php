<?php
include 'inc/header.php';
Session::CheckSession();

 ?>

<?php

if (isset($_GET['id'])) {
  $userid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);

}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
  $updateProduct = $product->updateUserByIdInfo($userid, $_POST);

}
if (isset($updateUser)) {
  echo $updateUser;
}




 ?>