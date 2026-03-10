
<?php
session_start();
include("config/database.php");

if(isset($_POST['login'])){
$user=$_POST['username'];
$pass=$_POST['password'];

$q=mysqli_query($conn,"SELECT * FROM users WHERE username='$user' AND password='$pass'");

if(mysqli_num_rows($q)>0){
$_SESSION['user']=$user;
header("Location: dashboard.php");
}else{
$msg="Invalid Login";
}
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

<input class="form-control mb-2" name="username" placeholder="Username">

<input class="form-control mb-2" type="password" name="password" placeholder="Password">

<button class="btn btn-primary w-100" name="login">Login</button>

</form>

</div>
</div>
</div>

</body>
</html>
