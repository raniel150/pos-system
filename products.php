
<?php
include("config/database.php");

$search="";

if(isset($_GET['search'])){
$search=$_GET['search'];
$r=mysqli_query($conn,"SELECT * FROM products WHERE name LIKE '%$search%'");
}else{
$r=mysqli_query($conn,"SELECT * FROM products");
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">

<h2>Products</h2>

<form class="mb-3">
<input class="form-control" name="search" placeholder="Search product">
</form>

<table class="table table-bordered">

<tr>
<th>ID</th>
<th>Name</th>
<th>Price</th>
<th>Stock</th>
<th>Status</th>
</tr>

<?php while($row=mysqli_fetch_assoc($r)){ ?>

<tr>

<td><?= $row['id'] ?></td>
<td><?= $row['name'] ?></td>
<td><?= $row['price'] ?></td>
<td><?= $row['stock'] ?></td>

<td>

<?php
if($row['stock']<=5){
echo "<span class='badge bg-danger'>LOW STOCK</span>";
}else{
echo "<span class='badge bg-success'>OK</span>";
}
?>

</td>

</tr>

<?php } ?>

</table>

<a href="dashboard.php" class="btn btn-secondary">Back</a>

</div>
