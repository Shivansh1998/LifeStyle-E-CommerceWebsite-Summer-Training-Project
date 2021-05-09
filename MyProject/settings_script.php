<?php require 'common.php'; 

if (!isset($_SESSION['email'])) {
    header('location: index.php'); 
    exit;
}

$user_id=$_SESSION['id'];
$old_password=$_POST['old-password'];
$new_password=$_POST['password'];
$password1=$_POST['password1'];

if (strlen($old_password) < 6) {
  header('location: settings.php?password_error=enter correct old password');
}else if (strlen($new_password) < 6) {
  header('location: settings.php?password_error=enter correct new password');
}else if (strlen($password1) < 6) {
  header('location: settings.php?password_error=enter correct confirm password');
}else if($new_password!=$password1){
    header('location: settings.php?password_error=Confirm password is not same as New Password');
}else{
    $old_password=md5(mysqli_real_escape_string($con, $old_password));
    $new_password=md5(mysqli_real_escape_string($con, $new_password));

    $query="SELECT password from users WHERE id=$user_id";
    $query_result = mysqli_fetch_array(mysqli_query($con, $query));
    $password=$query_result[0];

    if( $password==$old_password ){
        $query="UPDATE users SET password='$new_password' WHERE id=$user_id ";
        $query_result=  mysqli_query($con, $query);
        header('location: products.php');
    }else {
        header('location: settings.php?password_error=incorrect password');
    }
}
?>