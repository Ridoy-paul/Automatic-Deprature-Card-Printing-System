<?php


echo 'User IP Address - '.$_SERVER['REMOTE_ADDR']."<br>";  


$ip_address = gethostbyname("www.google.com");  
echo "IP Address of Google is - ".$ip_address;  
echo "</br>";  
$ip_address = gethostbyname("www.javatpoint.com");  
echo "IP Address of javaTpoint is - ".$ip_address."<br>";
 
 
 $computerName = gethostbyaddr($_SERVER['REMOTE_ADDR']);
 
 //echo $computerName."<br>";

$machineId = trim(shell_exec('cat /etc/machine-id 2>/dev/null'));

//echo $machineId."<br>";

echo diffForHumans("12-3-2020");


// setting-passport.php
// passport.php
// all-scanned-passport.php
// print-passport.php
// passport-report.php
// passport-startdate-to-enddate-report.php








?>