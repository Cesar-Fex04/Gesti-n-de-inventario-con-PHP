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

if (isset($_GET['deactive'])) {
  $deactive = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['deactive']);
  $deactiveId = $users->userDeactiveByAdmin($deactive);

  if ($deactiveId) {
    // Redirigir a userlist.php después de la desactivación
    header("Location: userlist.php");
    exit();
  }
}

if (isset($_GET['active'])) {
  $active = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['active']);
  $activeId = $users->userActiveByAdmin($active);
}

if (isset($activeId)) {
  echo $activeId;
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

.btn-light-success { background-color: #b6e3b6; color: #333; }
.btn-light-info { background-color: #cbe3ff; color: #333; }
.btn-light-danger { background-color: #f8c1c1; color: #333; }
.btn-light-warning { background-color: #ffe5b6; color: #333; }
.btn-light-secondary { background-color: #d3d3d3; color: #333; }

@media (max-width: 768px) {
  .table th, .table td {
    font-size: 12px;
  }
  .btn-sm {
    padding: 0.2rem 0.4rem;
  }
}
.card {
  max-width: 100%;
  padding: 10px; /* Espacio para el borde rojo */
  border-radius: 30px; /* Borde exterior redondeado */
  background-color: white; /* Borde exterior de color rojo */
}

.card-body {
  background-color: white; /* Fondo blanco para el contenido interno */
  border-radius: 20px; /* Borde redondeado interno */
  padding: 20px;
  overflow-y: auto;
}

.btn-container {
    display: flex; /* Utiliza flexbox para alinear elementos */
    justify-content: center; /* Centra el botón horizontalmente */
    margin-top: 20px; /* Espacio superior para separación */
}

.btn-print {
    background-color: #b8e6b8; /* Color de fondo pastel */
    border: none; /* Sin borde */
    color: #fff; /* Color del texto */
    border-radius: 15px; /* Bordes redondeados */
    width: 100px; /* Ancho fijo de 100px */
    padding: 8px; /* Espaciado interno ajustado */
    font-size: 16px; /* Tamaño de fuente */
    cursor: pointer; /* Cambia el cursor al pasar sobre el botón */
    transition: background-color 0.3s ease; /* Efecto de transición */
}

.btn-print:hover {
    background-color: #a5d5a5; /* Color ligeramente más oscuro al pasar el mouse */
}
</style>

<div class="card" style="margin: auto; display: auto; max-width: 100%; overflow-x: auto;">
  <div class="card-body pr-2 pl-2" style="height: auto; padding: 10px; border: 1px solid #ccc;">

  <h3><i class="fas fa-users mr-2"></i>User list <span class="float-right">Welcome! <strong>
      <span class="badge badge-lg badge-secondary text-white">
        <?php
        $username = Session::get('username');
        if (isset($username)) {
          echo $username;
        }
        ?>
      </span>
    </strong></span></h3>

    <div class="table-responsive">
      <table id="example" class="table table-striped table-bordered" style="width: 100%; max-width: 100%;">
        <thead>
          <tr>
            <th class="text-center">SL</th>
            <th class="text-center">Name</th>
            <th class="text-center">Username</th>
            <th class="text-center">Email address</th>
            <th class="text-center">Mobile</th>
            <th class="text-center">Status</th>
            <th class="text-center">Created</th>
            <th class="text-center" width="25%">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $allUser = $users->selectAllUserData();
          if ($allUser) {
            $i = 0;
            foreach ($allUser as $value) {
              $i++;
          ?>
            <tr class="text-center" <?php if (Session::get("id") == $value->id) { echo "style='background:#d9edf7'"; } ?>>
              <td><?php echo $i; ?></td>
              <td><?php echo $value->name; ?></td>
              <td><?php echo $value->username; ?> <br>
                <?php if ($value->roleid == '1') {
                  echo "<span class='badge badge-lg badge-info text-white'>Admin</span>";
                } elseif ($value->roleid == '2') {
                  echo "<span class='badge badge-lg badge-dark text-white'>Editor</span>";
                } elseif ($value->roleid == '3') {
                  echo "<span class='badge badge-lg badge-dark text-white'>User Only</span>";
                } ?>
              </td>
              <td><?php echo $value->email; ?></td>
              <td><span class="badge badge-lg badge-secondary text-white"><?php echo $value->mobile; ?></span></td>
              <td>
                <?php if ($value->isActive == '0') { ?>
                <span class="badge badge-lg badge-info text-white">Active</span>
                <?php } else { ?>
                <span class="badge badge-lg badge-danger text-white">Deactive</span>
                <?php } ?>
              </td>
              <td><span class="badge badge-lg badge-secondary text-white"><?php echo $users->formatDate($value->created_at); ?></span></td>
              
              <td>
                <?php if (Session::get("roleid") == '1') { ?>
                <a class="btn btn-light-info btn-sm" href="profile.php?id=<?php echo $value->id; ?>">Edit</a>
                <a class="btn btn-light-danger btn-sm" href="?remove=<?php echo $value->id; ?>">Remove</a>
                <?php if ($value->isActive == '0') { ?>
                <a class="btn btn-light-warning btn-sm" href="?deactive=<?php echo $value->id; ?>">Disable</a>
                <?php } elseif ($value->isActive == '1') { ?>
                <a class="btn btn-light-secondary btn-sm" href="?active=<?php echo $value->id; ?>">Active</a>
                <?php } ?>
                <?php } ?>
              </td>
            </tr>
          <?php }} else { ?>
            <tr class="text-center">
              <td>No user available now!</td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="btn-container">
    <button onclick="printTable()" class="btn btn-print">Print</button>
</div>

</div>


<!-- Script for Printing -->
<script>
function printTable() {
    const printContent = document.createElement('div');
    const logo = '<img src="NexGenLogo.png" alt="Logo de la empresa" style="width: 200px;">';
    const currentDate = new Date();
    const dateTime = `<p>Fecha y hora de impresión: ${currentDate.toLocaleDateString()} ${currentDate.toLocaleTimeString()}</p>`;
    const signature = '<center><p><br><br><br><br><br><br><br>Certificado por: <br><img src="firma.jpg" alt="Firma" style="width: 100px;"></p></center>';
    
    // Content to print
    printContent.innerHTML = `
        ${logo}
        ${dateTime}
        ${document.querySelector('.table-responsive').outerHTML}
        ${signature}
    `;

    // Open new window for printing
    const printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write('<html><head><title>Impresión de Productos</title>');
    printWindow.document.write('<link rel="stylesheet" href="ruta_a_tu_estilo.css">'); // Ruta a tu CSS si es necesario
    printWindow.document.write('</head><body>');
    printWindow.document.write(printContent.innerHTML);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}
</script>
<?php
include 'inc/footer.php';
?>
