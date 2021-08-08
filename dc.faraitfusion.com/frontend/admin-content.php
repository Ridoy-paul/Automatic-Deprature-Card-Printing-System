<?php
if(isset($_SESSION['username'])){
     $username =  $_SESSION['username'];
    $f_query=query("SELECT * FROM `admin` where username='$username' || gmail = '$username'");
    confirm($f_query);
    $f_rows=fetch_array($f_query);
    $type = $f_rows['type'];
    
    if ($type == 'Admin'){
        
        redirect("passport.php");
  
    }
    else if ($type == 'CRM'){
        
        redirect("passport.php");
  
    }
   
}
?>
<!-- Main Sidebar Container -->
