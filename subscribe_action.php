<?php

$product_name=$_POST['product_name'];
$product_price=$_POST['product_price'];


date_default_timezone_set("Asia/Calcutta"); 

    $newDate = strtotime(date("".$userdate."00:00:00") );




$curl = curl_init();
$form_field = array('period' => 'weekly', 'interval' => $interval, 'item' => array('name' => $product_name, 'description' => 'Description for the weekly 1 plan', 'amount' => $product_price * 100, 'currency' => 'INR'),'notes'=> array('key1'=> 'value3','key2'=> 'value2'));
$str = http_build_query($form_field);


curl_setopt($curl, CURLOPT_URL,"https://rzp_test_471HAsTMoDaeKd:Bpqh2OkbRpsns1UKReWuSce0@api.razorpay.com/v1/plans");
curl_setopt($curl, CURLOPT_POST,1);
curl_setopt($curl, CURLOPT_POSTFIELDS,$str);
curl_setopt($curl, CURLOPT_RETURNTRANSFER ,true);



$response = curl_exec($curl);
$response = json_decode($response, true);
// print_r($response);
$plan_id = $response['id'];
// https://rzp_test_471HAsTMoDaeKd:Bpqh2OkbRpsns1UKReWuSce0@api.razorpay.com/v1/plans




//subscri[tion]
?>



<html>



<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://rzp_test_471HAsTMoDaeKd:Bpqh2OkbRpsns1UKReWuSce0@api.razorpay.com/v1/subscriptions",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "plan_id=".$plan_id."&total_count=12&customer_notify=1&start_at=".$newDate."",
    CURLOPT_HTTPHEADER => array(
        "cache-control:no-cache",
        "content-type:application/x-www-form-urlencoded",
        "postman-token:67d92778-3ca8-ffb4-9680-c384d115f95a"
    ),

));

$response = curl_exec($curl);
$response = json_decode($response, true);
//print_r($response);
$err = curl_error($curl);

curl_close($curl);

if($err){
    echo "cURL Error #:" . $err;
} else {
    //echo $response;
    // echo "sharik";
    //echo $response["id"];
    //echo $response["id"];

}
?>


<!-- <p class="text-center py-3">
        <button id="shoaib" class="btn btn-primary" href="index.php">subscribe</button>
    </p> -->



<?php if(isset($response["id"])) : ?>    
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>

var options = {

    "key": "rzp_test_471HAsTMoDaeKd",
    "subscription_id": "<?php echo $response["id"]; ?>",
    "name":"shoaib",
    "description":"demo",
    "handler": function(response){
            console.log(response);
    },
    "theme":{
        "color":"blue"
    }
};
var shoaib = new Razorpay(options);
shoaib.open();
</script>
<?php endif; ?>
</html>