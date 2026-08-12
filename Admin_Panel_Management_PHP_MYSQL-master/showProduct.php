<?php
include 'inc/header.php';

Session::CheckSession();

$logMsg = Session::get('logMsg');
if (isset($logMsg)) {
  echo $logMsg;
}
$msg = Session::get('msg');
if (isset($msg)) {
  echo $msg;
}
Session::set("msg", NULL);
Session::set("logMsg", NULL);
?>

<?php
if (isset($_GET['remove'])) {
  $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove']);
  $removeUser = $users->deleteUserById($remove);
}

if (isset($removeUser)) {
  echo $removeUser;
}

if (isset($deactiveId)) {
  echo $deactiveId;
}

if (isset($activeId)) {
  echo $activeId;
}
?>

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
  $deleteProduct = $product->removeProduct($id_product);
  if ($deleteProduct) {
      echo '<div class="alert alert-success">Producto removido exitosamente</div>';
      header('Location: index.php');
      exit;
  } else {
      echo '<div class="alert alert-danger">Error al quitar el producto</div>';
  }
}
?>

<style>
.table-responsive {
  max-width: 100%;
  overflow-x: auto;
}

.card {
  width: 100%;
  max-width: 100%;
}

.table {
  table-layout: auto;
}

@media (max-width: 768px) {
  .table th, .table td {
    font-size: 12px;
  }

  .btn-sm {
    padding: 0.2rem 0.4rem;
  }
}

.btn-primary {
  background-color: #add8e6; /* Azul pastel */
  color: #fff; /* Texto blanco */
  border: none;
  border-radius: 20px; /* Bordes redondeados */
  padding: 5px 15px; /* Tamaño reducido */
  font-size: 14px; /* Fuente más pequeña */
  width: 200px; /* Ancho fijo de 200px */
  transition: background-color 0.3s ease;
  margin: 0 auto; /* Centrando el botón */
  display: block; /* Necesario para aplicar margin auto */
}

.btn-primary:hover {
  background-color: #87ceeb; /* Color azul pastel un poco más oscuro al pasar el cursor */
}

</style>

<div class="card" style="margin: auto; display: auto; max-width: 100%; overflow-x: auto;">
  <div class="card-header">
    <h3><i class="fas fa-users mr-2"></i>Our products <span class="float-right">Welcome! <strong>
      <span class="badge badge-lg badge-secondary text-white">
      <?php
        $username = Session::get('username');
        if (isset($username)) {
          echo $username;
        }
      ?>
      </span>
    </strong>
    </span></h3>
  </div>
  <div class="card-body pr-2 pl-2" style="height: auto; padding: 10px; border: 1px solid #ccc;">
    <div class="table-responsive">
      <table id="example" class="table table-striped table-bordered" style="width: 100%; max-width: 100%;">
        <thead>
          <tr>
            <th class="text-center">id_product</th>
            <th class="text-center">Name</th>
            <th class="text-center">price</th>
            <th class="text-center">Date</th>
            <th class="text-center">Category</th>
            <th class="text-center">Amount</th>
            <th class="text-center" width="25%">Action</th>
          </tr>
        </thead>
        <tbody>
          
<?php
$allProducts = $product->getAllProducts();
if ($allProducts) {
    $i = 0;
    foreach ($allProducts as $value) {
        $i++;
        ?>
        <tr class="text-center">
            <td><?php echo $value->id_product; ?></td>
            <td><?php echo $value->Name; ?></td>
            <td><?php echo $value->Price; ?></td>
            <td><?php echo $value->Date; ?></td>
            <td><?php echo $value->Category; ?></td>
            <td><?php echo $value->Amount; ?></td>
            <td>
                <?php if (Session::get("roleid") == '1') { ?>
                <a class="btn btn-info btn-sm" href="viewProduct.php?id=<?php echo $value->id_product; ?>">Modify</a>
                <?php } ?>
            </td>
        </tr>
        <?php
    }
} else {
    ?>
    <tr class="text-center">
        <td colspan="7">No products available now!</td>
    </tr>
    <?php
}
?>
</tbody>
      </table>
    </div>
  </div>
  <button onclick="printTable()" class="btn btn-primary mt-3">Print</button>
</div>

<!-- Script for Printing -->
<script>
function printTable() {
    const printContent = document.createElement('div');
  const logoUrl = new URL('../logo.jpeg', window.location.href).href;
  const signatureUrl = new URL('firma.jpg', window.location.href).href;
  const cssUrl = new URL('assets/style.css', window.location.href).href;
  const logo = `<img src="${logoUrl}" alt="Logo de la empresa" style="width: 450px;">`;
    const currentDate = new Date();
    const dateTime = `<p>Fecha y hora de impresión: ${currentDate.toLocaleDateString()} ${currentDate.toLocaleTimeString()}</p>`;
  const signature = `<center><p><br><br><br><br><br><br><br>Certificado por: <br><img src="${signatureUrl}" alt="Firma" style="width: 100px;"></p></center>`;
    
    printContent.innerHTML = `
        ${logo}
        ${dateTime}
        ${document.querySelector('.table-responsive').outerHTML}
        ${signature}
    `;

    const printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write('<html><head><title>Impresión de Productos</title>');
    printWindow.document.write(`<link rel="stylesheet" href="${cssUrl}">`);
    printWindow.document.write('</head><body>');
    printWindow.document.write(printContent.innerHTML);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.onload = function () {
      printWindow.focus();
      printWindow.print();
    };
}
</script>

<?php
  include 'inc/footer.php';
?>
