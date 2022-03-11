<?php session_start();


if(!isset($_SESSION["login"]))

  header("location:login.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
    <link rel="stylesheet" href="css/cart.css">
</head>

<body id="load">
    <?php include "header.php"; ?>
    <section class="body_headcart">
        <div class="containercart">
            <h1>CART</h1>
        </div>
    </section>
    <div class="tablecart">

        <div class="carttable">
            <table class="table">
                <thead>
                    <tr class="border-cart">
                        <th scope="col" style="width: 30%"></th>
                        <th scope="col" style="width: 30%">Product</th>
                        <th class="unit" scope="col" style="width: 15%">Unit Price</th>
                        <th scope="col" style="width: 15%">Quantity</th>
                        <th scope="col" style="width: 20%">Total</th>
                    </tr>
                </thead>
                <?php 
                    include "db.php";
                    $user_id = $_SESSION['user_id']; 

                    $verify_user="SELECT * FROM cart_item WHERE usr_id =  '$user_id'";
                    $verify_result=mysqli_query($connect,$verify_user);
                  
                   if (mysqli_num_rows($verify_result)>0) {

                       $query = "SELECT * FROM tbl_product INNER JOIN cart_item ON tbl_product.id = cart_item.product_id WHERE cart_item.usr_id =  '$user_id' ";
                       $result = mysqli_query($connect, $query);
                           if(mysqli_num_rows($result) > 0)
                           {
                           while($row = mysqli_fetch_array($result))
                           {?>


                <tbody>
                    <tr id="delete<?php echo $row['product_id']; ?>">
                        <td style="border-style: none">
                            <a href='javascript:void(0);' onclick="return del(<?php echo $row['product_id']; ?>)"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash" viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                    <path fill-rule="evenodd"
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                </svg></a>
                            <img class="cartimg" src="Admin/images/<?php echo $row["image"]; ?>" alt="n">
                        </td>
                        <td style="border-style: none" class="cent-cart"><?php echo $row['name']; ?></td>
                        <td style="border-style: none" class="unit cent-cart"><?php echo $row['price']; ?></td>
                        <td style="border-style: none" class="cent-cart"><?php echo $row['quantity']; ?></td>
                        <td style="border-style: none" class="cent-cart">
                            ₹<?php echo $row["quantity"] * $row["price"]; ?></td>
                    </tr>




                </tbody>
                <?php 
                    }
                  }
                  }
                  $count = mysqli_query($connect, "SELECT * FROM tbl_product INNER JOIN cart_item ON tbl_product.id = cart_item.product_id WHERE usr_id = '$user_id'");
                  $total = 0;
                  while($row = mysqli_fetch_assoc($count)) {
                    $total = $total + ($row["quantity"] * $row["price"]);
                  }
                ?>
            </table>
            <div class="coupon-sec">
                <div class="col-cust">
                    <input type="text" value="" class="coupon" placeholder="Enter Coupon Code..">
                </div>
                <div class="coupon-btn">
                    <a href="#" class="coupon-text">Apply Coupon</a>
                </div>
                <div class="checkoutcart">
                    <form action="checkout.php" method="POST">
                        <input type="hidden" name="amount" value="<?php echo $total; ?>">
                        <input type="submit" name="buynow" class="btn" value="Proceed to Checkout">
                    </form>


                </div>
            </div>




        </div>
    </div>

    <div class="total-cart">
        <h2>Cart Totals</h2>

        <table class="table" style="width:60%">
            <tbody>
                <tr>
                    <th scope="row">Cart Subtotal</th>
                    <td>₹<?php echo $total ?></td>
                </tr>
                <tr>
                    <th scope="row">Shipping</th>
                    <td>Free Delivery</td>

                </tr>
                <tr>
                    <th scope="row">Total</th>
                    <td colspan="2">₹<?php echo $total ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <script>
    function del(product_id) {
        if (confirm('Are you sure to delete?')) {
            $.ajax({
                type: 'POST',
                url: 'delete_cart.php',
                data: {
                    product_id: product_id
                },
                success: function(res) {
                    if (res == "deleted") {
                        alert("Product deleted from cart");
                        $('#delete' + product_id).hide('slow');
                        $('#load').load('cart.php');
                    } else if (res == "Error") {
                        alert("Please try again");
                    }
                },
            });

        }

    }
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <?php include "footer.php"; ?>
</body>

</html>