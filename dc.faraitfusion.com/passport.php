<?php require_once("backend/config.php"); ?>
<?php include("header.php"); ?>
<?php include ("left-sidebar.php");?>

<?php

     $username =  $_SESSION['username'];
     
    $f_query=query("SELECT * FROM `admin` where username='$username' || gmail = '$username'");
    confirm($f_query);
    $f_rows=fetch_array($f_query);
    $type = $f_rows['type'];
    $name = $f_rows['name'];
    $ID = $f_rows['id'];
    
    if ($type == 'Admin' || $type == 'CRM'){
        ?>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->
            <div class="card">
              <div class="card-header text-right">
                  <a href="index.php" class="btn btn-primary btn-sm">Reload</a>
                </div>
              <!-- /.card-header -->

              <div class="card-body">
                <div class="row">
                                <div class="col-md-12">
                                        <!--<form method="post" id="insert_form" style="padding: 0px 10px;">-->
                                        <div class="card-body">
                                           <div class="row">
                                                <div class="col-md-12 bg-dark" style="padding: 20px; border: 3px solid #F50057; border-radius: 10px;">
                                                    <div class="form-group">
                                                        <label for="clientName">Passport Num</label>
                                                        <input type="text" class="form-control" name="search_text" id="search_text" placeholder="" autofocus>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                        <div class="col-md-12">
                                          <div style="padding: 10px;" id="resultR"></div>
                                        </div>
                                    </div>
                                        </div>    
                                            
                                <!--<div class="card-footer">-->
                                <!--  <input  type="submit" name="addApponment" id="insert" value="ADD" class="btn btn-success form-control">-->
                                <!--</div>-->
                              <!--</form>-->
                                    
                                </div>
                            
              </div>
              <!-- /.card-body -->
              
              <div id="manualFormInput">
                  <div class="row">
                             <div class="col-md-12">
                            <form method="post" id="insert_form" class="">
                                <div id="PaycashForm" class="card" style="background-color: rgb(244, 244, 244); padding: 20px;">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Name ( নাম )</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" id="pName" name="pName" required>
                                        </div>
                                      </div>
                                      <div class="row">
                                         <div class="col-md-6">
                                             <div class="form-group">
                                                <label for="exampleInputEmail1">Sex</label>
                                                <div class="form-check form-check-inline" style="margin-left: 10px;">
                                                  <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male" >
                                                  <label class="form-check-label" for="inlineRadio1">Male</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female"  >
                                                  <label class="form-check-label" for="inlineRadio2">Female</label>
                                                </div>
                                              </div>
                                         </div>
                                         <div class="col-md-6">
                                             <div class="form-group row">
                                                <label for="inputName" class="col-sm-6 col-form-label">Date of Birth</label>
                                                <div class="col-sm-6">
                                                  <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth"  required>
                                                </div>
                                              </div>
                                         </div>
                                     </div>
                                     <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Nationality</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" id="pName" name="nationality"  required>
                                        </div>
                                      </div>
                                      <div class="row">
                                         <div class="col-md-6">
                                             <div class="form-group row">
                                                <label for="inputName" class="col-sm-6 col-form-label">Passport Number</label>
                                                <div class="col-sm-6">
                                                  <input type="text" class="form-control" id="passportNum" name="passportNum"  required>
                                                </div>
                                              </div>
                                         </div>
                                         <div class="col-md-6">
                                             <div class="form-group row">
                                                <label for="inputName" class="col-sm-6 col-form-label">Date of Expiry</label>
                                                <div class="col-sm-6">
                                                  <input type="date" class="form-control" id="passportExpiryD" name="passportExpiryD" required>
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
                                                    <?php
                                                         date_default_timezone_set("Asia/Dhaka");
                                                         //$scanDate = date("Y-m-d h:i:sa");
                                                         $scanDate = date("Y-m-d H:i:s", strtotime("+1 hour +30 minutes"));
                                                         $updatedScanDate = date( "Y-m-d", strtotime($scanDate));
                                                    
                                                    ?>
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
                                                        <input  type="submit" name="nextPassportInfoByManual" id="insert" value="Print" class="btn btn-danger btn-lg">
                                                      </div>
                                                 </div>
                                             </div>
                                          
                                        </div>
                                      </form>
                                </div>
                             </div>
                         </div>
              </div>
              
              
              
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
  <?php
          
            if(isset($_POST['nextPassportInfo'])){
                
                $name = escape_string($_POST['pName']);
                $sex = escape_string($_POST['gender']);
                $dateOfBirth = escape_string($_POST['dateOfBirth']);
                $nationality = escape_string($_POST['nationality']);
                $passportNum = escape_string($_POST['passportNum']);
                $passportExpiryD = escape_string($_POST['passportExpiryD']);
                $flightTypeCode = escape_string($_POST['flightType']);
                $flightNum = escape_string($_POST['flightNum']);
                $dateOfDeparture = escape_string($_POST['dateOfDeparture']);
                $addressInBDforF = escape_string($_POST['addressInBDforF']);
                $visaNum = escape_string($_POST['visaNum']);
                $visaDateOfExpiry = escape_string($_POST['visaDateOfExpiry']);
                $typeOfVisa = escape_string($_POST['typeOfVisa']);
                $purposeOfVisit = escape_string($_POST['purposeOfVisit']);
                
                $printBy = escape_string($_POST['printBy']);
                $fullPassportNum = $_POST['fullPassportNum'];
                
                $date = date("Y-m-d");
                //echo $purposeOfVisit;
                
                $existSettingQ = query("SELECT * FROM setting");
                confirm($existSettingQ);
                $rowOfSetting = fetch_array($existSettingQ);
                $printingCost = $rowOfSetting['cardCharge'];
                
                $query_insert = query("INSERT INTO passportInfo (name, sex, dateOfBirth, nationality, passportNum, passportExpiryD, flightTypeCode, flightNum, dateOfDeparture, addressInBDforF, visaNum, visaDateOfExpiry, typeOfVisa, purposeOfVisit, print_price, fullPassportNum, printBy, date) VALUES ('$name','$sex','$dateOfBirth','$nationality','$passportNum','$passportExpiryD', '$flightTypeCode', '$flightNum','$dateOfDeparture','$addressInBDforF','$visaNum','$visaDateOfExpiry', '$typeOfVisa', '$purposeOfVisit', '$printingCost', '$fullPassportNum', '$printBy', '$date')");
                confirm($query_insert);
                if($query_insert){
                    set_message('<h2 class="m-0 text-dark bg-primary text-center" style="padding: 10px; border-radius: 20px;">Passport information is Saved</h2>');
                    redirect("print-passport.php?passPortNum=$passportNum&flightNum=$flightNum");
                }
                else{
                    redirect("passport.php");
                }
                
            }
          
          ?>
  
  
  <?php
          
            if(isset($_POST['nextPassportInfoByManual'])){
                
                $name = escape_string($_POST['pName']);
                $sex = escape_string($_POST['gender']);
                $dateOfBirth = escape_string($_POST['dateOfBirth']);
                $nationality = escape_string($_POST['nationality']);
                $passportNum = escape_string($_POST['passportNum']);
                $passportExpiryD = escape_string($_POST['passportExpiryD']);
                $flightTypeCode = escape_string($_POST['flightType']);
                $flightNum = escape_string($_POST['flightNum']);
                $dateOfDeparture = escape_string($_POST['dateOfDeparture']);
                $addressInBDforF = escape_string($_POST['addressInBDforF']);
                $visaNum = escape_string($_POST['visaNum']);
                $visaDateOfExpiry = escape_string($_POST['visaDateOfExpiry']);
                $typeOfVisa = escape_string($_POST['typeOfVisa']);
                $purposeOfVisit = escape_string($_POST['purposeOfVisit']);
                
                $date = date("Y-m-d");
                //echo $purposeOfVisit;
                
                $printBy = escape_string($_POST['printBy']);
                $fullPassportNum = $_POST['fullPassportNum'];
                
                $existSettingQ = query("SELECT * FROM setting");
                confirm($existSettingQ);
                $rowOfSetting = fetch_array($existSettingQ);
                $printingCost = $rowOfSetting['cardCharge'];
                
                $printBy = escape_string($_POST['printBy']);
                $fullPassportNum = "Null"; //$_POST['fullPassportNum'];
                
                $query_insert = query("INSERT INTO passportInfo (name, sex, dateOfBirth, nationality, passportNum, passportExpiryD, flightTypeCode, flightNum, dateOfDeparture, addressInBDforF, visaNum, visaDateOfExpiry, typeOfVisa, purposeOfVisit, print_price, date) VALUES ('$name','$sex','$dateOfBirth','$nationality','$passportNum','$passportExpiryD', '$flightTypeCode', '$flightNum', '$dateOfDeparture','$addressInBDforF','$visaNum','$visaDateOfExpiry', '$typeOfVisa', '$purposeOfVisit', '$printingCost', '$fullPassportNum', '$printBy', '$date')");
                confirm($query_insert);
                if($query_insert){
                    set_message('<h2 class="m-0 text-dark bg-primary text-center" style="padding: 10px; border-radius: 20px;">Passport information is Saved</h2>');
                    redirect("print-passport.php?passPortNum=$passportNum&flightNum=$flightNum");
                }
                else{
                    redirect("passport.php");
                }
                
            }
          
          ?>
  
  
  
  
  
  
<?php
}
        ?>


