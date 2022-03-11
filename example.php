<div class="card">
                    <?php
                    include ('Admin/db.php');
                    $query = "SELECT * FROM tbl_product WHERE id ='$pro_id'";
                    $result = mysqli_query($connect, $query);
                    if(mysqli_num_rows($result) > 0)
                    {
                    while($row = mysqli_fetch_array($result))
                    {
                    ?>
                    <div class="products">
                        <form method="post" action="product_action_cart.php">
                            <div class="box">

                                <img src="Admin/images/<?php echo $row["image"]; ?>" width="500" height="500"
                                    class="img-responsive" /><br>

                                <h4 class="text-info"><?php echo $row["name"]; ?></h4>

                                <h4 class="text-danger">₹ <?php echo $row["price"]; ?></h4>


                                <input type="text" name="quantity" value="1" class="form-control" /><br>
                                <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                                <input type="hidden" name="hidden_id"   value="<?php echo $row["id"]; ?>" />
                                <!-- <input type="hidden" name="session_id" value="<?php echo session_id() ?>" /> -->
                                
                                <input type="hidden" name="hidden_image" value="<?php echo $row["image"]; ?>" />

                                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />


                                <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-primary"
                                    value="Add to Cart  ">
                                <?php  ?>
                            </div>
                        </form>
                    </div>
                    <?php
    }
}
?>
                    <!-- /.card-footer-->
                </div>