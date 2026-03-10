<?php
include("config/database.php");

if(isset($_POST['add'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    
    // Use prepared statement
    $stmt = $conn->prepare("INSERT INTO products(name, price, stock) VALUES (?, ?, ?)");
    $stmt->bind_param("sdi", $name, $price, $stock);
    
    if($stmt->execute()){
        echo "<div class='alert alert-success'>Product Added Successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }
    $stmt->close();
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">

<h2>Add Product</h2>

<form method="POST">

<input class="form-control mb-2" name="name" placeholder="Product name" required>

<input class="form-control mb-2" name="price" placeholder="Price" type="number" step="0.01" required>

<input class="form-control mb-2" name="stock" placeholder="Stock" type="number" required>

<button class="btn btn-success" name="add">Add</button>

</form>

<a href="dashboard.php" class="btn btn-secondary mt-2">Back</a>

</div>
