<?php
include 'inc/header.php';
require_once 'classes/Product.php';
$product = new Product();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_product = $_POST['id_product'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $date = $_POST['date'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];

    if ($product->addNewProduct($id_product, $name, $price, $date, $category, $amount)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>

<div class="card">
    <div class="card-body">
        <h3 class='text-center'>Add Product</h3>
        <div style="width:600px; margin:0px auto">
            <!-- Contenedor para el mensaje de éxito -->
            <div id="successMessage" style="display: none; color: green; text-align: center; font-size: 16px; margin-bottom: 10px;">
                Producto añadido exitosamente
            </div>

            <form action="" method="post" id="productForm">
                <div class="form-group">
                    <label for="id_product">ID del producto:</label>
                    <input type="text" id="id_product" name="id_product" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="price">Precio:</label>
                    <input type="text" id="price" name="price" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="date">Fecha:</label>
                    <input type="date" id="date" name="date" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="category">Categoría:</label>
                    <select id="category" name="category" class="form-control" required>
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
                    <input type="number" id="amount" name="amount" class="form-control" required>
                </div>

                <div class="form-group">
                    <div class="btn-container">
                        <button type="submit" name="addProduct" class="btn btn-success">Añadir producto</button>
                        <button type="reset" class="btn btn-danger">Resetear</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* General Styles */
* {
    box-sizing: border-box;
}

/* Card Styles */
.card {
    width: 100%;
    max-height: 675px;
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
    margin-bottom: 5px;
    font-family: 'Poppins', sans-serif;
    font-size: 16px;
    font-weight: bold;
    color: #4a4a4a;
    text-align: left;
    width: 100%;
}

.form-group {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    width: 100%;
    max-width: 500px;
    margin-bottom: 0px;
}

input, select {
    width: 100%;
    padding: 10px;
    border: 2px solid #ccc;
    border-radius: 30px;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    transition: border-color 0.3s ease;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    margin-bottom: 10px;
}

input:focus, select:focus {
    border-color: #ab6dfc;
    outline: none;
    box-shadow: 0 0 5px rgba(171, 109, 252, 0.5);
}

/* Button Styles */
.btn {
    width: 150px;
    border-radius: 30px;
    padding: 8px 15px;
    font-size: 16px;
    color: #fff;
    cursor: pointer;
}

.btn-success {
    background-color: #b8e6b8;
    border-color: #b8e6b8;
}

.btn-danger {
    background-color: #f8d7da;
    border-color: #f8d7da;
}

.btn-container {
    display: flex;
    justify-content: center;
    width: 100%;
    gap: 10px;
}

.btn-success:hover {
    background-color: #a5d5a5;
    border-color: #a5d5a5;
}

.btn-danger:hover {
    background-color: #f5c6cb;
    border-color: #f5c6cb;
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
document.getElementById('productForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const form = document.getElementById('productForm');
    const formData = new FormData(form);

    fetch('addProduct.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const successMessage = document.getElementById('successMessage');
            successMessage.style.display = 'block';
            setTimeout(() => {
                successMessage.style.display = 'none';
                form.reset();
            }, 3000);
        } else {
            alert('Error al añadir el producto');
        }
    })
    .catch(error => console.error('Error:', error));
});
</script>

<?php
include 'inc/footer.php';
?>
