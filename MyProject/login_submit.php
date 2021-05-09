<?php require 'common.php'; 

if (isset($_SESSION['email'])) {
    header('location: products.php');
    exit;
}

$email=$_POST['email'];
$regex_email="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
if (!preg_match($regex_email, $email)) {
  header('location: login.php?email_error=Enter correct email');
  exit('enter correct email');
}
$email = mysqli_real_escape_string($con,$email);
$password=$_POST['password'];
if (strlen($password) < 6) {
  header('location: login.php?password_error=enter correct password');
  exit('enter correct password');
}
$password=md5(mysqli_real_escape_string($con, $password));

$query= "SELECT id from users WHERE email='$email' AND password='$password'";
$query_result=mysqli_query($con,$query) or die(mysqli_error($con));
if(mysqli_num_rows($query_result) <= 0){  
    header('location: login.php?email_error=Either email or password is incorrect');
    exit('Either email or password is incorrect');
}

$row=  mysqli_fetch_array($query_result);
$_SESSION['id']=$row['id'];
$_SESSION['email']=$email;

header('location: products.php');
?>