<?php 
session_start();


if(!isset($_SESSION["login"]))

  header("location:login.php");

include "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoppingcart</title>
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
<?php include "header.php"; ?> 
<div class="slider-home">
        <div class="slider-home">
            <img src="capture.JPG"  alt="">
        </div>
</div>
<div class="sec2">
        <div class="category-sec">
            <h2 class="cat-top">Shop by Category</h2>
        </div>

    <div class="cat-flex">

        <?php
                include "db.php";
                    $query = "SELECT * FROM category ORDER BY id ASC";
                    $result = mysqli_query($connect, $query);
                    if(mysqli_num_rows($result) > 0)
                    {
                        while($row = mysqli_fetch_array($result))
                        {
                    ?>


        <div class="card_category">                        
                <div class="card" >
                    <img  src="Admin/images/<?php echo $row["image"]; ?>" style="height: -webkit-fill-available;" alt="Card image cap">
                    <div class="card-body-c" style="width: 30%;">
                    <h5 class="card-name"><?php echo $row["name"]; ?></h5>
                    </div>
                </div>
        </div>
        <?php
					}
				}
			?>
        
    </div>


</div>

<?php include "footer.php"; ?>    
    
</body>
</html>