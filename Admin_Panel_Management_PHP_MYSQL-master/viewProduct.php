<?php
// Inicia el buffer de salida para evitar problemas con la redirección
ob_start();
include 'inc/header.php';
require_once 'classes/Product.php';
$product = new Product();

if (isset($_GET['id'])) {
    $id_product = (int) preg_replace('/[^a-zA-Z0-9-]/', '', $_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $updateProduct = $product->updateProduct($id_product, $_POST);
    if ($updateProduct) {
        echo '<div class="alert alert-success">Actualización exitosa</div>';
        ob_flush();
        header("refresh:2; url=http://localhost/Admin_Panel_Management_PHP_MYSQL-master/Admin_Panel_Management_PHP_MYSQL-master/showProduct.php");
        exit();
    } else {
        echo '<div class="alert alert-danger">Error al actualizar el producto</div>';
        ob_flush();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $deleteProduct = $product->removeProduct($id_product);
    if ($deleteProduct) {
        echo '<div class="alert alert-success">Producto removido exitosamente</div>';
        ob_flush();
        header("refresh:2; url=http://localhost/Admin_Panel_Management_PHP_MYSQL-master/Admin_Panel_Management_PHP_MYSQL-master/index.php");
        exit();
    } else {
        echo '<div class="alert alert-danger">Error al eliminar el producto</div>';
        ob_flush();
    }
}

$getproductInfo = $product->getProductById($id_product);
?>

<div class="card" style="width: 100%;  margin: 20px auto; padding: 20px; height: 700px; font-size: 14px; border-radius: 20px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
    <div class="card-body">
        <h3 style="font-size: 28px; text-align: center;">View Product</h3>
        <?php if ($getproductInfo) { ?>
            <div style="display: flex; flex-direction: column; align-items: center;">
                <form action="" method="POST" style="width: 100%; max-width: 300px;"> <!-- Centra el formulario -->
                    <div class="form-group pt-3">
                        <label for="id_product">ID del producto:</label>
                        <input type="text" value="<?php echo $getproductInfo->id_product; ?>" name="id_product" class="form-control" readonly style="width: 400px; margin: 0 auto;">
                    </div>
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" id="name" value="<?php echo $getproductInfo->Name; ?>" name="name" class="form-control" required style="width:  400px; margin: 0 auto;">
                    </div>
                    <div class="form-group">
                        <label for="price">Precio:</label>
                        <input type="text" id="price" name="price" value="<?php echo $getproductInfo->Price; ?>" class="form-control" required style="width:  400px; margin: 0 auto;">
                    </div>
                    <div class="form-group">
                        <label for="date">Fecha:</label>
                        <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" readonly required style="width:  400px; margin: 0 auto;">
                    </div>
                    <div class="form-group">
                        <label for="category">Categoría:</label>
                        <select id="category" name="category" class="form-control" required style="width:  400px; margin: 0 auto;">
                            <option value="">Seleccione una categoría</option>
                            <option value="Alimentos">Alimentos</option>
                            <option value="Bebidas">Bebidas</option>
                            <option value="Lácteos">Lácteos</option>
                            <option value="Frutas">Frutas</option>
                            <option value="Verduras">Verduras</option>
                            <option value="Higiene">Higiene</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount">Cantidad:</label>
                        <input type="number" id="amount" name="amount" value="<?php echo $getproductInfo->Amount; ?>" class="form-control" required style="width:  400px; margin: 0 auto;">
                    </div>
                    
                    <!-- Botones de actualizar y eliminar -->
                    <div class="form-group text-center mt-3">
                        <button type="submit" name="update" class="btn" style="background-color: #a5d5a5; color: white; font-size: 14px; border-radius: 20px; width: 100px; margin: 5px;">Update</button>
                        <button type="submit" name="delete" class="btn" style="background-color: #f5c6cb; color: white; font-size: 14px; border-radius: 20px; width: 100px; margin: 5px;">Remove</button>
                    </div>
                    
                </form>
            </div>
        <?php } else { ?>
            <div class="form-group text-center">
                <a class="btn" href="showProduct.php" style="background-color: #add8e6; color: white; font-size: 14px; border-radius: 20px;">Ok</a>
            </div>
        <?php } ?>
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
