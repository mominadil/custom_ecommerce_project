<?php 
session_start();
include "db.php";

$user_id = $_SESSION['user_id']; 
$first_name = $_POST['first_name']; 
$last_name = $_POST['last_name'];  
$city = $_POST['city']; 
$email = $_POST['email']; 
$address = $_POST['address']; 
$contact = $_POST['contact']; 
$quantity = $_POST['quantity'];
$amount=$_POST['amount'];
$payment_method=$_POST['payment_method'];


// $sql1 = "INSERT INTO `user_details` (`id`, `first_name`, `contact`, `address`, `user_id`, `last_name`, `email`, `company`, `city`, `payment_method`) VALUES (NULL, '$first_name', '$contact', '$address', '$user_id', '$last_name', '$email', '$company', '$city', '$payment_method')";

// mysqli_query($connect,$sql1);

$sql = " INSERT INTO order_details (total_price, usr_id, status, first_name,last_name,contact,email,address,payment_method)VALUES($amount, $user_id, 'pending','$first_name','$last_name','$contact','$email','$address','$payment_method')";
mysqli_query($connect,$sql);
$order_detail_id =  mysqli_insert_id($connect);

        $pid = "SELECT * FROM tbl_product INNER JOIN cart_item ON tbl_product.id = cart_item.product_id Where usr_id='$user_id' ";
        $result = mysqli_query($connect, $pid);
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                 $data = $row["product_id"]; 
                $sql2 = "INSERT INTO `order_items`(`usr_id`, `product_id`, `quantity`, `order_detail_id`) VALUES ('$user_id','$data','$quantity', '$order_detail_id')";
                // echo $sql2;
                mysqli_query($connect,$sql2);
            }
        }


        $_SESSION['order_detail_id'] = $order_detail_id;
if ($payment_method=='cashondelivery') {
    $sql3=mysqli_query($connect,"UPDATE order_details SET status ='processing' WHERE id  ='$order_detail_id'");
    echo "<script>alert('Thank you for ordering');
    window.location.href = 'index.php';
    </script>";
}
elseif ($payment_method=='razorpay') {
    // echo "<script>window.location.href = 'pay.php';</script>";
    header("location:pay.php");
}
 $_SESSION["amount"]=$amount;