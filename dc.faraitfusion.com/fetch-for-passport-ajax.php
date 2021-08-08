<?php require_once("backend/config.php"); ?>
<?php

$username =  $_SESSION['username'];
     
$f_query=query("SELECT * FROM `admin` where username='$username' || gmail = '$username'");
confirm($f_query);
$f_rows=fetch_array($f_query);
$type = $f_rows['type'];
$name = $f_rows['name'];
$ID = $f_rows['id'];


if(isset($_POST["query"]))
{
    
    
    $search = $_POST["query"];
    
    
    $stringLenght = strlen($search);
    if($stringLenght == 88){
        //echo "String is right<br>";
        $nationality = substr($search, 2, 3);
        $passportNum = substr($search, 44, 9);
        
        $birthDate = substr($search, 61, 2);
        $birthM = substr($search, 59, 2);
        $birthY = substr($search, 57, 2);
        if($birthY > 25){
            $birthY = "19".$birthY;
        }
        else{
            $birthY = "20".$birthY;
        }
        
        $genderQ = substr($search, 64, 1);
        if($genderQ == "F"){
            $gender = "Female";
        }
        else if($genderQ == "M"){
            $gender = "Male";
        }
        
        $passExDate = substr($search, 69, 2);
        $passExMonth = substr($search, 67, 2);
        $passExYear = substr($search, 65, 2);
        
        $passExYear = "20".$passExYear;
        
        
        // for Last Name Start
        $replace = str_replace("<","_", $search);

        $haystack = $replace;
        $needle   = "__";
        
        $pos      = strpos($replace, $needle);
        $posP = $pos + 2;
        //echo $posP;
        $lastNameS = $pos - 5;
        $lastName = substr($replace, 5, $lastNameS);
        //echo "Last Name: ".substr($replace, 5, $lastNameS)."<br>";
        // for Last Name End
        
        // for First Name Start
        $halfStr = substr($replace, 0, 44);
        
        //$i = 0;
        $lastS = -1;
        
        if($halfStr[$lastS] == "_"){
            
            for($i = 1; $i < strlen($halfStr); $i++){
        
        	if($halfStr[$lastS] == "_"){
        	//echo $i." Hello<br>";
            	$lastS -= 1;
                $restNum = strlen($halfStr) - $i;
            }
         }
         
        }
        else{
            	$restNum = strlen($halfStr);
                //break;
            }
        
        
        //echo "It is the rest Num: ".$restNum."<br>";
        $firstNLenght = $restNum - $posP;
        //echo $firstNLenght."<br>";
        
        $firstNameWithUnd = substr($halfStr, $posP, $firstNLenght);
        $firstNameStrReplace = str_replace("_"," ", $firstNameWithUnd);
        //echo substr($halfStr, $posP, $firstNLenght)."<br>";
        //echo "First Name: ".$firstNameStrReplace."<br>";

        // for First Name End
        
        $dateOfBirth = ".$birthY."-".$birthM."-".$birthDate.";
        
        
        date_default_timezone_set("Asia/Dhaka");
         //$scanDate = date("Y-m-d h:i:sa");
         $scanDate = date("Y-m-d H:i:s", strtotime("+1 hour +30 minutes"));
        $updatedScanDate = date( "Y-m-d", strtotime($scanDate));
        // echo "Nationality: ".$nationality."<br>";
        // echo "PassportNum: ".$passportNum."<br>";
        // echo "Date Of Birth: ".$birthY."-".$birthM."-".$birthDate."<br>";
        // echo "Gender: ".$gender."<br>";
        // echo "Passport Expire Date: ".$passExYear."-".$passExMonth."-".$passExDate."<br>";
        //echo date("d-m-Y");
        ?>
        
        
        <div class="row">
             <div class="col-md-12">
            <form method="post" id="insert_form" class="">
                <div id="PaycashForm" class="card" style="background-color: rgb(244, 244, 244); padding: 20px;">
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name ( নাম )</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="pName" name="pName" value="<?php echo $firstNameStrReplace." ".$lastName;?>" readonly>
                          <input type="hidden" name="fullPassportNum" value="<?php echo $search; ?>" >
                        </div>
                      </div>
                      <div class="row">
                         <div class="col-md-6">
                             <div class="form-group">
                                <label for="exampleInputEmail1">Sex</label>
                                <div class="form-check form-check-inline" style="margin-left: 10px;">
                                  <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male" <?php if($genderQ == "M"){ echo "checked"; }?>>
                                  <label class="form-check-label" for="inlineRadio1">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female" <?php if($genderQ == "F"){ echo "checked"; }?>>
                                  <label class="form-check-label" for="inlineRadio2">Female</label>
                                </div>
                              </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group row">
                                <label for="inputName" class="col-sm-6 col-form-label">Date of Birth</label>
                                <div class="col-sm-6">
                                  <input type="text" class="form-control" id="dateOfBirth" value="<?php echo $birthY ."-". $birthM."-".$birthDate;?>" name="dateOfBirth" readonly>
                                </div>
                              </div>
                         </div>
                     </div>
                     <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Nationality</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="pName" name="nationality" value="<?php echo $nationality;?>" readonly>
                        </div>
                      </div>
                      <div class="row">
                         <div class="col-md-6">
                             <div class="form-group row">
                                <label for="inputName" class="col-sm-6 col-form-label">Passport Number</label>
                                <div class="col-sm-6">
                                  <input type="text" class="form-control" id="passportNum" name="passportNum" value="<?php echo $passportNum;?>" readonly>
                                </div>
                              </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group row">
                                <label for="inputName" class="col-sm-6 col-form-label">Date of Expiry</label>
                                <div class="col-sm-6">
                                  <input type="text" class="form-control" id="passportExpiryD" value="<?php echo $passExYear."-".$passExMonth."-".$passExDate;?>" name="passportExpiryD" readonly>
                                </div>
                              </div>
                         </div>
                     </div>
                     <hr style="border-bottom: 1px solid #F50057;">
                     <hr style="border-bottom: 1px solid #F50057;">
                     <div class="row">
                         <div class="col-md-4">
                                             <div class="form-group row">
                                                <label for="inputName" class="col-sm-4 col-form-label">Flight Type</label>
                                                <div class="col-sm-8">
                                                  <!--<input type="text" class="form-control" id="typeOfVisa" name="typeOfVisa" >-->
                                                  <select class="form-control" id="" name="flightType" required>
                                                      <option selected>Select Flight Type</option>
                                                      <?php
                                                            $queryForFT = query("SELECT * FROM flightType ORDER BY id DESC");
                                                            confirm($queryForFT);
                                                            $rowsOfFT = mysqli_num_rows($queryForFT);
                                                            if($rowsOfFT > 0) {
                                                                
                                                                $i = 1;
                                                                while($row = fetch_array($queryForFT)) {
                                                                    
                                                                    ?>
                                                                     <option value="<?php echo $row['code']; ?>"><?php echo $row['typeName']; ?> (<?php echo $row['code']; ?>)</option>
                                                                   <?php
                                                                   $i++;
                                                                   
                                                                }
                                                            }
                                                      
                                                      ?>
                                                    </select>
                                                </div>
                                              </div>
                                         </div>
                         <div class="col-md-5">
                             <div class="form-group row">
                                <label for="inputName" class="col-sm-4 col-form-label">Flight Number</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="flightNum" name="flightNum" required>
                                </div>
                              </div>
                         </div>
                         <div class="col-md-3">
                             <div class="form-group row">
                                <label for="inputName" class="col-sm-6 col-form-label">Date of Departure</label>
                                <div class="col-sm-6">
                                  <input type="text" class="form-control" id="dateOfDeparture" name="dateOfDeparture" value="<?php echo $updatedScanDate;?>" required>
                                </div>
                              </div>
                         </div>
                     </div>
                     
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label"><span style="font-size: 12px;">বাংলাদেশে অবস্থানকালীন ঠিকানা (বিদেশী নাগরিকদের জন্য)<span><br>Address in Bangladesh (For Foreigners)</label>
                        <div class="col-sm-8">
                          <textarea type="text" class="form-control" id="addressInBDforF" name="addressInBDforF"> </textarea>
                        </div>
                      </div>
                      <hr style="border-bottom: 1px solid #F50057;">
                      <div class="row">
                          <div class="col-md-12">
                             <h4 style="text-align: center; padding: 10px; font-weight: bold;">বাংলাদেশের নাগরিকের জন্য</42>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group row">
                                <label for="inputName" class="col-sm-4 col-form-label">Visa Number</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="visaNum" name="visaNum" >
                                </div>
                              </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group row">
                                <label for="inputName" class="col-sm-6 col-form-label">Date of Expiry</label>
                                <div class="col-sm-6">
                                  <input type="date" class="form-control" id="visaDateOfExpiry" name="visaDateOfExpiry">
                                </div>
                              </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group row">
                                <label for="inputName" class="col-sm-4 col-form-label">Type of Visa</label>
                                <div class="col-sm-8">
                                  <!--<input type="text" class="form-control" id="typeOfVisa" name="typeOfVisa" >-->
                                  <select class="form-control" id="typeOfVisa" name="typeOfVisa">
                                      <option selected>Select Visa Type</option>
                                      <option value="Work visa">Work visa</option>
                                      <option value="Tourist visa">Tourist visa</option>
                                      <option value="Student visa">Student visa</option>
                                      <option value="Medical visa">Medical visa</option>
                                      <option value="Journalist and media">Journalist and media</option>
                                      
                                    </select>
                                </div>
                              </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group row">
                                <label for="inputName" class="col-sm-6 col-form-label">Purpose of Visit</label>
                                <div class="col-sm-6">
                                  <input type="text" class="form-control" id="purposeOfVisit" name="purposeOfVisit">
                                </div>
                              </div>
                         </div>
                     </div>
                             <div class="card-footer">
                          
                          
                          
                          <div class="row">
                             <div class="col-md-8">
                                 <div class="form-group row">
                                    <label for="inputName" class="col-sm-4 col-form-label">Print By</label>
                                    <div class="col-sm-8">
                                      <?php 
                                        if($type == "Admin"){
                                            ?>
                                                <input type="text" class="form-control" name="printBy" value="Admin" readonly>
                                            <?php
                                        }
                                        else if($type == "CRM"){
                                            ?>
                                                <input type="text" class="form-control" value="<?php echo $name; ?>" readonly>
                                                <input type="hidden" name="printBy" value="<?php echo $ID; ?>">
                                            <?php
                                        }
                                      ?>
                                    </div>
                                  </div>
                             </div>
                             <div class="col-md-4">
                                 <div class="form-group text-right">
                                    <input  type="submit" name="nextPassportInfo" id="insert" value="Print" class="btn btn-primary btn-lg">
                                  </div>
                             </div>
                         </div>
                      
                          
                        </div>
                      </form>
                </div>
             </div>
         </div>
          
           
     <?php   
        
    }
    else {
        echo "String is wrong";
    }
    
     
}
?>
