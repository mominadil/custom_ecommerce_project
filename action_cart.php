<?php 
session_start();
include "db.php";

$user_id = $_SESSION['user_id']; 
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];
$userdate=$_POST['date'];
$interval=$_POST['interval'];
// echo 'a';

$newDate = strtotime(date("".$userdate."00:00:00") );
if(isset($_POST['add_to_cart'])){
 $sql = " INSERT INTO cart_item (product_id, quantity, usr_id,subscribed)VALUES($product_id, $quantity, $user_id,'0')";
 mysqli_query($connect,$sql);

 echo "<script>alert('product added to cart');</script>";
 header("location:cart.php");

}
elseif (isset($_POST['subscribe'])) {
    $sql = " INSERT INTO cart_item (product_id, quantity, usr_id,subscribed,subscription_startat,interval_period)VALUES($product_id, $quantity, $user_id,'1',$newDate,$interval)";
    mysqli_query($connect,$sql);
    echo "<script>alert('product added to cart');</script>";
    header("location:cart.php");

}

?>