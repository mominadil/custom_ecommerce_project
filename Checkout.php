<!DOCTYPE html>
<html lang="en">
<?php session_start();


if(!isset($_SESSION["login"]))

  header("location:login.php");
  include "db.php";
$user_id = $_SESSION['user_id']; 
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Blank Page</title>

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
</head>

<body>
    <?php include "header.php";?>
    <section class="main">
        <div class="container-1">
            <h4 class="page-heading ">CheckOut</h4>
        </div>
        <div class="desktop main-column p-5">
            <div class="column-1">
                <div class="login-box col-md-6">
                    <p>Returning customer?<a href="http://" target="_blank" rel="noopener noreferrer">Click here to
                            login</a></p>
                </div>
                <div class="coupon-box col-md-6">
                    <p>Have a coupon?<a href="http://" target="_blank" rel="noopener noreferrer"> Click here to enter
                            your </a></p>
                </div>
            </div>
            <div class="column-2">
                <div class="billing-section">
                    <div class="billing-details">
                        <h4 class="billing-title">
                            Billing Address
                        </h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde, vel odio non dicta provident
                            sint ex autem mollitia dolorem illum repellat ipsum aliquid illo similique sapiente fugiat
                            minus ratione.</p>
                        <form class="billing-form" action="orderaction.php" method="post">
                            <div class="name form-group">
                                <div class="first-name col-md-6">
                                    <label for="billing-form-fname">First Name:</label><br>
                                    <input type="text" class="sm-form-control" name="first_name">
                                </div>
                                <div class="form-group last-name col-md-6">
                                    <label for="billing-form-lname">Last Name:</label><br>
                                    <input type="text" class="sm-form-control" name="last_name">
                                </div>
                            </div>
                            
                            <div class="billing-address form-group">
                                <label for="billing-form-address">Address</label><br>
                                <input type="text" class="sm-form-control" name="address">
                            </div>
                            <div class="city form-group">
                                <label for="billing-form-city-name">City / Town:</label><br>
                                <input type="text" class="sm-form-control" name="city">
                            </div>
                            <div class="email form-group">
                                <label for="billing-form-email">Email:</label><br>
                                <input type="email" class="sm-form-control" name="email">
                            </div>
                            <div class="last-phone form-group">
                                <label for="billing-form-phone">Phone:</label><br>
                                <input type="number" class="sm-form-control" name="contact">
                            </div>

                    </div>
                </div>
                <div class="order-details">
                    <div class="order-product">
                        <h4 class="order-details-title">Your Orders</h4>
                        <div class="table-responsive">
                            <table class="table cart">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                        $verify_user="SELECT * FROM cart_item WHERE usr_id =  '$user_id'";
                                        $verify_result=mysqli_query($connect,$verify_user);

                                        if (mysqli_num_rows($verify_result)>0) {

                                        $query = "SELECT * FROM tbl_product INNER JOIN cart_item ON tbl_product.id = cart_item.product_id WHERE cart_item.usr_id =  '$user_id' ";
                                        $result = mysqli_query($connect, $query);
                                        if(mysqli_num_rows($result) > 0)
                                        {
                                        while($row = mysqli_fetch_array($result))
                                        {
                                    ?>
                                    <tr>
                                        <td scope="row"><img src="Admin/images/<?php echo $row['image'] ?>" width="64"
                                                height="64" alt="" srcset=""></td>
                                        <td class="cart-product-name"><?php
                                            echo $row['name'];
                                            
                                        ?></td>
                                        <td class="cart-product-quantity"><?php echo $row['quantity']; ?></td>

                                        <td class="cart-product-subtotal"><?php echo $row['price']*$row['quantity']; ?>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php 
                                

                                $count = mysqli_query($connect, "SELECT * FROM tbl_product INNER JOIN cart_item ON tbl_product.id = cart_item.product_id WHERE  usr_id='$user_id'  ");
                                $total = 0;
                                while($row = mysqli_fetch_assoc($count)) {
                                $total = $total + ($row["quantity"] * $row["price"]);
                                }
                            }?>

                    </div>
                    <div class="order-total">
                        <div class="cart-total">
                            <h4 class="cart-total-title">Cart Totals</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table cart">
                                <tbody>
                                    <tr>
                                        <td class="cart-product-name title"><strong class="product-name ">Cart
                                                Subtotal</strong>
                                        </td>
                                        <td class="cart-product-name">
                                            <span class="cart-subtotal price">₹<?php echo $total ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart-product-name title"><strong>Shipping</strong></td>
                                        <td class="cart-product-name"><span class="delivery"><span>Free
                                                    Delivery</span></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart-product-name title"><strong>Total</strong></td>
                                        <td class="cart-product-name"><span
                                                class="total-price">₹<?php echo $total ?></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="payment-options">

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" value="cashondelivery" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Cash on Delivery
                            </label>
                            <p></p>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" value="razorpay" id="flexRadioDefault2"
                                checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Razorpay
                            </label>
                            <p>
                                Debit Card/ Credit Card / Netbanking / Cash Card / Mobile Payment / UPI </p>
                        </div>
                    </div>
                    <?php
                        $query1 = "SELECT * FROM cart_item WHERE cart_item.usr_id =  '$user_id' ";
                       $result1 = mysqli_query($connect, $query1);
                       while($row1 = mysqli_fetch_array($result1)){
                        
                       
                    ?>
                    <!-- <form action="orderaction.php" method="POST"> -->
                    <input type="hidden" name="amount" value="<?php echo $total; ?>">

                    <input type="hidden" name="product_id" value="<?php echo $row1['product_id']; ?>">

                    <input type="hidden" name="quantity" value="<?php echo $row1['quantity']; ?>">
                    <?php
                       }
                       ?>
                    <button class="checkout-btn" type="submit">Place order</button>
                </div>
            </div>
            </form>


        </div>
        
    </section>





    <?php include "footer.php";?>
    <!-- jQuery -->
    <script src="Admin/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="Admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="Admin/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="Admin/dist/js/demo.js"></script>
</body>

</html>