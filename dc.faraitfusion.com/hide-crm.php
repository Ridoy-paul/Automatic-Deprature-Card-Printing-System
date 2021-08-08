<?php

include("backend/config.php");

$ID = $_GET['ID'];

$query = query("UPDATE `admin` SET status='HIDE' WHERE id='$ID'");
confirm($query);
if($query){
    set_message("<p style='color:white;font-size:15px; background: #343A40; border: 2px solid #F50057; border-radius: 10px; padding: 10px 10px; '>CRM Deactive Successfully</p>");
    redirect("deactive-crm.php");
}
else{
    set_message("Crm can't Deactive Successfully");
    redirect("active-crm.php");
}


?>