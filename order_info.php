<!DOCTYPE html>
<html lang="en">
<?php 
session_start();


if(!isset($_SESSION["login"]))

  header("location:login.php");
include "db.php";
$user_id = $_SESSION['user_id']; 
$user_name = $_SESSION['user_name']; 
$order_detail_id=$_GET['id'];
// echo $order_detail_id;
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/order_info.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://cdn.lineicons.com/3.0/lineicons.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="Admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="Admin/dist/css/adminlte.min.css"> -->
    <link rel="stylesheet" href="css/checkout.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;900&family=Zilla+Slab:ital@1&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="css/order_info.css">
    <title>Document</title>
</head>

<body>
    <?php include "header.php"; ?>
    <div class="container my-5  justify-content-center">
        <div class="container card-1">
            <div class="card-header bg-white">
                <div class="media flex-sm-row flex-column-reverse justify-content-between ">
                    <div class="col my-auto">
                        <h4 class="mb-0">Thanks for your Order,<span class="change-color"><?php echo $user_name ?></span> !</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-between mb-3">
                    <div class="col-auto">
                        <h6 class="color-1 mb-0 change-color">Receipt</h6>
                    </div>
                    <div class="col-auto "> <small><a href="invoice.php?id=<?php echo $order_detail_id;  ?>">Receipt Voucher : <?php echo $order_detail_id;  ?></a></small> </div>
                </div>
                <?php

                        $verify_user="SELECT * FROM order_items WHERE usr_id =  '$user_id'";
                        $verify_result=mysqli_query($connect,$verify_user);

                        if (mysqli_num_rows($verify_result)>0) {

                        $query = "SELECT * FROM order_items WHERE order_items.order_detail_id =  '$order_detail_id' ";
                        $result = mysqli_query($connect, $query);
                        if(mysqli_num_rows($result) > 0)
                        {
                        while($row = mysqli_fetch_array($result))
                        {
                            
                            $order_item_id=$row['id'];
                            
                            $product=mysqli_query($connect, "SELECT * FROM tbl_product INNER JOIN order_items ON tbl_product.id=order_items.product_id WHERE order_items.id =  '$order_item_id' ");
                            $pro = mysqli_fetch_array($product);
                            // print_r($pro);   
                    ?>
                <div class="row">
                    <div class="col">
                        <div class="card card-2">
                            <div class="card-body">
                                <div class="media">
                                    <div class="sq align-self-center "> <img
                                            class="img-fluid my-auto align-self-center mr-2 mr-md-4 pl-0 p-0 m-0"
                                            src="Admin/images/<?php echo $pro['image'] ?>" width="135" height="135" /> </div>
                                    <div class="media-body my-auto text-right">
                                        <div class="row my-auto flex-column flex-md-row">
                                            <div class="col my-auto">
                                                <a href="single_page.php?id=<?php echo $pro['0'] ?>"><h6 class="mb-0 pro_name" title="product name"> <?php echo $pro['name'] ?></h6></a>
                                            </div>
                                            <div class="col-auto my-auto" title="category name"> <small><?php echo $pro['category_name'] ?> </small></div>
                                            <!-- <div class="col my-auto"> <small>Size : M</small></div> -->
                                            <div class="col my-auto"> <small>Qty : <?php echo $pro['quantity'] ?></small></div>
                                            <div class="col my-auto">
                                                <h6 class="mb-0">&#8377;<?php echo $pro['price'] ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-3 ">
                                <div class="row">
                                    <div class="col-md-3 mb-3"> <small> Track Order <span><i class=" ml-2 fa fa-refresh"
                                                    aria-hidden="true"></i></span></small> </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                        }
                    }
                    $count=mysqli_query($connect, "SELECT * FROM tbl_product INNER JOIN order_items ON tbl_product.id=order_items.product_id WHERE order_items.order_detail_id =  '$order_detail_id' ");
                    $total = 0;
                                while($row = mysqli_fetch_assoc($count)) {
                                $total = $total + ($row["quantity"] * $row["price"]);
                                }
                                
                }
                
               ?>
                <div class="row mt-4">
                    <div class="col">
                        <div class="row justify-content-between">
                            <div class="col-auto">
                                <p class="mb-1 text-dark"><b>Order Details</b></p>
                            </div>
                            <?php   ?>
                            <div class="flex-sm-col text-right col">
                                <p class="mb-1"><b>Total</b></p>
                            </div>
                            <div class="flex-sm-col col-auto">
                                <p class="mb-1">&#8377;<?php echo $total ?></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <?php include "footer.php" ?>
</body>

</html>