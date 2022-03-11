<?php 
session_start();


if(!isset($_SESSION["login"]))

  header("location:login.php");
include "db.php";
$user_id = $_SESSION['user_id']; 
$user_name = $_SESSION['user_name']; 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/order.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://cdn.lineicons.com/3.0/lineicons.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="Admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="Admin/dist/css/adminlte.min.css"> -->
    <link rel="stylesheet" href="css/checkout.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;900&family=Zilla+Slab:ital@1&display=swap"
        rel="stylesheet">
    <title>Orders</title>
</head>

<body>
    <?php include "header.php" ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-3 my-lg-0 my-md-1">
                <div id="sidebar" class="bg-purple">
                    <div class="h4 text-white">Account</div>
                    <ul>
                        <li class="active"> <a href="#" class="text-decoration-none d-flex align-items-start">
                                <div class="fas fa-box pt-2 me-3"></div>
                                <div class="d-flex flex-column">
                                    <div class="link">My Account</div>
                                    <div class="link-desc">View & Manage orders and returns</div>
                                </div>
                            </a> </li>
                        <li> <a href="#" class="text-decoration-none d-flex align-items-start">
                                <div class="fas fa-box-open pt-2 me-3"></div>
                                <div class="d-flex flex-column">
                                    <div class="link">My Orders</div>
                                    <div class="link-desc">View & Manage orders and returns</div>
                                </div>
                            </a> </li>
                        <li> <a href="#" class="text-decoration-none d-flex align-items-start">
                                <div class="far fa-address-book pt-2 me-3"></div>
                                <div class="d-flex flex-column">
                                    <div class="link">Address Book</div>
                                    <div class="link-desc">View & Manage Addresses</div>
                                </div>
                            </a> </li>
                        <li> <a href="profile.php" class="text-decoration-none d-flex align-items-start">
                                <div class="far fa-user pt-2 me-3"></div>
                                <div class="d-flex flex-column">
                                    <div class="link">My Profile</div>
                                    <div class="link-desc">Change your profile details & password</div>
                                </div>
                            </a> </li>
                        <li> <a href="#" class="text-decoration-none d-flex align-items-start">
                                <div class="fas fa-headset pt-2 me-3"></div>
                                <div class="d-flex flex-column">
                                    <div class="link">Help & Support</div>
                                    <div class="link-desc">Contact Us for help and support</div>
                                </div>
                            </a> </li> 
                    </ul>
                </div>
            </div>


            <div class="col-lg-9 my-lg-0 my-1">
                <div id="main-content" class="bg-white border">
                    <div class="d-flex flex-column">
                        <div class="h5">Hello <?php echo $user_name; ?>,</div>
                        <div>Logged in as: <?php echo $user_name; ?> </div>
                    </div>
                    

                    <div class="d-flex my-4 flex-wrap">
                        <div class="box me-4 my-1 bg-light"> <img
                                src="https://www.freepnglogos.com/uploads/box-png/cardboard-box-brown-vector-graphic-pixabay-2.png"
                                alt="">
                            <?php $order_count=mysqli_query($connect,"SELECT * FROM order_details WHERE usr_id='$user_id'");
                                $count=mysqli_num_rows($order_count);
                                
                                ?>
                            <div class="d-flex align-items-center mt-2">
                                <div class="tag">Orders placed</div>
                                <div class="ms-auto number"><?php  $count>0 ? print_r($count) :  print_r("0"); ?></div>
                            </div>
                        </div>
                        <div class="box me-4 my-1 bg-light"> <img
                                src="https://www.freepnglogos.com/uploads/shopping-cart-png/shopping-cart-campus-recreation-university-nebraska-lincoln-30.png"
                                alt="">
                            <?php $cart_count=mysqli_query($connect,"SELECT * FROM cart_item WHERE usr_id='$user_id'");
                                $count=mysqli_num_rows($cart_count);
                                
                                ?>
                            <div class="d-flex align-items-center mt-2">
                                <div class="tag">Items in Cart</div>
                                <div class="ms-auto number"><?php $count>0 ? print_r($count) :  print_r("0"); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="text-uppercase">My recent orders</div>
                    <?php

                        $verify_user="SELECT * FROM order_details WHERE usr_id =  '$user_id'";
                        $verify_result=mysqli_query($connect,$verify_user);

                        if (mysqli_num_rows($verify_result)>0) {

                        $query = "SELECT * FROM order_details WHERE order_details.usr_id =  '$user_id' ";
                        $result = mysqli_query($connect, $query);
                        if(mysqli_num_rows($result) > 0)
                        {
                        while($row = mysqli_fetch_array($result))
                        {
                           
                    ?>
                    <div class="order my-3 bg-light">
                        <div class="row"><?php
                            
                            
                            
                        ?>
                            <div class="col-lg-4">
                                <div class="d-flex flex-column justify-content-between order-summary">
                                    <div class="d-flex align-items-center">
                                        <div class="text-uppercase">Order #<?php echo $row['0'] ?></div>
                                       <?php
                                           if($row['payment_method']=="razorpay"){
                                               ?>
                                           <div class="blue-label ms-auto text-uppercase">paid</div>
                                           <?php
                                           }
                                           else {?>
                                            <div class="green-label ms-auto text-uppercase">cod</div>
                                               
                                           <?php } ?>
                                    </div>
                                   <?php
                                       $product=mysqli_query($connect, "SELECT * FROM tbl_product INNER JOIN order_items ON tbl_product.id=order_items.product_id WHERE order_items.usr_id =  '$user_id' ");
                                       $pro = mysqli_fetch_array($product);
                                   ?>
                                    <div class="fs-8">Product <?php echo $pro['product_id'] ?></div>
                                    <div class="fs-8"><?php echo date($row['created_at']) ?></div>
                                    <div class="rating d-flex align-items-center pt-1"> <img
                                            src="https://www.freepnglogos.com/uploads/like-png/like-png-hand-thumb-sign-vector-graphic-pixabay-39.png"
                                            alt=""><span class="px-2">Rating:</span> <span class="fas fa-star"></span>
                                        <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span
                                            class="fas fa-star"></span> <span class="far fa-star"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="d-sm-flex align-items-sm-start justify-content-sm-between">
                                    <div class="status">Status : <?php echo $row['status'] ?></div>
                                    <div class="total">Total :  ₹<?php echo $row['total_price'] ?></div>
                                    <a href="order_info.php?id=<?php echo $row['0'] ?>"><div class="btn btn-primary text-uppercase">order info</div></a>
                                </div>
                                <div class="progressbar-track">
                                    <ul class="progressbar">
                                        <li id="step-1" class="text-muted green"> <span class="fas fa-gift"></span>
                                        </li>
                                        <li id="step-2" class="text-muted green"> <span class="fas fa-check"></span>
                                        </li>
                                        <li id="step-3" class="text-muted green"> <span class="fas fa-box"></span> </li>
                                        <li id="step-4" class="text-muted green"> <span class="fas fa-truck"></span>
                                        </li>
                                        <li id="step-5" class="text-muted green"> <span class="fas fa-box-open"></span>
                                        </li>
                                    </ul>
                                    <div id="tracker"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                                }
                            }
                            else {
                                print_r("0");
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>





    <?php include "footer.php" ?>
</body>

</html>