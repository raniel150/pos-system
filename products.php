<?php
include("config/database.php");

$search = "";
$r = null;

if(isset($_GET['search'])){
    $search = $_GET['search'];
    
    // Use prepared statement for search
    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ?");
    $searchTerm = '%' . $search . '%';
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $r = $stmt->get_result();
} else {
    $r = $conn->query("SELECT * FROM products");
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">

<h2>Products</h2>

<form class="mb-3" method="GET">
<input class="form-control" name="search" placeholder="Search product" value="<?php echo htmlspecialchars($search); ?>">
</form>

<table class="table table-bordered">

<tr>
<th>ID</th>
<th>Name</th>
<th>Price</th>
<th>Stock</th>
<th>Status</th>
</tr>

<?php while($row=$r->fetch_assoc()){ ?>

<tr>

<td><?php echo htmlspecialchars($row['id']); ?></td>
<td><?php echo htmlspecialchars($row['name']); ?></td>
<td>₱<?php echo htmlspecialchars($row['price']); ?></td>
<td><?php echo htmlspecialchars($row['stock']); ?></td>

<td>

<?php
if($row['stock'] <= 5){
    echo "<span class='badge bg-danger'>LOW STOCK</span>";
} else {
    echo "<span class='badge bg-success'>OK</span>";
}
?>

</td>

</tr>

<?php } ?>

</table>

<a href="dashboard.php" class="btn btn-secondary">Back</a>

</div>
