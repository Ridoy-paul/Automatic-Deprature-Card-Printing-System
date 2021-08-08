<?php
  echo "ok";
  $url = "https://esms.mimsms.com/smsapi";
  $data = [
    "api_key" => "C20076515ff80418014b68.99517442",
    "type" => "application/xml",
    "contacts" => "8801703235615",
    "senderid" => "8809612446206",
    "msg" => "Hello",
  ];
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $response = curl_exec($ch);
  curl_close($ch);
  echo $response;
  echo "<script>alert('Notice has been inserted ! $response')</script>";
  echo "ok";