
<?php
include("config/database.php");

if(isset($_POST['sell'])){

$product=$_POST['product'];
$qty=$_POST['qty'];

$r=mysqli_query($conn,"SELECT * FROM products WHERE id='$product'");
$data=mysqli_fetch_assoc($r);

$total=$data['price']*$qty;

mysqli_query($conn,"INSERT INTO sales(product_id,qty,total)
VALUES('$product','$qty','$total')");

mysqli_query($conn,"UPDATE products SET stock=stock-$qty WHERE id='$product'");

echo "<div class='alert alert-success'>Sale Completed</div>";
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">

<h2>Point Of Sale</h2>

<form method="POST">

<select class="form-control mb-2" name="product">

<?php
$p=mysqli_query($conn,"SELECT * FROM products");
while($row=mysqli_fetch_assoc($p)){
?>

<option value="<?= $row['id']?>">
<?= $row['name']?> - ₱<?= $row['price']?> (Stock: <?= $row['stock']?>)
</option>

<?php } ?>

</select>

<input class="form-control mb-2" name="qty" placeholder="Quantity">

<button class="btn btn-primary" name="sell">Sell</button>

</form>

<a href="dashboard.php" class="btn btn-secondary mt-2">Back</a>

</div>
