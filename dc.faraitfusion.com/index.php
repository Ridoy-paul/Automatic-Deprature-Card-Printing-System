<?php require_once("backend/config.php"); ?>
<?php

         if(!isset($_SESSION['username'])){
            header("Location: login.php");
       
      }
?>
 
<?php

    // $username =  $_SESSION['username'];
    // $f_query=query("SELECT * FROM `admin` where username='$username' || gmail = '$username'");
    // confirm($f_query);
    // $f_rows=fetch_array($f_query);
    // $type = $f_rows['type'];
    
?>

            <?php include("header.php"); ?>

            <?php  include("left-sidebar.php"); ?>
       
<?php
                
    $username =  $_SESSION['username'];
    $f_query=query("SELECT * FROM `admin` where username='$username' || gmail = '$username'");
    confirm($f_query);
    $f_rows=fetch_array($f_query);
    $type = $f_rows['type'];
    
    if ($type == 'Admin')
    {
        if($_SERVER['REQUEST_URI'] =='/'  || $_SERVER['REQUEST_URI'] == '/index.php'){
                    include("frontend/admin-content.php");
                   
                }
    }
    else if($type == 'CRM')
    {
        if($_SERVER['REQUEST_URI'] =='/'  || $_SERVER['REQUEST_URI'] == '/index.php'){
                    include("frontend/admin-content.php");
                   
                }
    }
                
                
                ?>
               
               
               
               
   
             <!-- footer Start -->
            <?php include("footer.php"); ?>
             <!-- footer End -->
          





