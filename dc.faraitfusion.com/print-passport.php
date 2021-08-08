<?php require_once("backend/config.php"); ?>

<?php

     $username =  $_SESSION['username'];
     
    $f_query=query("SELECT * FROM `admin` where username='$username' || gmail = '$username'");
    confirm($f_query);
    $f_rows=fetch_array($f_query);
    $type = $f_rows['type'];
    
    if ($type == 'Admin' || $type == 'CRM'){
        ?>
       
   
   <?php

    
              $passPortNum = $_GET['passPortNum'];
              $flightNum = $_GET['flightNum'];
    
    
    // //Shop Details Query
    $query = query("SELECT * FROM passportInfo WHERE flightNum = '$flightNum' AND passportNum='$passPortNum'");
    confirm($query);
    $row = fetch_array($query);
    
    $name = $row['name'];
    $sex = $row['sex'];
    $dateOfBirth = $row['dateOfBirth'];
    
    $nationality = $row['nationality'];
    $passportNum = $row['passportNum'];
    $passportExpiryD = $row['passportExpiryD'];
    $flightNum = $row['flightNum'];
    $dateOfDeparture = $row['dateOfDeparture'];
    $addressInBDforF = $row['addressInBDforF'];
    $visaNum = $row['visaNum'];
    $visaDateOfExpiry = $row['visaDateOfExpiry'];
    $typeOfVisa = $row['typeOfVisa'];
    $purposeOfVisit = $row['purposeOfVisit'];
    $flightTypeCode = $row['flightTypeCode'];
    
    $updatedFlightNum = $flightTypeCode.$flightNum;
                            
   
    
?>     
        
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="" crossorigin="anonymous">

    <title>Departure Print</title>
    
    <style>
        *{
          /*  margin: 0px;*/
          /*  padding: 0px;*/
          /*height: 950px;*/
          /*width: 671px;*/
          /*background-color: white;*/
          /*border: 1px solid white;*/
          /*text-align: center;*/
          /*background-image: url("media/bgpaulp.png");*/
          /*background-size: cover;*/
          /*background-repeat:
          no-repeat;*/
          /*background-position: center;*/
        }
        .bgImage{
            height: 595px;
          width: 395px; 
            background-image: url("media/depfinal.jpg");
            /*background-image: url("media/dep1.png");*/
            /*background-image: url("media/departure-card-new.png");*/
            
            background-repeat: no-repeat;
            
        }
    </style>
    
    
  </head>
  <body>
      <div class="bgImage">
          
    <br>
    <br>
    <br>
    <br>
    <br>
    
   
    <div class="row">
        <div class="col-md-12">
            <h6 style="margin-left: 60px; margin-top: 0px; position: absolute;"><?php echo $name;?></h6>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="" style="margin-top: 35px;">
              <li style="float: left; list-style: none; margin-left: 24px; font-weight: bold; font-size: 26px; position: absolute;" class=""><?php if($sex == "male"){ echo "&#10003;";} ?></li>
              <li style="float: left; list-style: none; margin-left: 80px; font-weight: bold; font-size: 26px; position: absolute;" class=""><?php if($sex == "female"){ echo "&#10003;";}?></li>
              
              <li style="float: left; list-style: none; margin-left: 232px; font-weight: bold; font-size: 12px; letter-spacing: 6px; margin-top: 14px; position: absolute;" class=""><?php if($sex == "male"){ echo date( "d m Y", strtotime($dateOfBirth));}?></li>
              <li style="float: left; list-style: none; margin-left: 232px; font-weight: bold; font-size: 12px; letter-spacing: 6px; margin-top: 14px; position: absolute;" class=""><?php if($sex == "female"){ echo date( "d m Y", strtotime($dateOfBirth));}?></li>
              
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h6 style="margin-left: 85px; margin-top: 36px; position: absolute;"><?php echo $nationality;?></h6>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="" style="">
              <li style="margin-top: 69px; float: left; list-style: none; margin-left: 54px; font-weight: bold; font-size: 12px; position: absolute;" class=""><?php echo $passportNum;?></li>
              <li style="margin-top: 81px; float: left; list-style: none; margin-left: 233px; font-weight: bold; font-size: 12px; letter-spacing: 6px; position: absolute;" class=""><?php echo date( "d m Y", strtotime($passportExpiryD));?></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="" style="">
              <li style="margin-top: 83px; float: left; list-style: none; margin-left: 51px; font-weight: bold; font-size: 12px; position: absolute;" class=""><?php echo $updatedFlightNum;?></li>
              <li style="margin-top: 97px; float: left; list-style: none; margin-left: 233px; font-weight: bold; font-size: 12px; letter-spacing: 6px; position: absolute;" class=""><?php echo date( "d m Y", strtotime($dateOfDeparture));?></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h6 style="margin-left: 139px; margin-top: 104px; position: absolute;"><?php echo $addressInBDforF;?></h6>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="" style="">
              <li style="margin-top: 185px; float: left; list-style: none; margin-left: 38px; font-weight: bold; font-size: 12px; position: absolute;" class=""><?php echo $visaNum;?></li>
              <li style="float: left; list-style: none; margin-left: 237px; font-weight: bold; font-size: 12px; margin-top: 199px; letter-spacing: 6px; position: absolute;" class=""><?php echo date( "d m Y", strtotime($visaDateOfExpiry));?></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="">
              <li style="margin-top: 205px; float: left; list-style: none; margin-left: 42px; font-weight: bold; font-size: 12px; position: absolute;" class=""><?php echo $typeOfVisa;?></li>
              <li style="margin-top: 205px; float: left; list-style: none; margin-left: 234px; font-weight: bold; font-size: 12px; position: absolute;" class=""><?php echo $purposeOfVisit;?></li>
            </ul>
        </div>
    </div>
    
    </div>
    
    
    
    
    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="" crossorigin="anonymous"></script>
    
  </body>
</html>

<?php
}
        ?>

