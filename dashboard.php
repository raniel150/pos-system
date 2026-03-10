
<?php
session_start();
if(!isset($_SESSION['user'])){
header("Location:index.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<nav class="navbar navbar-dark bg-dark">
<div class="container-fluid">
<span class="navbar-brand">Super Grocery POS</span>
<a href="logout.php" class="btn btn-danger">Logout</a>
</div>
</nav>

<div class="container mt-4">

<div class="row">

<div class="col-md-3">
<a href="products.php" class="btn btn-primary w-100">Products</a>
</div>

<div class="col-md-3">
<a href="add_product.php" class="btn btn-success w-100">Add Product</a>
</div>

<div class="col-md-3">
<a href="pos.php" class="btn btn-warning w-100">POS</a>
</div>

<div class="col-md-3">
<a href="sales.php" class="btn btn-info w-100">Sales</a>
</div>

</div>

</div>

</body>
</html>
