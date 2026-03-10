<?php
include("config/database.php");

if(isset($_POST['sell'])){
    $product = $_POST['product'];
    $qty = $_POST['qty'];
    
    // Get product price using prepared statement
    $stmt = $conn->prepare("SELECT price FROM products WHERE id = ?");
    $stmt->bind_param("i", $product);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();
    
    if($data){
        $total = $data['price'] * $qty;
        
        // Insert sale using prepared statement
        $stmt = $conn->prepare("INSERT INTO sales(product_id, qty, total) VALUES (?, ?, ?)");
        $stmt->bind_param("idi", $product, $qty, $total);
        $stmt->execute();
        $stmt->close();
        
        // Update stock using prepared statement
        $stmt = $conn->prepare("UPDATE products SET stock = stock - ? WHERE id = ?");
        $stmt->bind_param("ii", $qty, $product);
        $stmt->execute();
        $stmt->close();
        
        echo "<div class='alert alert-success'>Sale Completed</div>";
    }
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">

<h2>Point Of Sale</h2>

<form method="POST">

<select class="form-control mb-2" name="product" required>
<option value="">Select Product</option>

<?php
$p = $conn->query("SELECT id, name, price, stock FROM products");
while($row = $p->fetch_assoc()){
?>

<option value="<?php echo $row['id']; ?>">
<?php echo htmlspecialchars($row['name']); ?> - ₱<?php echo $row['price']; ?> (Stock: <?php echo $row['stock']; ?>)
</option>

<?php } ?>

</select>

<input class="form-control mb-2" name="qty" placeholder="Quantity" type="number" required>

<button class="btn btn-primary" name="sell">Sell</button>

</form>

<a href="dashboard.php" class="btn btn-secondary mt-2">Back</a>

</div>
