<?php

include("../backend/functions.php");

$Proid = $_GET['ProID'];

$query = query("UPDATE `proposal` SET action='SHOW' WHERE id='$Proid'");
confirm($query);
if($query){
    redirect("../all-proposal.php");
    set_message('<h2 class="m-0 text-dark bg-primary text-center" style="padding: 10px; border-radius: 20px;">Proposal Show Successful</h2>');
}
else{
     set_message('<h2 class="m-0 text-dark bg-primary text-center" style="padding: 10px; border-radius: 20px;">Proposal can not Show Successful</h2>');
}


?>