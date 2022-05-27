<?php 
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/json");
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$result = curl_exec($ch);
$data = json_decode($result);
echo "<pre>";
print_r($data);
?>