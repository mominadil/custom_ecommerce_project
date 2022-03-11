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
                        <li> <a href="order.php" class="text-decoration-none d-flex align-items-start">
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
                        <li class="active"> <a href="#" class="text-decoration-none d-flex align-items-start">
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

                    <?php
                    $query=mysqli_query($connect,"SELECT * FROM users WHERE id='$user_id'");
                    $row=mysqli_fetch_assoc($query);
                    // print_r($row);
                ?>
                    Name:<br>
                    <form action="change_name.php" method="post">
                        <div class="d-flex">

                            <p class="w-100"><?php echo $row['username']; ?></p>
                            <button class="btn btn-success" type="submit">Edit</button>
                        </div>
                    </form>
                    <hr>
                    password:<br>
                    <form action="change_password.php" method="post">
                        <div class="d-flex">
                            <input type="password" readonly class="form-control-plaintext" value="<?php echo $row['password'] ?>">
                            <button type="submit" class="btn btn-success" href="#">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





    <?php include "footer.php" ?>
</body>

</html>