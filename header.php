<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<!-- icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Zilla+Slab&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

<link rel="stylesheet" href="css/headerstyle.css">
<link rel="stylesheet" href="css/footerstyle.css">
<?php 
// session_start();
$user_id=$_SESSION['user_id'];
include 'db.php';
?>
<header>
    <div class="container-header">
        <nav class="navbar navbar-expand-lg navbar-light ">
            <div class="container-fluid">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="shoppage.php">SHOP</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">ABOUT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">CONTACT</a>
                        </li>
                    </ul>
                    <a class="navbar-brand" style="margin-right: 22%;font-size: 28px;" href="#">canvas</a>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <a href="#"><i class="fa fa-search" style="font-size:30px;margin-right: 25px;"></i></a>
                        <a href="cart.php"><i class="fa fa-shopping-cart" style="font-size:30px;margin-right:25px"
                                title="cart"></i>
                            <span class="cart-basket d-flex align-items-center justify-content-center">
                                <?php 
                                    $row=mysqli_query($connect, "SELECT * FROM cart_item WHERE usr_id = $user_id");
                                    $count=mysqli_num_rows($row);
                                ?>
                            <?php echo $count ?></span></a>

                    </form>
                    <?php if(isset($_SESSION['login'])){ ?>
                    <a href="order.php"> <i class="fa fa-user" style="font-size:30px;color:#0d6efd;"
                            title="orders"></i></a>
                    <h1 class="log"><a href="logout.php">logout</a></h1>
                    <?php }else{ ?>
                    <h1 class="log"><a href="login.php">login</a></h1>
                    <?php } ?>

                </div>
            </div>
        </nav>
        <a class="navba" style="margin-right: 8%;font-size: 28px;" href="#">canvas</a>
    </div>

</header>