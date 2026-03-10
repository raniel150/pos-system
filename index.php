<?php
session_start();
include("config/database.php");

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0){
        $_SESSION['user'] = $username;
        header("Location: dashboard.php");
    } else {
        $msg = "Invalid Login";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Super Grocery POS</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">

<div class="container">
<div class="row justify-content-center mt-5">
<div class="col-md-4 bg-white p-4 rounded">

<h3 class="text-center">Grocery POS Login</h3>

<?php if(isset($msg)) echo "<div class='alert alert-danger'>$msg</div>"; ?>

<form method="POST">

<input class="form-control mb-2" name="username" placeholder="Username" required>

<input class="form-control mb-2" type="password" name="password" placeholder="Password" required>

<button class="btn btn-primary w-100" name="login">Login</button>

</form>

</div>
</div>
</div>

</body>
</html>
