<?php

$curl = curl_init();
$form_field = array('period' => 'weekly', 'interval' => 1, 'item' => array('name' => 'Test Weekly 1 plan', 'description' => 'Description for the weekly 1 plan', 'amount' => 600, 'currency' => 'INR'),'notes'=> array('key1'=> 'value3','key2'=> 'value2'));
$str = http_build_query($form_field);


curl_setopt($curl, CURLOPT_URL,"https://rzp_test_471HAsTMoDaeKd:Bpqh2OkbRpsns1UKReWuSce0@api.razorpay.com/v1/plans");
curl_setopt($curl, CURLOPT_POST,1);
curl_setopt($curl, CURLOPT_POSTFIELDS,$str);
curl_setopt($curl, CURLOPT_RETURNTRANSFER ,true);



$response = curl_exec($curl);
$response = json_decode($response, true);
print_r($response);

// https://rzp_test_471HAsTMoDaeKd:Bpqh2OkbRpsns1UKReWuSce0@api.razorpay.com/v1/plans