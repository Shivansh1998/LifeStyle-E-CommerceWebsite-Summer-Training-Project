<?php require 'common.php'; 
    if (!isset($_SESSION['email'])) {
        header('location: products.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cart | Life Style Store</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>

        <!-- Header -->
        <?php include 'header.php'; ?>
        <!--Header end-->

        <div id="content">
        <?php 
        $user_id=$_SESSION['id'];
        $query="Select item_id,price,name from users_items INNER JOIN items ON items.id=users_items.item_id WHERE user_id=$user_id  AND status='Added to cart'";
        $query_result=  mysqli_query($con, $query);
        if(mysqli_num_rows($query_result)<=0){ ?>
            <h3 class="bg-warning" style="text-align: center;">Add items to the cart first!</h3>
        <?php } else {?>
            <div class="row decor_bg">
                <div class="col-md-6 col-md-offset-3">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Item Number</th>
                                <th>Item Name</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                            
                            <?php $sum=0;$all_items="";
                            while($row = mysqli_fetch_array($query_result)){
                                $number=$row['item_id'];
                                $name=$row['name'];
                                $price=$row['price'];
                                $sum=$sum+$price;
                                $all_items=$all_items.$number.",";
                            ?>
                            <tr>
                                <td><?php echo $number; ?></td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $price; ?></td>
                                <td><a href="cart-remove.php?id=<?php echo $number; ?>" class="remove_item_link"> Remove</a></td>
                            </tr>
                            <?php } ?>

                        </thead>
                        <tbody>
                            <tr>
                                <td></td><td>Total</td><td>Rs <?php echo $sum; $sum=0; ?> </td>
                                <td><a href="success.php?id=<?php echo $all_items; ?>" class='btn btn-primary'>Confirm Order</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } ?>
        </div>
        
        <!--Footer-->
        <?php include 'footer.php'; ?>
        <!--Footer end-->

</html>