<!--FOOTER START HERE-->

    <footer class="main-footer">
        <!--<strong>Copyright &copy; 2020 <a href="http://faraitfusion.com">FARA IT Fusion</a>.</strong>-->
        <!--All rights reserved.-->
        <!--<div class="float-right d-none d-sm-inline-block">-->
        <!--    <b>Version</b> 1.1.0-->
        <!--</div>-->
    </footer>


    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<!-- Editable -->
<script src="plugins/jquery-datatables-editable/jquery.dataTables.js"></script>
<script src="plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="plugins/tiny-editable/mindmup-editabletable.js"></script>
<script src="plugins/tiny-editable/numeric-input-example.js"></script>
<script>
$('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
$('#editable-datatable').editableTableWidget().numericInputExample().find('td:first').focus();
$(function() {
$('#editable-datatable').DataTable();
});
</script>

<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/ckeditor/ckeditor.js"></script>
<script src="plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>

    <!--search Customer in Start-->
<script>


    $(document).ready(function(){
	load_data();
	function load_data(query)
	{
		$.ajax({
			url:"fetch-for-passport-ajax.php",
			method:"post",
			data:{query:query},
			success:function(data)
			{
				$('#resultR').html(data);
			}
		});
	}
	
	$('#search_text').keyup(function(){
		var search = $(this).val();
		var searchLe = search.length;
		if(searchLe == 88){
		    if(search != '')
    		{
    			load_data(search);
    		}
    		else
    		{
    			load_data();			
    		}
		}
// 		else{
// 		    $("#manualFormInput").show();
// 		}
		
	});
});


</script>
<script>

$(document).ready(function(){
	
	$('#search_text').keyup(function(){
		var search = $(this).val();
		var searchLe = search.length;
		if(searchLe != ""){
		    $("#manualFormInput").hide();
		}
		else{
		    $("#manualFormInput").show();
		}

	});
	
});

</script>
<!--search Customer in Start-->

</body>
</html>

