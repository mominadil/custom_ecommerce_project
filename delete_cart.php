<?php

include ('db.php'); // Using database connection file here

$id = $_POST['product_id']; // get id through query string

$del = mysqli_query($connect,"delete from cart_item where product_id = '$id'"); // delete query

if($del)
{
    
    echo "deleted";	
}
else
{
    echo "Error"; // display error message //if not delete
}
?>