<!DOCTYPE html>
<html lang="en">
<?php
    session_start();

    $pro_id=$_GET['id'];
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Blank Page</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zilla+Slab:ital@1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.lineicons.com/3.0/lineicons.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="Admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="Admin/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="css/single_page.css">
</head>

<body>
    <?php include "header.php";?>


    <?php
        include ('Admin/db.php');
        $query = "SELECT * FROM tbl_product WHERE id ='$pro_id'";
        $result = mysqli_query($connect, $query);
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            // print_r($row);
        {
    ?>
    <section class="container-1">
        <div class="container-2">
            <form method="POST" action="action_cart.php">
                <input type="hidden" name="product_id" value="<?php echo $row["id"]; ?>" />
                <input type="hidden" name="user_id" value="<?php echo $row["id"]; ?>" />
                <div class="product-details container">
                    <img src="Admin/images/<?php echo $row['image'] ?>" alt="" srcset="">
                    <div class="product-info content-sticky">
                        <h3 class="product-name">
                            <?php echo $row['name'];?> </h3>
                        <h3 class="product-price">₹ <?php echo $row['price'] ?></h3>
                        <div class="qty">
                            <div class="quantity">
                                <div class="decrease" id="decrease" onclick="decreaseValue()" value="Decrease Value">-
                                </div>
                                <input class="number" type="number" id="number" value="1" max="3" min="1"
                                    name="quantity" />
                                <div class="increase" id="increase" onclick="increaseValue()" value="Increase Value">+
                                </div>
                            </div>
                            <button>

                                <div class="addtocart btn" name="add_to_cart" type="submit">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <a>Add To Cart</a>
                                </div>
                            </button>
                        </div>
            </form>
            <div class="qty-status">
                ONLY <?php echo $row['quantity'] ?> STOCKS AVAILABLE
            </div>
            <hr class="line">
            <div class="product-description" id="accordion">
                <div class="qv-toggle">
                    <a href="#" class="toggle collapsed" data-bs-toggle="collapse" data-bs-target="#overview"
                        aria-expanded="false" aria-controls="overview">
                        Overview
                        <i class="lni lni-minus "></i>
                        <i class="lni lni-plus"></i>
                    </a>
                </div>
                <div class="collapse col" id="overview">

                    <span class="descrition-text op-6 fw-normal my-2">Libero velit id eaque ex quae laboriosam nulla
                        optio
                        doloribus!
                        Perspiciatis, libero, neque, perferendis at nisi optio dolor. Uniquely extend
                        diverse
                        meta-services without low-risk high-yield paradigms. Synergistically envisioneer
                        equity
                        invested e-services for innovative technology. Objectively generate.</span>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
    <?php
        }
        }
    ?>
    <?php include "footer.php";?>














    <script>
    function increaseValue() {
        var value = parseInt(document.getElementById('number').value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        document.getElementById('number').value = value;
    }

    function decreaseValue() {
        var value = parseInt(document.getElementById('number').value, 10);
        value = isNaN(value) ? 0 : value;
        value < 1 ? value = 1 : '';
        value--;
        document.getElementById('number').value = value;
    }
    </script>
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