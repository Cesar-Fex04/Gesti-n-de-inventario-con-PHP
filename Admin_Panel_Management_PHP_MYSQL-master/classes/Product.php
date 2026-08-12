

<?php


class Product {
  private $db;

  public function __construct() {
    $this->db = new mysqli("localhost", "root", "", "db_admin");
    if ($this->db->connect_error) {
      die("Error al conectar a la base de datos: " . $this->db->connect_error);
    }
  }   

  public function addNewProduct($id_product, $name, $price, $date, $category, $amount) {
    $query = "INSERT INTO tbl_product (id_product, Name, Price, Date, Category, Amount) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("ssssss", $id_product, $name, $price, $date, $category, $amount);
    $stmt->execute();
    $stmt->close();
    return $this->db->affected_rows > 0;
  }
 
  public function selectAllProduct($id_product) {
    $sql = "SELECT * FROM tbl_product WHERE id_product = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("i", $id_product);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_object();
    return $product;
}
public function getAllProducts() {
  $sql = "SELECT * FROM tbl_product";
  $stmt = $this->db->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  $products = array();
  while ($product = $result->fetch_object()) {
      $products[] = $product;
  }
  return $products;
}
 
public function getProductById($id_product) {
  $sql = "SELECT * FROM tbl_product WHERE id_product = ?";
  $stmt = $this->db->prepare($sql);
  $stmt->bind_param("i", $id_product);
  $stmt->execute();
  $result = $stmt->get_result();
  $product = $result->fetch_object();
  return $product;
}
 


public function removeProduct($id_product) {
  $sql = "DELETE FROM tbl_product WHERE id_product = ?";
  $stmt = $this->db->prepare($sql);
  $stmt->bind_param("i", $id_product);
  $stmt->execute();
  return $this->db->affected_rows >= 0;
}
public function updateProduct($id_product, $data){
    $name = $data['name'];
    $price = $data['price'];
    $Date = $data['date'];
    $category = $data['category'];
    $amount = $data['amount'];

    $sql = "UPDATE tbl_product SET
    Name = ?,
    Price = ?,
    Date = ?,
    Category = ?,
    Amount = ?
    WHERE id_product = ?";
    
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("sssssi", $name, $price, $Date, $category, $amount, $id_product);
    $stmt->execute();
    
    return $this->db->affected_rows >= 0;
}



public function __destruct() {
  $this->db->close();
}
}



?>