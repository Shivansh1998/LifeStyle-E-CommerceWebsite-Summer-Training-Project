<?php
require 'common.php';

$email=$_POST['email'];
$regex_email="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
if (!preg_match($regex_email, $email)) {
  header('location: signup.php?email_error=enter correct email');
  exit('enter correct email');
}
$password=$_POST['password'];
if (strlen($password) < 6) {
  header('location: signup.php?password_error=enter correct password');
}

$email = mysqli_real_escape_string($con,$email);
$query= "SELECT id from users WHERE email='$email'";
$query_result=mysqli_query($con,$query) or die(mysqli_error($con));
$number= mysqli_num_rows($query_result);

if($number > 0){  
    header('location: signup.php?email_error=enter another email');
}  else {
    $name=mysqli_real_escape_string($con,$_POST['name']);
    $password=md5(mysqli_real_escape_string($con, $password));
    $contact=$_POST['contact'];
    $contact=mysqli_real_escape_string($con,$_POST['contact']);
    $city=$_POST['city'];
    $city=mysqli_real_escape_string($con,$_POST['city']);
    $address=$_POST['address'];
    $address=mysqli_real_escape_string($con,$_POST['address']);
    $insert_query= "INSERT INTO users (`name`, `email`, `password`, `contact`, `city`, `address`) VALUES ('$name' , '$email' , '$password' ,'$contact','$city','$address')";
    $insert_query_result=mysqli_query($con,$insert_query) or die(mysqli_error($con));
    echo "User successfully inserted";
    $_SESSION['id']=mysqli_insert_id($con);
    $_SESSION['email']=$email;    
}
if (isset($_SESSION['email'])) {
    header('location: products.php'); 
}
?>