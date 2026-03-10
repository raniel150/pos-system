
<?php
include("config/database.php");

if(isset($_POST['add'])){

$name=$_POST['name'];
$price=$_POST['price'];
$stock=$_POST['stock'];

mysqli_query($conn,"INSERT INTO products(name,price,stock)
VALUES('$name','$price','$stock')");

echo "Product Added";
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">

<h2>Add Product</h2>

<form method="POST">

<input class="form-control mb-2" name="name" placeholder="Product name">

<input class="form-control mb-2" name="price" placeholder="Price">

<input class="form-control mb-2" name="stock" placeholder="Stock">

<button class="btn btn-success" name="add">Add</button>

</form>

<a href="dashboard.php" class="btn btn-secondary mt-2">Back</a>

</div>
