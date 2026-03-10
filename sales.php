<?php
include("config/database.php");

$r = $conn->query("
SELECT sales.id, products.name, sales.qty, sales.total, sales.date
FROM sales
JOIN products ON products.id = sales.product_id
ORDER BY sales.date DESC
");
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">

<h2>Sales Report</h2>

<table class="table table-bordered">

<tr>
<th>ID</th>
<th>Product</th>
<th>Qty</th>
<th>Total</th>
<th>Date</th>
</tr>

<?php while($row = $r->fetch_assoc()){ ?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo htmlspecialchars($row['name']); ?></td>
<td><?php echo $row['qty']; ?></td>
<td>₱<?php echo $row['total']; ?></td>
<td><?php echo $row['date']; ?></td>
</tr>

<?php } ?>

</table>

<a href="dashboard.php" class="btn btn-secondary">Back</a>

</div>
