<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header card">
      <div class="container-fluid">
          <div class="col-md-12">
               <div class="card">
              <div class="card-body">
                  <div><b><?php display_message(); ?></b></div>
<?php
                $client_code = $_GET['sellProduct'];
                
                 $query = query("SELECT * FROM admin WHERE username = '" . $_SESSION['username'] . "'");  
                 confirm($query);
                 $row_of_admin = fetch_array($query);
                 $shopkeeper_id = $row_of_admin['id']; 
                 
                 //shop setting query start
                  $query_shop_setting = query("SELECT * FROM shop_setting WHERE shop_id='$shopkeeper_id' ");  
                 confirm($query_shop_setting);
                 $row_of_shop_setting = fetch_array($query_shop_setting);
                 $shop_name = $row_of_shop_setting['shop_name']; 
                         
                //shop setting query end
                
                $client_q = query("SELECT * FROM clients where  code='$client_code' AND shop_id='$shopkeeper_id'");
                confirm($client_q);
                while($serchrow=fetch_array($client_q))
                {
                    $client_Code = $serchrow['code'];
                    
                    $_SESSION['clientCode'] = $client_Code;
                    $clientCode = $_SESSION["clientCode"];
                    
                    $client_name = $serchrow['name'];
                    $_SESSION['clientName'] = $client_name;
                    $client_name = $_SESSION["clientName"];
                    
                     $client_sms_phn = $serchrow['phone'];
                    $_SESSION['clientphone'] = $client_sms_phn;
                    $client_sms_phn = $_SESSION["clientphone"];
                    
                    
                    $client_due= $serchrow['due'];
                    $_SESSION['clientDue'] = $client_due;
                    $clientDue = $_SESSION["clientDue"];
                    $clientDue_discount_tk = $_SESSION["clientDue"];
                    //echo $clientCode;
                    
                    // email session
                     $client_email= $serchrow['email'];
                    $_SESSION['clientemail'] = $client_email;
                    $client_email = $_SESSION["clientemail"];
                    
                    ?>
                    <div class="card-body">
                                         <center class=""> 
                                        <?php $cid = $serchrow['id'];?>
                                             <div class="row bg success" style="padding: 10px 0px; background-color: #ffff8d; color: black;">
                                                 <div class="col-md-2 empty-2"><h6 class="card-subtitle text-center"><b>Name<br></b><?php echo $serchrow['name']?></h6></div>
                                                 <div class="col-md-2 empty-2"><h6 class="card-subtitle text-center"><b>Address<br></b><?php echo $serchrow['address']?> </h6></div>
                                                 <div class="col-md-2 empty-2"><h6 class="card-subtitle text-center"><b>Phone<br></b> <?php echo $serchrow['phone']?></h6></div>
                                                 <div class="col-md-3 empty-2"><h6 class="card-subtitle text-center"><b>Email<br></b> <?php echo $serchrow['email']?></h6></div>
                                                 <div class="col-md-2 empty-2"><h6 class="card-subtitle text-center"><b>Code<br></b> <?php echo $serchrow['code']?></h6></div>
                                             </div>
                                         </center>
                                     </div>
                    <?php
                }
                      
?>

    
<?php        
// <!----------------------- Admin existing Clients Check END --------------------->

            if(isset($_POST['insertClient'])){
                
                $name = $_POST['clientName'];
                $phone = $_POST['hotline'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $shop_code = $_POST['shopkeeper_ID'];
                $shop_code_num_padded = sprintf("%03d", $shop_code);
                
                // for last id start;
                $client_last_id = query("SELECT * FROM clients ORDER BY id DESC");
                confirm($client_last_id);
                $row = fetch_array($client_last_id);
                $last_id = $row['id']+1;
                $last_id_num_padded = sprintf("%04d", $last_id);
                
                
                $code = $shop_code_num_padded.$last_id_num_padded;
                
    
                $query = query("INSERT INTO clients(code, name, phone, email, address, shop_id) VALUES('$code', '$name', '$phone', '$email', '$address', '$shop_code')");
                confirm($query);
                if($query){
                    set_message("New Clients Added");
                    
                }
                
                
                $client_q = query("SELECT * FROM clients where  code='$code'");
                confirm($client_q);
                while($serchrow=fetch_array($client_q))
                {
                    $client_Code = $serchrow['code'];
                    $_SESSION['clientCode'] = $client_Code;
                    
                    $clientCode = $_SESSION["clientCode"];
                    
                    $client_name = $serchrow['name'];
                    $_SESSION['clientName'] = $client_name;
                    $client_name = $_SESSION["clientName"];
                    
                     $client_sms_phn = $serchrow['phone'];
                    $_SESSION['clientphone'] = $client_sms_phn;
                    $client_sms_phn = $_SESSION["clientphone"];
                    
                    
                    $client_due= $serchrow['due'];
                    $_SESSION['clientDue'] = $client_due;
                    $clientDue = $_SESSION["clientDue"];
                    //echo $clientCode;
                    // email session
                     $client_email= $serchrow['email'];
                    $_SESSION['clientemail'] = $client_email;
                    $client_email = $_SESSION["clientemail"];
                    ?>
                    <div class="card-body">
                                         <center class=""> 
                                        <?php $cid = $serchrow['id'];?>
                                             <div class="row bg success" style="padding: 10px 0px; background-color: #ffff8d; color: black;">
                                                 <div class="col-md-2 empty-2"><h6 class="card-subtitle text-center"><b>Name<br></b><?php echo $serchrow['name']?></h6></div>
                                                 <div class="col-md-2 empty-2"><h6 class="card-subtitle text-center"><b>Address<br></b><?php echo $serchrow['address']?> </h6></div>
                                                 <div class="col-md-2 empty-2"><h6 class="card-subtitle text-center"><b>Phone<br></b> <?php echo $serchrow['phone']?></h6></div>
                                                 <div class="col-md-3 empty-2"><h6 class="card-subtitle text-center"><b>Email<br></b> <?php echo $serchrow['email']?></h6></div>
                                                 <div class="col-md-2 empty-2"><h6 class="card-subtitle text-center"><b>Code<br></b> <?php echo $serchrow['code']?></h6></div>
                                             </div>
                                         </center>
                                     </div>
                    <?php
                }
                        
            }
            
            
            
             if(isset($_POST['unknownCustomers'])){
                
                $client_q = query("SELECT * FROM clients WHERE name ='Unknown' AND shop_id='$shopkeeper_id'");
                confirm($client_q);
                while($serchrow=fetch_array($client_q))
                {
                    $client_Code = $serchrow['code'];
                    $_SESSION['clientCode'] = $client_Code;
                    
                    $clientCode = $_SESSION["clientCode"];
                    
                    $client_name = $serchrow['name'];
                    $_SESSION['clientName'] = $client_name;
                    $client_name = $_SESSION["clientName"];
                    
                    $client_due= $serchrow['due'];
                    $_SESSION['clientDue'] = $client_due;
                    $clientDue = $_SESSION["clientDue"];
                    //echo $clientCode;
                    ?>
                    <div class="card-body">
                                         <center class=""> 
                                        <?php $cid = $serchrow['id'];?>
                                             <div class="row bg success" style="padding: 15px 0px; background-color: #17A2B8; color: white; bordar: 3px solid #563D7C;">
                                                 <div class="col-md-2 empty-2"><h6 class="card-subtitle text-center"><b>Name<br></b><?php echo $serchrow['name']?></h6></div>
                                                 <div class="col-md-2 empty-2"><h6 class="card-subtitle text-center"><b>Address<br></b><?php echo $serchrow['address']?> </h6></div>
                                                 <div class="col-md-2 empty-2"><h6 class="card-subtitle text-center"><b>Phone<br></b> <?php echo $serchrow['phone']?></h6></div>
                                                 <div class="col-md-3 empty-2"><h6 class="card-subtitle text-center"><b>Email<br></b> <?php echo $serchrow['email']?></h6></div>
                                                 <div class="col-md-2 empty-2"><h6 class="card-subtitle text-center"><b>Code<br></b> <?php echo $serchrow['code']?></h6></div>
                                             </div>
                                         </center>
                                     </div>
                    <?php
                }
                        
            }
                  
?>  

                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
           </div>
           
           
           <div class="row" style="background-color: #78909c ; padding-top: 10px;">
          <div class="col-md-3">
              <div class="card">
                  <div class="card-body">
                      <label for="name" accesskey="U"><span class="required">*</span>Live Product Search</label>
                    <input type="text" class="form-control" autofocus="autofocus" placeholder="Search By Product Name" id="myInput" onkeyup="myFunctionR()">
                  </div>
                </div>
              <?php display_message(); ?>
          </div>
          <div class="col-md-6">
              <div class="card">
                  <div class="card-body">
              <form action="" method="POST">
                           <div class="row">
                               <div class="col-md-12">
                                   
                                       <label for="name" accesskey="U"><span class="required">*</span>Customer Code or Phone Number or Name</label>
                                        <input type="text" name="search_text" id="search_text" placeholder="Search by Customer Details" value="<?php echo $client_name; ?>" class="form-control" />
                                   
                               </div>
                           </div>
                       </form>
                       </div>
              </div>
          </div>
          <div class="col-md-3">
              <div class="card" style="padding: 5px;">
                      <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#exampleModal">
                          <b>Add Customer</b>
                        </button>
                        
                        <!-- Modal Add new Customer -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form method="post" id="insert_form">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Name</label>
                                                <input type="text" name="clientName" class="form-control" id="personName" placeholder="Ex: Client Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Phone Num</label>
                                                <input maxlength="11" type="text" name="hotline" class="form-control" id="phone" placeholder="Ex:01234567891">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email</label>
                                                <input type="email" name="email" class="form-control" id="email" placeholder="Ex: abc@gmail.com" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Address</label>
                                                <input type="text" name="address" class="form-control" id="email" placeholder="Ex: Dhaka" required>
                                            </div>
                                            
                                            <?php
                                                    $query = query("SELECT * FROM admin WHERE username = '" . $_SESSION['username'] . "'");  
                                                    confirm($query);
                                                    $row_of_admin = fetch_array($query);
                                                    $shopkeeper_id = $row_of_admin['id'];
                                                   
                                                           ?>
                                                           <input type="hidden" name="shopkeeper_ID" class="form-control" value="<?php echo $shopkeeper_id; ?>">
                                                           
                                        <div class="">
                                          <input  type="submit" name="insertClient" id="insert" value="Insert" class="btn btn-danger" required>
                                        </div>
                                        
                                        </div>
                                      </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                             <!-- Modal Add new Customer  end-->
                            <form action="" method="POST" style="margin-top:3px;">
                                <input  type="submit" name="unknownCustomers" id="insert" value="Cash Customers" class="btn btn-danger btn-lg btn-block">
                       </form>
              </div>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12">
              <div style="padding: 10px;" id="resultR"></div>
            </div>
        </div>
        
      </div><!-- /.container-fluid -->
    

    <!-- Main content -->
      <div class="container-fluid mt-2">
        <div class="row">
          <div class="col-md-3">
              

            <!-- Profile Image -->
             
            <div class="card card-primary card-outline" id="#mydiv">
               
                
              <div class="card-body box-profile" id="result">
                  
               <ul class="list-group list-group-unbordered" id="myUL">
                  
<?php
    $query = query("SELECT * FROM admin WHERE username = '" . $_SESSION['username'] . "'");  
    confirm($query);
    $row_of_admin = fetch_array($query);
    $shopkeeper_id = $row_of_admin['id']; 
             
               
    $query = query("SELECT * FROM stock WHERE shopkeeper_id='$shopkeeper_id' AND action='SHOW' ORDER BY id DESC");
    confirm($query);
    $rows = mysqli_num_rows($query);
    if($rows > 0){
        $i = 0;
        
        while($row = fetch_array($query)){
            $unit_type = $row['unit_type'];
            
            $pUnitquery = query("SELECT * FROM product_unit_types WHERE id = '$unit_type'");
            confirm($pUnitquery);
            $Unitrow = fetch_array($pUnitquery);
            $Unit_name = $Unitrow['unit_name'];
            
            $image = $row['product_image'];
            ?>
                  <li class="list-group-item itemss"  >
                  
                    <div class="user-block col-md-12">
                        <!--<img class="img-circle img-bordered-sm image" src="<?php //echo $image; ?>">-->
                            <span class="username9" id="username9">
                              <a id="title"  style="font-weight: bold; color: #0069D9;"><?php echo $row['product_name']; ?></a><br>
                            </span>
                            <span class="description9" style="font-weight: bold; font-size: 13px;">Selling Price: <b> <?php echo $row['selling_price']; ?></b></span><br>
                            <span class="description9" style="font-weight: bold; font-size: 13px;">Rest Unit: <?php echo $row['unit']; ?> <?php echo $Unit_name; ?> </span><br>
                            <?php
                            if($row['unit']<11){
                                ?>
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: 100%; margin-bottom: 5px;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Stock Low</div>
                                    </div>
                             <?php   
                            }
                            else{
                                ?>
                                <span class="badge badge-success" style="margin: auto;">Available</span>
                            <?php
                            }
                            if($row['unit'] > 0){
                            ?>
                            <button class = "col-md-12 btn btn-primary addproduct" onclick="myFunction('<?php echo $row['id']; ?>','<?php echo $row['product_name']; ?>','<?php echo $row['selling_price']; ?>')">Add me</button> 
                            <?php 
                            }
                            else{
                                ?>
                                <button class = "col-md-12 btn btn-warning">Stock Out</button> 
                            <?php
                            }
                            ?>
                       
                    </div>
                 
                  </li>        
         <?php            
            
        }
    }

    
?>
         
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
          <div class="col-md-9">
          
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                
                
     <!-- Product selling list Start -->
                           
<div class="row">
    <div class="col-md-12">
        <div class="card">
    <div class="card-body">
        <h4 class="card-title"></h4>
        <div class="table-responsive">
            <form action="" method="post">
                    
                
            <table id="mainTable" class="table editable-table table-bordered  table-sm mb-0">
                <thead>
                    <tr style="background-color:#1769aa;color:#fff;">
                   <th style="padding: 10px 7px;">Product Name</th>
                   <th style=" width: 23%;padding: 10px 7px;">Quantity</th>
                   <th style="padding: 10px 7px;">Price</th>
                   <th style="padding: 10px 7px;">Total Price</th>
                    <th style="padding: 10px 7px;">Action</th>
           
               </tr>
                </thead>
                <tbody id = "demo" class="demo">
                    
                    
                </tbody>
                <tfoot>
                <tr>
                        <th></th>
                        <th>Total Gross</th>
                        <th></th>
                        <th>
                            <input type="text" id = "sums" name="subtotal" value = "" class="form-control" readonly></input>
                            <!--<span class="sum" id="sum">0</span>-->
                            <!--<input type="text" id="sums" name="subtotal"></input>-->
                        </th>
                    </tr>
                    
                    <?php
                     $existing_vat_query = query("SELECT * FROM vat WHERE shop_id = '$shopkeeper_id'");
                     confirm($existing_vat_query);
                     $vat_row = fetch_array($existing_vat_query);
                     $vat_status = $vat_row['vat_status'];
                     $vat_rate = $vat_row['vat_rate'];
                     $discount_type = $vat_row['discount_type'];
                     
                     if($vat_status == "Yes" && $discount_type == 'no'){
                         ?>
                         <tr>
                                <th></th>
                                <th>VAT(%)</th>
                                <th><input type="number" id = "vat" name="vat" value="<?php echo $vat_rate; ?>" class="form-control" readonly></input></th>
                                <th>
                                    <input type="text" id = "vat_price" name="vat_price" value="0" class="form-control" step=any readonly></input>
                                </th>
                            </tr>
                            <!--for due-->
                            <tr>
                                <th></th>
                                <th>Total with Vat</th>
                                <th></th>
                                <th>
                                <input type="text" id="only_vat_total" name="total_vat_tk" value="0" class="form-control" readonly>
                                </th>
                            </tr>
                            <tr style="background-color: #E2686D;">
                            <th></th>
                            <th>Previous Due</th>
                            <th></th>
                            <th>
                            <input type="text" id = "due_per_with_vat_only" name="only_prev_due" value = "<?php if(!empty($clientDue)){ echo $clientDue; } else{ echo 0;} ?>" class="form-control" readonly>
                            </th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>Total Payable</th>
                                <th></th>
                                <th>
                                <input type="text"  id="only_vat" name="only_total_payable" class="form-control" readonly />
                                </th>
                                </tr>
                                <tr>
                                   <th></th>
                                    <th id = "">Paid</th>
                                    <th></th>
                                    <th>
                                    <input type="text" name="only_paid" id="only_vat_paid" class="form-control"  value=""  required>
                                    </th>
                                </tr>
                                <tr>
                                   <th></th>
                                    <th id = ""></th>
                                    <th>Current Due</th>
                                    <th>
                                    <input type="text" name="cur_due" id="currentDue" class="form-control" required value="0" step=any readonly>
                                                                    </th>
                                                                </tr>
                            <?php  
                             
                            
                           
                           
                     }
                    
                     // discount taka
                     if($discount_type == 'tk' ){
                         ?>
                         <tr>
                            <th></th>
                            <th>Discount TK</th>
                            <th><input type="number" id = "discount" name="discount" value="0" class="form-control" ></input></th>
                            <th>
                                <input type="text" id = "discount_price" name="discount_price" value="0" class="form-control" readonly ></input>
                            </th>
                        </tr><?php
                         if($vat_status == "Yes"){
                             ?>
                              <tr>
                                <th></th>
                                <th>VAT(%)</th>
                                <th><input type="number" id = "vat" name="vat" value="<?php echo $vat_rate; ?>" class="form-control" readonly></input></th>
                                <th>
                                    <input type="number" id = "vat_price" name="vat_price" value="0" class="form-control" step=any readonly></input>
                                </th>
                            </tr>
                             <tr>
                                    <th></th>
                                    <th id = "">Total with Vat</th>
                                    <th></th>
                                    <th>
                                        <input type="text" id = "total_with_tk" name="total_vat_tk" value = "" class="form-control" readonly></input>
                                    </th>
                                </tr>
                             <tr>
                                <th></th>
                                <th id = "">Total</th>
                                <th></th>
                                <th>
                                    <input type="text" id = "totalss" name="sub_total_price_with_discount" value = "" class="form-control" readonly>
                                </th>
                            </tr>
                            
                             <!--for due-->
                            <tr style="background-color: #E2686D;">
                                    <th></th>
                                    <th>Previous Due</th>
                                    <th></th>
                                    <th>
                                        <input type="text" id = "due_per_with_vat" name="only_prev_due" value = "<?php if(!empty($clientDue)){ echo $clientDue; } else{ echo 0;} ?>" class="form-control" readonly>
                                    </th>
                                </tr>
                            <tr>
                                <th></th>
                                <th>Total Payable</th>
                                <th></th>
                                <th>
                                   <input type="text" name="only_total_payable" id="total_for_discount_taka_with_vat" class="form-control" readonly />
                                </th>
                            </tr>
                            <tr>
                                <th></th>
                                <th id = "">Paid</th>
                                <th></th>
                                <th>
                                   <input type="text" name="only_paid" id="paid" class="form-control"  value="" step=any required>
                                </th>
                            </tr>
                            <tr>
                        <th></th>
                        <th id = ""></th>
                        <th>Current Due</th>
                        <th>
                           <input type="text" name="cur_due" id="currentDue" class="form-control" required value="0" step=any readonly>
                        </th>
                    </tr>
                            
                            
                            
                            
                    
                             <?php
                         }
                         else{
                             
                             ?>
                            
                             <tr>
                        <th></th>
                        <th id = "">Total with Discount</th>
                        <th></th>
                        <th>
                            <input type="text" id = "totals" name="" value = "" class="form-control" readonly></input>
                        </th>
                    </tr>
                    
                    <!--for due-->
                    <tr style="background-color: #E2686D;">
                            <th></th>
                            <th>Previous Due</th>
                            <th></th>
                            <th>
                                <input type="text" id = "due_per" name="only_prev_due" value = "<?php if(!empty($clientDue)){ echo $clientDue; } else{ echo 0;} ?>" class="form-control" readonly></input>
                            </th>
                        </tr>
                    <tr>
                        <th></th>
                        <th id = "">Total Payable</th>
                        <th></th>
                        <th>
                           <input type="text" name="only_total_payable" id="total_for_discount_taka" class="form-control" required value="0" readonly />
                        </th>
                    </tr>
                    <tr>
                        <th></th>
                        <th id = "">Paid</th>
                        <th></th>
                        <th>
                           <input type="text" name="only_paid" id="paid_tk_without_vat" class="form-control"  value="" step=any required>
                        </th>
                    </tr>
                    <tr>
                        <th></th>
                        <th id = ""></th>
                        <th>Current Due</th>
                        <th>
                           <input type="text" name="cur_due" id="currentDue" class="form-control" required value="0" step=any readonly>
                        </th>
                    </tr>
                    
                    
                    
                    
                    
                  
                             <?php
                         }
                     }
                     // discount percentage
                      if($discount_type == 'parcent'){
                         ?>
                         <tr>
                            <th></th>
                            <th>Discount Percent(%)</th>
                            <th><input type="number" id = "dics_per" name="discount_percent_rate" value="0" class="form-control" ></input></th>
                            <th>
                                <input type="text" id = "dics_per_price" name="dics_per_price" value="0" class="form-control" readonly ></input>
                            </th>
                        </tr><?php
                       
                        if($vat_status == "Yes"){
                            ?>
                             <tr>
                                <th></th>
                                <th>VAT(%)</th>
                                <th><input type="number" id = "vat" name="vat" value="<?php echo $vat_rate; ?>" class="form-control" readonly></input></th>
                                <th>
                                    <input type="number" id = "vat_price" name="vat_price" value="0" class="form-control" step=any readonly></input>
                                </th>
                            </tr>
                             <tr>
                                    <th></th>
                                    <th id = "">subtotal with vat </th>
                                    <th></th>
                                    <th>
                                        <input type="text" id = "total_with_percentage_taka" name="total_vat_tk" value = "" class="form-control" readonly></input>
                                    </th>
                                </tr>
                            <tr>
                                <th></th>
                                <th id = "">Total</th>
                                <th></th>
                                <th>
                                    <input type="text" id = "total_payable_with_vat" name="sub_total_price_with_discount" value = "0" class="form-control" readonly></input>
                                </th>
                            </tr>
                            <!--for due with vat-->
                    <tr style="background-color: #E2686D;">
                            <th></th>
                            <th>Previous Due</th>
                            <th></th>
                            <th>
                                <input type="text" id = "due_per_dis_vat" name="only_prev_due" value = "<?php if(!empty($clientDue)){ echo $clientDue; } else{ echo 0;} ?>" class="form-control" readonly></input>
                            </th>
                        </tr>
                    <tr>
                        <th></th>
                        <th id = "">Total Payable</th>
                        <th></th>
                        <th>
                           <input type="text" name="only_total_payable" id="total_for_discount_vat" class="form-control" required value="0" readonly>
                        </th>
                    </tr>
                    <tr>
                        <th></th>
                        <th id = "">Paid</th>
                        <th></th>
                        <th>
                           <input type="text" name="only_paid" id="paid_with_discount_percentage" class="form-control"  value="" step=any required>
                        </th>
                    </tr>
                    <tr>
                        <th></th>
                        <th id = ""></th>
                        <th>Current due</th>
                        <th>
                           <input type="text" name="cur_due" id="currentDue" class="form-control" required value="0" step=any readonly>
                        </th>
                    </tr>
                            <?php
                        }
                        else
                        {
                            ?>
                            <tr>
                                <th></th>
                                <th id = "">Total without vat</th>
                                <th></th>
                                <th>
                                    <input type="text" id = "without_vat" name="without_vat" value = "0" class="form-control" readonly></input>
                                </th>
                            </tr>
                            <!--for due-->
                    <tr style="background-color: #E2686D;">
                            <th></th>
                            <th>Previous Due</th>
                            <th></th>
                            <th>
                                <input type="text" id = "due_per_dis" name="only_prev_due" value = "<?php if(!empty($clientDue)){ echo $clientDue; } else{ echo 0;} ?>" class="form-control" readonly></input>
                            </th>
                        </tr>
                    <tr>
                        <th></th>
                        <th id = "">Total Payable</th>
                        <th></th>
                        <th>
                           <input type="text" name="only_total_payable" id="total_for_discount" class="form-control" required value="0" readonly />
                        </th>
                    </tr>
                    <tr>
                        <th></th>
                        <th id = "">Paid</th>
                        <th></th>
                        <th>
                           <input type="text" name="only_paid" id="paid_with_discount_percentage_without_vat" class="form-control"  value="" step=any required>
                        </th>
                    </tr>
                    <tr>
                        <th></th>
                        <th id = ""></th>
                        <th>Current Due</th>
                        <th>
                           <input type="text" name="cur_due" id="currentDue" class="form-control" required value="0" step=any readonly>
                        </th>
                    </tr>
                            <?php
                        }
                       
                   
                     }
                     
                     
                    //  no vat no discount
                     if($vat_status == "No" && $discount_type == 'no'){
                         ?>
                         <!--for due-->
                                                                        
                        <tr style="background-color: #E2686D;">
                                <th></th>
                                <th>Previous Due</th>
                                <th></th>
                                <th>
                                    <?php
                                        if($clientDue > 0){
                                            ?>
                                            <input type="text" id = "due_for_no_vat_no_dis" name="only_prev_due" value = "<?php  echo $clientDue; ?>" class="form-control" readonly>
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <input type="text" id = "due_for_no_vat_no_dis" name="only_prev_due" value = "0" class="form-control" readonly>
                                            <?php
                                        }
                                    ?>
                                </th>
                            </tr>
                        <tr>
                            <th></th>
                            <th>Total Payable</th>
                            <th></th>
                            <th>
                                        <input type="text"  id="no_vat_no_dis_total"  name="only_total_payable" class="form-control" readonly />
                            </th>
                        </tr>
                            <tr>
                                <th></th>
                                <th id = "">Paid</th>
                                <th></th>
                                <th>
                                 <input type="text" name="only_paid" id="no_dis_no_vat_paid" class="form-control" required>
                                </th>
                            </tr>
                            <tr>
                        <th></th>
                        <th id = ""></th>
                        <th>Current Due</th>
                        <th>
                                    <input type="text" name="cur_due" id="currentDue" class="form-control" required value="0" step=any readonly>
                        </th>
                    </tr>
                         <?php
                     }
                    ?>
                   
                </tfoot>
            </table>
            
                <hr class="bg-warning">
                <!--cash on delivery start-->
                <div class="form-group">
                                                        <label for="exampleInputEmail1">Cash on delivery</label>
                                                        <div class="form-check form-check-inline" style="margin-left: 10px;">
                                                          <input class="form-check-input" type="radio" name="receivedBy" id="inlineRadio1" value="cash">
                                                          <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                          <input class="form-check-input" type="radio" name="receivedBy" id="inlineRadio2" value="check">
                                                          <label class="form-check-label" for="inlineRadio2">No</label>
                                                        </div>
                                                      </div>
                
                                                      
                                                      
                <!--This is for cash -->
                <?php
                $qry_delivery_man=query("SELECT * FROM `delivery_man` WHERE shop_id='$shopkeeper_id' AND action='SHOW' ");
                confirm($qry_delivery_man);
                $delivery_man_rows=mysqli_num_rows($qry_delivery_man);
                                                     
                ?>
                <div id="cashForm" class="card" style="background-color: #F4F4F4; padding: 20px; display: none">
                                                            <div class="form-group row">
                                                                <label for="delivery_man_id" class="col-sm-2 col-form-label">Delivery Man</label>
                                                                <div class="col-sm-10">
                                                                    <select name="delivery_man_id" id="delivery_man_id" class="form-control">
                                                                        <?php
                                                                        if($delivery_man_rows>0){
                                                                            
                                                                            while( $delivery_man_row=fetch_array($qry_delivery_man)){
                                                                                ?>
                                                                                <option value="<?php echo $delivery_man_row['id']?>"><?php echo $delivery_man_row['name']?></option>
                                                                                <?php
                                                                            
                                                                        }
                                                                        }
                                                                        
                                                                        ?>
                                                                        
                                                                        
                                                                      </select>
                                                                </div>
                                                              </div>
                                                            
                                                              <div class="form-group row">
                                                                <label for="Delivery_man_charge" class="col-sm-2 col-form-label">Delivery Charge</label>
                                                                <div class="col-sm-10">
                                                                  <input type="text" class="form-control" id="Delivery_man_charge" name="Delivery_man_charge">
                                                                </div>
                                                              </div>
                                                              <input type="hidden" class="form-control" id="delivery_man_sts" name="delivery_man_sts" value="delivery_man" >
                                                        </div>
                <!--This is for check-->
                <div id ="checkForm" style="display:none;"></div>    
                <!--Cash on delivery end-->
                <hr class="bg-warning">
                <div class="row">
                        </div>
                <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                            <label for="date">Date</label>
                                            <input type="text" name="date" id="date" class="form-control" required value="<?php echo date("yy-m-d");?>">
                                            <!--<p>Date: <input type="text" id="date" value="<?php echo date("M/dd/yyyy");?>" ></p>-->
                                       </div>
                            </div>
                            
                        </div>
                        
                <!--sms send start-->
                
                <!--<div class="row">-->
                    
                            <!--<div class="col-md-12">-->
                                 

                                <!--<div class="form-row">-->
                                <!--    <div class="form-group col-md-4">-->
                                        <!--<label for="inputPassword4" style="color:#000;">Mobile (Format: 01521202453)</label>-->
                                        <input type="hidden" class="form-control" id="" value="<?php echo $client_name ?>" name="send_sms_client_name" >
                                <!--    </div>-->
                                <!--</div>-->
                                
                                <input type="hidden" class="form-control" id="" value="<?php echo $client_sms_phn ?>" name="phone" >
                                <input type="hidden" class="form-control" id="" value="<?php echo $client_email ?>" name="sms_email" >
                                        <!--<label for="inputPassword4">Message</label>-->
                                       <?php
                                    //   for vat start sms
                                        $existing_vat_query = query("SELECT * FROM vat WHERE shop_id = '$shopkeeper_id'");
                                        confirm($existing_vat_query);
                                        $vat_row = fetch_array($existing_vat_query);
                                        $vat_status = $vat_row['vat_status'];
                                        $vat_rate = $vat_row['vat_rate'];
                                        $discount_type = $vat_row['discount_type'];
                                    //  sms vat end
                                       
                                       
                                        $query = query("SELECT * FROM admin WHERE username = '" . $_SESSION['username'] . "'");  
                                        confirm($query);
                                        $row_of_admin = fetch_array($query);
                                        $shopkeeper_id = $row_of_admin['id']; 
                                        // quoatation
                                        $qry_quote=query("SELECT * FROM quotation WHERE shopkeeper_id='$shopkeeper_id'  ");
                                        $qry_quote_row=fetch_array($qry_quote);
                                        
                                        // only vat sms
                                        if($vat_status == "Yes" && $discount_type == 'no'){
                                            ?>
                                            <textarea  hidden  name="msg" class="form-control" id="" cols="30" rows="10" placeholder="SMS Details">Thank you for purchasing the product from <?php echo $shop_name?>.&#013;Regards : <?php echo $shop_name?>.&#013;Contact Us : <?php echo $row_of_shop_setting['shop_phone_1']?>,<?php echo $row_of_shop_setting['shop_phone_2']?>.&#013;Previous Due : <?php echo $clientDue; ?>.</textarea><br/>
                                        <input type=hidden name="sms_total_payable" id="send_vat"></input></br>
                                        <input type=hidden name="sms_total_paid" id="send_vat_paid"></input></br>
                                        <input type="hidden" name="sms_due" id="sms_due"></input><br/>
                                            <?php
                                        }
                                        // discount taka sms start
                                        if($discount_type == 'tk' ){
                                          ?><textarea hidden   name="msg" class="form-control" id="" cols="30" rows="10" placeholder="SMS Details">Thank you for purchasing the product from <?php echo $shop_name?>.&#013;Regards : <?php echo $shop_name?>.&#013;Contact Us : <?php echo $row_of_shop_setting['shop_phone_1']?>,<?php echo $row_of_shop_setting['shop_phone_2']?>.&#013;Previous Due : <?php echo $clientDue; ?>.</textarea><br/><?php  
                                            if($vat_status == "Yes"){
                                                ?>
                                                
                                        <input type=hidden name="sms_total_payable" id="send_sms_vat_tk_discount"></input></br>
                                        <input type=hidden name="sms_total_paid" id="send_sms_vat_discount_tk_paid"></input></br>
                                        <input type="hidden" name="sms_due" id="sms_due_vat_discount_tk"></input><br/>
                                                <?php
                                            }
                                            else{
                                                ?>
                                            
                                            
                                        <input type=hidden name="sms_total_payable" id="send_sms_only_tk_discount"></input></br>
                                        <input type=hidden name="sms_total_paid" id="send_sms_only_discount_tk_paid"></input></br>
                                        <input type="hidden" name="sms_due" id="sms_due_only_discount_tk"></input><br/>
                                            <?php
                                            }
                                            
                                            
                                            
                                        }
                                        // discount taka sms end
                                        
                                        // discount percentage  no vat 
                                        if($discount_type == 'parcent')
                                        {
                                            ?><textarea  hidden  name="msg" class="form-control" id="" cols="30" rows="10" placeholder="SMS Details">Thank you for purchasing the product from <?php echo $shop_name?>.&#013;Regards : <?php echo $shop_name?>.&#013;Contact Us : <?php echo $row_of_shop_setting['shop_phone_1']?>,<?php echo $row_of_shop_setting['shop_phone_2']?>.&#013;Previous Due : <?php echo $clientDue; ?>.</textarea><br/><?php
                                             if($vat_status == "Yes"){
                                                 ?>
                                            <input type=hidden name="sms_total_payable" id="send_sms_vat_percentage_discount"></input></br>
                                            <input type=hidden name="sms_total_paid" id="send_sms_vat_discount_percentage_paid"></input></br>
                                            <input type="hidden" name="sms_due" id="sms_due_vat_discount_percentage"></input><br/>
                                            <?php
                                             }
                                             else
                                             {
                                                 ?>
                                            <input type=hidden name="sms_total_payable" id="send_sms_only_percentage_discount"></input></br>
                                            <input type=hidden name="sms_total_paid" id="send_sms_only_discount_percentage_paid"></input></br>
                                             <input type="hidden" name="sms_due" id="sms_due_only_discount_percentage"></input><br/>
                                            <?php
                                             }
                                            
                                        }
                                        
                                        // no vat no discount
                                        if($vat_status == "No" && $discount_type == 'no'){
                                            ?>
                                            <textarea  hidden  name="msg" class="form-control" id="" cols="30" rows="10" placeholder="SMS Details">Thank you for purchasing the product from <?php echo $shop_name?>.&#013;Regards : <?php echo $shop_name?>.&#013;Contact Us : <?php echo $row_of_shop_setting['shop_phone_1']?>,<?php echo $row_of_shop_setting['shop_phone_2']?>.&#013;Previous Due : <?php echo $clientDue; ?>.</textarea><br/>
                                         <input type=hidden name="sms_total_payable" id="send_sms_no_vat_no_discount"></input></br>
                                         <input type=hidden name="sms_total_paid" id="send_sms_no_vat_no_discount_paid"></input></br>
                                        <input type="hidden" name="sms_due" id="sms_due_no_vat_no_discount"></input><br/>
                                            <?php
                                        }
                                        
                                        
                                       ?>
                                      
                                        
                                        
                                        
                                       
                                    
                                
                            <!--</div>-->
                        <!--</div>-->
                        
                        
                        
                    <!--sms send end-->
                    
                <input type="hidden" name="clientCode" id="date" class="form-control" value="<?php echo $clientCode; ?>" required>
                
                   <!--<button type="submit" name="sell" class="btn btn-primary btn-block mt-4">Submit</button>-->
                   
                   <a  data-toggle="modal" data-target="#exampleModalForSell" class="btn btn-primary form-control" style="padding:3px 6px;">Submit</a>
                   
                   
                   
                    <!-- Modal -->
                                                <div class="modal fade" id="exampleModalForSell" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-body">
                                                                <div class="text-info" style="text-align:center;">
                                                                    <i class="fas fa-shopping-cart" style="font-size: 60px;"></i>
                                                                </div>
                                                                <div><h2 class="text-center font-bold">Are You Sure?</h2></div>
                                                                <div><p class="text-center">You will not be able to recover this content!</p></div>
                                                                <div class="row">
                                                                    <div class="col-md-6 text-center"><button type="submit" name="sell" class="btn btn-primary">Sell</button></div>
                                                                    <div class="col-md-6 text-center"><button class="btn btn-danger" data-dismiss="modal">Cancel</button></div>
                                                                </div>
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



<!-- Script for product search End-->



        <?php
         
            if(isset($_POST['sell'])) {
                
                if(!empty($_POST['clientCode'])){
                    
                    
                    $shopkeeper_id = $shopkeeper_id;
                    $client_code = $_POST['clientCode'];
                    
                    
                    //$shopkeeper_id = $shopkeeper_id;
                    
                    $pid = $_POST['pid'];
                    $quantity   =   $_POST['quantity'];
                    $price = $_POST['price'];
                    $count = count($_POST['pid']);
                    $total = $_POST['total'];
                    //$subtotal = $_POST['subtotal'];
                    $date = $_POST['date'];
                    //$paid = $_POST['paid'];
                    //$mid = -1;
                    //$cid = 2234;
                    
                    
                    
                    $vat_percent_rate = $_POST['vat'];
                    $vat_tk = $_POST['vat_price'];
                    // $discount_percent_rate = $_POST['dics_per'];
                    
                    $previousDue = $_POST['only_prev_due'];
                    
                    
                    
                    $total_with_percentage_taka=$_POST['total_with_percentage_taka'];
                    $total_payable_with_vat=$_POST['total_payable_with_vat'];
                    $due_per_dis_vat=$_POST['due_per_dis_vat'];
                    $total_for_discount_vat=$_POST['total_for_discount_vat'];
                    $paid_with_discount_percentage=$_POST['paid_with_discount_percentage'];
                    $currentDue=$_POST['currentDue'];
                    $without_vat=$_POST['without_vat'];
                    $due_per_dis=$_POST['due_per_dis'];
                    $total_for_discount=$_POST['total_for_discount'];
                    $paid_with_discount_percentage_without_vat=$_POST['paid_with_discount_percentage_without_vat'];
                    
                    // no vat no disc
                    $no_vat_no_dis_total=$_POST['only_total_payable'];
                    $cur_due=$_POST['cur_due'];
                    $only_paid=$_POST['only_paid'];
                    $only_prev_due=$_POST['only_prev_due'];
                    $discount_percent_rate  =   $_POST['discount_percent_rate'];
                    $discount_percent_tk = $_POST['dics_per_price'];
                    $sub_total_price_with_discount=$_POST['sub_total_price_with_discount'];
                    $total_vat_tk=$_POST['total_vat_tk'];
                    $discount_amount=$_POST['discount_price'];
                    
                    //subtotal price
                    $subtotal = $_POST['subtotal'];
                    //$discount_amount = $_POST['discount'];
                    $total_payable_with_discount = $_POST['total_payable_with_discount'];
                    
                    // for last id + 1 start;
                    $invoice_id = query("SELECT * FROM product_sell ORDER BY id DESC");
                    confirm($invoice_id);
                    $row = fetch_array($invoice_id);
                    $last_id = $row['id'];
                    // for last id + 1 End;
                    $invoice_id = $last_id+1;
                    $action = "Pending";
                
                   //for unknown client check
                    $unknown_q = query("SELECT * FROM clients WHERE code ='$client_code' AND shop_id='$shopkeeper_id'");
                    confirm($unknown_q);
                    $client_row = fetch_array($unknown_q);
                    $client_name = $client_row['name'];
                    
                    //delivery Man
                    $delivery_man_id=$_POST['delivery_man_id'];
                    $Delivery_man_charge=$_POST['Delivery_man_charge'];
                    $delivery_man_sts=$_POST['delivery_man_sts'];
                   
                    if($client_name == 'Unknown'){
                        if($no_vat_no_dis_total == $only_paid){
                            
                            for($i = 0; $i < $count; $i++){
                                $query = query("INSERT INTO product_sell(shopkeeper_id, product_id, quantity, price, total_price, invoice_id) VALUES ('$shopkeeper_id' ,'$pid[$i]','$quantity[$i]', '$price[$i]', '$total[$i]', '$invoice_id')");
                                confirm($query);
                                
                                $unit = $quantity[$i];
                                $pID =  $pid[$i];
                                    
                                $product_code_search_query = query("SELECT * FROM stock WHERE id = '$pID'");
                                confirm($product_code_search_query);
                                $row_of_stock = fetch_array($product_code_search_query);
                                $p_code = $row_of_stock['code'];
                                $current_unit = $row_of_stock['unit'];
                                
                                $update_unit = $current_unit - ($unit);
                                
                                $query_for_stock = query("INSERT INTO product_stock(shop_id, product_id, product_code, quantity, status, current_quantity) VALUES('$shopkeeper_id', '$pID', '$p_code', '$unit', '0','$update_unit')");
                                confirm($query_for_stock);
                                
                                $query_for_update_product_unit = query("UPDATE stock SET unit = '$update_unit' WHERE id='$pID' AND code='$p_code'");
                                confirm($query_for_update_product_unit);
                            }
                            
                            $query1 = query("INSERT INTO `quotation`(`shopkeeper_id`, `client_code`, `invoice_id`, `subTotal_price`, `discount_amount`, `vat_percent_rate`, `vat_tk`, `total_vat_tk`, `discount_percent_rate`, `discount_percent_tk`, `sub_total_price_with_discount`, `paid`, `action`, `date`, `no_vat_no_dis_total`, `cur_due`, `previous_due`,`delivery_man_id`,`Delivery_man_charge`,`delivery_man_sts`) VALUES ('$shopkeeper_id', '$client_code', '$invoice_id', '$subtotal', '$discount_amount', '$vat_percent_rate', '$vat_tk','$total_vat_tk','$discount_percent_rate','$discount_percent_tk','$sub_total_price_with_discount','$only_paid','$action','$date','$no_vat_no_dis_total','$cur_due','$previousDue','$delivery_man_id','$Delivery_man_charge','$delivery_man_sts')");
                            
                            confirm($query1);
                            
                            $query_up_client=query("UPDATE clients SET due = '$cur_due' WHERE code ='$client_code' ");
                            
                            // for net Balance Update
                            $netBalanceQuery = query("SELECT * FROM net_income WHERE shop_id ='$shopkeeper_id'");
                            confirm($netBalanceQuery);
                            $rowOfNetBl = fetch_array($netBalanceQuery);
                            $netBl = $rowOfNetBl['netBalance'];
                            
                            $_SESSION['netBalance'] = $netBl;
                            $netBl = $_SESSION["netBalance"];
                            
                            $updateIncomeBalance = $netBl + $only_paid;
                            $query_Net_income_balance = query("UPDATE net_income SET netBalance = '$updateIncomeBalance' WHERE shop_id ='$shopkeeper_id'");
                            confirm($query_Net_income_balance);
                            
        
        
                               echo "<script type='text/javascript'>
                                    window.location = 'quotation-status.php?invoice=$invoice_id';
                                    </script>";
                        }
                        else{
                            set_message('<h1 class="m-0 text-dark bg-danger text-center" style="padding: 10px; border-radius: 20px;">For Cash Customer Must Same Total Payable = Paid</h1>');
                            redirect("index.php?sellProduct");
                        }
                    }
                    
                    else{
                        
                        for($i = 0; $i < $count; $i++){
                        $query = query("INSERT INTO product_sell(shopkeeper_id, product_id, quantity, price, total_price, invoice_id) VALUES ('$shopkeeper_id' ,'$pid[$i]','$quantity[$i]', '$price[$i]', '$total[$i]', '$invoice_id')");
                        confirm($query);
                        
                        $unit = $quantity[$i];
                        $pID =  $pid[$i];
                            
                            
                        $product_code_search_query = query("SELECT * FROM stock WHERE id = '$pID'");
                        confirm($product_code_search_query);
                        $row_of_stock = fetch_array($product_code_search_query);
                        $p_code = $row_of_stock['code'];
                        $current_unit = $row_of_stock['unit'];
                        
                        $update_unit = $current_unit - ($unit);
                        
                        $query_for_stock = query("INSERT INTO product_stock(shop_id, product_id, product_code, quantity, status, current_quantity) VALUES('$shopkeeper_id', '$pID', '$p_code', '$unit', '0','$update_unit')");
                        confirm($query_for_stock);
                        
                        $query_for_update_product_unit = query("UPDATE stock SET unit = '$update_unit' WHERE id='$pID' AND code='$p_code'");
                        confirm($query_for_update_product_unit);
                    }
                    
                    $query1 = query("INSERT INTO `quotation`(`shopkeeper_id`, `client_code`, `invoice_id`, `subTotal_price`, `discount_amount`, `vat_percent_rate`, `vat_tk`, `total_vat_tk`, `discount_percent_rate`, `discount_percent_tk`, `sub_total_price_with_discount`, `paid`, `action`, `date`, `no_vat_no_dis_total`, `cur_due`, `previous_due`) VALUES ('$shopkeeper_id', '$client_code', '$invoice_id', '$subtotal', '$discount_amount', '$vat_percent_rate', '$vat_tk','$total_vat_tk','$discount_percent_rate','$discount_percent_tk','$sub_total_price_with_discount','$only_paid','$action','$date','$no_vat_no_dis_total','$cur_due','$previousDue')");
                    
                    confirm($query1);
                    
                    $query_up_client=query("UPDATE clients SET due = '$cur_due' WHERE code ='$client_code'");
                    
                    // for net Balance Update
                    $netBalanceQuery = query("SELECT * FROM net_income WHERE shop_id ='$shopkeeper_id'");
                    confirm($netBalanceQuery);
                    $rowOfNetBl = fetch_array($netBalanceQuery);
                    $netBl = $rowOfNetBl['netBalance'];
                    
                    $_SESSION['netBalance'] = $netBl;
                    $netBl = $_SESSION["netBalance"];
                    
                    $updateIncomeBalance = $netBl + $only_paid;
                    $query_Net_income_balance = query("UPDATE net_income SET netBalance = '$updateIncomeBalance' WHERE shop_id ='$shopkeeper_id'");
                    confirm($query_Net_income_balance);
                    
                    
                    
                    


                       echo "<script type='text/javascript'>
                            window.location = 'quotation-status.php?invoice=$invoice_id';
                            </script>";
                            
                            
                            
                          //sms
                          //getting the text data from the fields
                          
                          
                          
                        $sms_text="Thank you for purchasing the product from FARA IT Fusion.</br>
                            Previous Due : 500.00.</br>
                            Total Bill:520</br>
                            Paid:20</br>
                            Due:500.</br>
                            Regards : FARA IT Fusion.</br>
                            Contact Us : 01758633337,12365478994.";    
                          
                          //shop setting query start
                  $query_shop_setting = query("SELECT * FROM shop_setting WHERE shop_id='$shopkeeper_id' ");  
                 confirm($query_shop_setting);
                 $row_of_shop_setting = fetch_array($query_shop_setting);
                 $shop_name = $row_of_shop_setting['shop_name']; 
                 $shop_logo_send_email=$row_of_shop_setting['shop_logo'];
                 $urlpre = "http://pos.faraitfusion.com/";
                //  select product 
                $send_qry_product=query("SELECT * FROM stock WHERE shop_id='$shopkeeper_id' AND  id='$product_id' "); 
                $send_row_product=fetch_array($send_qry_product);
                $product_name_send=$send_row_product['product_name'];
	   
	                    $mobile=$_POST['phone'];
	                    $details=$_POST['msg'] . "\nTotal Bill : " . $_POST['sms_total_payable'] . "\nTotal Paid : " . $_POST['sms_total_paid'] . "\nDue : " . $_POST['sms_due'];
	                    $client_email_sms=$_POST['sms_email'];
	                    $send_sms_client_name=$_POST['send_sms_client_name'];
	                    
	                    $CRMSMSresponse = techno_bulk_sms_sell($mobile,$details);
	                    echo $CRMSMSresponse;
                            
                         $date_sms   = date("d-M-Y g:iA");
                         $mobile_sms=escape_string($_POST['phone']);
                    	 $details_sms=escape_string($_POST['msg'] . "\nTotal Bill :  " . $_POST['sms_total_payable'] . "\nTotal Paid : " . $_POST['sms_total_paid'] . "\nDue : " . $_POST['sms_due']);
                    	 $insert_query=query("INSERT INTO sms(phone,msg,date,shop_id) VALUES ('$mobile_sms','$details_sms','$date_sms','$shopkeeper_id')");
                    	 confirm($insert_query);    
                    	 
                    	 
                    	 // email session
                    //  $client_email= $serchrow['email'];
                    // $_SESSION['clientemail'] = $client_email;
                    // $client_email = $_SESSION["clientemail"];
                    	 //send email start
                    	 
                    	 
                    	 
                                $to = $client_email_sms;
                                $subject = "Invoice Report";
                                
                                // $message .= "<b>Invoice Report</b>";
                                
                                // $message=  $_POST['msg'] ."\n" ;
                                // $message.= 'Total Bill : '. $_POST['sms_total_payable'] . "\n" . 'Total Paid :'. $_POST['sms_total_paid']."\n" . 'Due :'. $_POST['sms_due'];
                                 $message = '<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%;" class="background">
    <tr>
        <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;" bgcolor="#F0F0F0">

            <!-- WRAPPER -->
            <!-- Set wrapper width (twice) -->
            <table border="0" cellpadding="0" cellspacing="0" align="center" width="560" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;
	max-width: 560px;" class="wrapper">

                <tr>
                    <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
			padding-top: 20px;
			padding-bottom: 20px;">

                        <!-- PREHEADER -->
                        <!-- Set text color to background color -->
                        <div style="display: none; visibility: hidden; overflow: hidden; opacity: 0; font-size: 1px; line-height: 1px; height: 0; max-height: 0; max-width: 0;
			color: #F0F0F0;" class="preheader">
                            Available on&nbsp;GitHub and&nbsp;CodePen. Highly compatible. Designer friendly. More than 50%&nbsp;of&nbsp;total email opens occurred on&nbsp;a&nbsp;mobile device&nbsp;— a&nbsp;mobile-friendly design is&nbsp;a&nbsp;must for&nbsp;email campaigns.</div>


                    </td>
                </tr>

                <!-- End of WRAPPER -->
            </table>

            <!-- WRAPPER / CONTEINER -->
            <!-- Set conteiner background color -->
            <table border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#FFFFFF" width="560" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;max-width: 560px;" class="container">


                <tr>
                    <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;
			padding-top: 20px;" class="hero"><a target="_blank" style="text-decoration: none;" href="#"><img  src="'.$urlpre.$shop_logo_send_email.'" style="width:200px; max-width:600px; height: 100px; max-height:300px;"></a></td>
                </tr>

                <!-- PARAGRAPH -->
                <!-- Set text color and font family ("sans-serif" or "Georgia, serif"). Duplicate all text styles in links, including line-height -->
                <tr>
                    <td align="justify" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%;padding-top: 25px; color: #000000;
			font-family: sans-serif;" class="paragraph;">
			            Hello,'.$send_sms_client_name.'<br/>
                        Thank you for purchasing product from '.$shop_name.' .<br>
                        Thanks for shopping with us.<br>
                        Regards,<br>
                       '.$shop_name.'
                    </td>
                </tr>

                <!-- LIST -->
                <tr>
                    <td align="justify" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%;padding-top: 25px; color: #000000;
			font-family: sans-serif;" class="paragraph;">
			            <table border="1" class="wrapper" style="width:500px !important; background-color: #fff !important;color:#000;">

                <!-- SOCIAL NETWORKS -->
                <!-- Image text color should be opposite to background color. Set your url, image src, alt and title. Alt text should fit the image size. Real image size should be x2 -->
                <thead>
                    <tr>
                        <th style="padding-top: 25px;">SL.</th>
                        <th style="padding-top: 25px;">Product Name </th>
                        <th style="padding-top: 25px;">Quantity</th>
                        <th style="padding-top: 25px;">Price</th>
                        <th style="padding-top: 25px;">Total Price</th>
                    </tr>

                </thead>
                <tbody>';
                            $query_send_product_email = query("SELECT * FROM product_sell WHERE shopkeeper_id = '$shopkeeper_id' AND invoice_id='$invoice_id' ORDER BY id DESC");
                            $rows_send_email = mysqli_num_rows($query_send_product_email);
                            if($rows_send_email > 0){
                                $i = 1;
                                while($row_send_email=fetch_array($query_send_product_email)){
                                    $product_id_send_email=$row_send_email['product_id'];
                                    $quantity_send_email=$row_send_email['quantity'];
                                    $price_send_email=$row_send_email['price'];
                                    $total_price_send_email=$row_send_email['total_price'];
                                    
                                    $product_id_to_send_email_query = query("SELECT * FROM stock WHERE id = '$product_id_send_email'");
                                    confirm($product_id_to_send_email_query);
                                    $product_row_send_email = fetch_array($product_id_to_send_email_query);
                                    $product_name_send_email = $product_row_send_email['product_name'];
                                    $unit_type_send_email = $product_row_send_email['unit_type'];
                                    
                                    $unitTypeQuery = query("SELECT * FROM product_unit_types WHERE id = '$unit_type_send_email'");
                                    confirm($unitTypeQuery);
                                    $rowOfUnit = fetch_array($unitTypeQuery);
                                    $unit_name_send_email = $rowOfUnit['unit_name'];
                                    $message .= '<tr>
                        <td style="padding-top: 25px;"> '.$i.'</td>
                        <td style="padding-top: 25px;">'.$product_name_send_email.'</td>
                        <td style="padding-top: 25px;">'.$quantity_send_email.' '.$unit_name_send_email.'</td>
                        <td style="padding-top: 25px;">'.$price_send_email.'</td>
                        <td style="padding-top: 25px;">'.$total_price_send_email.'</td>
                    </tr>';
                                    $i++;
                                }
                            }
                                
                
               $message .= ' </tbody>
                <tfoot>
                    <tr>
                    <td style="padding-top: 25px;"></td>
                    <td style="padding-top: 25px;"></td>
                    <td style="padding-top: 25px;"></td>
                    <td style="padding-top: 25px;">Total Gross</td>
                    <td style="padding-top: 25px;">'.$subtotal.'</td>
                </tr>';
                if($previousDue > 0){
                    $message .='<tr>
                    <td style="padding-top: 25px;"></td>
                    <td style="padding-top: 25px;"></td>
                    <td style="padding-top: 25px;"></td>
                    <td style="padding-top: 25px;">Previous Due</td>
                    <td style="padding-top: 25px;">'.$previousDue.'</td>
                </tr>';
                }
                if($vat_percent_rate > 0){
                    $message .='<tr>
                    <td style="padding-top: 25px;"></td>
                    <td style="padding-top: 25px;"></td>
                    <td style="padding-top: 25px;"></td>
                    <td style="padding-top: 25px;">VAT ('.$vat_percent_rate.'%)</td>
                    <td style="padding-top: 25px;">'.$vat_tk.'</td>
                </tr>';
                }
                if($discount_amount > 0){
                    $message .='<tr>
                    <td style="padding-top: 25px;"></td>
                    <td style="padding-top: 25px;"></td>
                    <td style="padding-top: 25px;"></td>
                    <td style="padding-top: 25px;">Discount TK</td>
                    <td style="padding-top: 25px;">'.$discount_amount.'</td>
                </tr>';
                }
                if($discount_percent_rate > 0){
                     $message .='<tr>
                    <td style="padding-top: 25px;"></td>
                    <td style="padding-top: 25px;"></td>
                    <td style="padding-top: 25px;"></td>
                    <td style="padding-top: 25px;">Discount ('.$discount_percent_rate.'%)</td>
                    <td style="padding-top: 25px;">'.$discount_percent_tk.'</td>
                </tr>';
                }
                
                $message .='<tr>
                    <td style="padding-top: 25px;"></td>
                    <td style="padding-top: 25px;"></td>
                    <td style="padding-top: 25px;"></td>
                    <td style="padding-top: 25px;">Total Bill</td>
                    <td style="padding-top: 25px;">'.$no_vat_no_dis_total.'</td>
                </tr>
                <tr>
                    <td style="padding-top: 25px;"></td>
                    <td style="padding-top: 25px;"></td>
                    <td style="padding-top: 25px;"></td>
                    <td style="padding-top: 25px;">Paid</td>
                    <td style="padding-top: 25px;">'.number_format($only_paid,2).'</td>
                </tr>';
               
                    $message .='<tr>
                    <td style="padding-top: 25px;"></td>
                    <td style="padding-top: 25px;"></td>
                    <td style="padding-top: 25px;"></td>
                    <td style="padding-top: 25px;">Due</td>
                    <td style="padding-top: 25px;">'.$cur_due.'</td>
                </tr>
                
                </tfoot>

                

                <!-- FOOTER -->
                <!-- Set text color and font family ("sans-serif" or "Georgia, serif"). Duplicate all text styles in links, including line-height -->


                <!-- End of WRAPPER -->
            </table>
                    </td>
                </tr>
                


                <!-- LINE -->
                <!-- Set line color -->


                <!-- PARAGRAPH -->
                <!-- Set text color and font family ("sans-serif" or "Georgia, serif"). Duplicate all text styles in links, including line-height -->


                <!-- End of WRAPPER -->
            </table>

            <!-- WRAPPER -->
            <!-- Set wrapper width (twice) -->
            



            <!-- End of SECTION / BACKGROUND -->
        </td>
    </tr>
</table>
';
                                $header = "From:info@faraitfusion.com \r\n";
                                
                                $header .= "MIME-Version: 1.0\r\n";
                                $header .= "Content-type: text/html\r\n";
                                
                                $retval = mail ($to,$subject,$message,$header);
                                
                                if( $retval == true ) {
                                echo "Message sent successfully...";
                                }else {
                                echo "Message could not be sent...";
                                }
                                
                        // 	 send email end
                    	 
                            
                            
                    }

                    

                }
                else{
                    
                    // $unknown_client_query = query("SELECT * FROM clients WHERE name ='Unknown' AND shop_id='$shopkeeper_id'");
                    // confirm($unknown_client_query);
                    // $row_of_clients = fetch_array($unknown_client_query);
                    // $client_code = $row_of_clients['code'];
                    // $shopkeeper_id = $shopkeeper_id;
                    // $pid = $_POST['pid'];
                    // $quantity   =   $_POST['quantity'];
                    // $price = $_POST['price'];
                    // $count = count($_POST['pid']);
                    // $total = $_POST['total'];
                    // //$subtotal = $_POST['subtotal'];
                    // $date = $_POST['date'];
                    // //$paid = $_POST['paid'];
                    // //$mid = -1;
                    // //$cid = 2234;
                    
                    
                    
                    // $vat_percent_rate = $_POST['vat'];
                    // $vat_tk = $_POST['vat_price'];
                    // // $discount_percent_rate = $_POST['dics_per'];
                    
                    // $previousDue = $_POST['only_prev_due'];
                    
                    
                    
                    // $total_with_percentage_taka=$_POST['total_with_percentage_taka'];
                    // $total_payable_with_vat=$_POST['total_payable_with_vat'];
                    // $due_per_dis_vat=$_POST['due_per_dis_vat'];
                    // $total_for_discount_vat=$_POST['total_for_discount_vat'];
                    // $paid_with_discount_percentage=$_POST['paid_with_discount_percentage'];
                    // $currentDue=$_POST['currentDue'];
                    // $without_vat=$_POST['without_vat'];
                    // $due_per_dis=$_POST['due_per_dis'];
                    // $total_for_discount=$_POST['total_for_discount'];
                    // $paid_with_discount_percentage_without_vat=$_POST['paid_with_discount_percentage_without_vat'];
                    
                    // // no vat no disc
                    // $no_vat_no_dis_total=$_POST['only_total_payable'];
                    // $cur_due=$_POST['cur_due'];
                    // $only_paid=$_POST['only_paid'];
                    // $only_prev_due=$_POST['only_prev_due'];
                    // $discount_percent_rate  =   $_POST['discount_percent_rate'];
                    // $discount_percent_tk = $_POST['dics_per_price'];
                    // $sub_total_price_with_discount=$_POST['sub_total_price_with_discount'];
                    // $total_vat_tk=$_POST['total_vat_tk'];
                    // $discount_amount=$_POST['discount_price'];
                    
                    // //subtotal price
                    // $subtotal = $_POST['subtotal'];
                    // //$discount_amount = $_POST['discount'];
                    // $total_payable_with_discount = $_POST['total_payable_with_discount'];
                    
                    // // for last id + 1 start;
                    // $invoice_id = query("SELECT * FROM product_sell ORDER BY id DESC");
                    // confirm($invoice_id);
                    // $row = fetch_array($invoice_id);
                    // $last_id = $row['id'];
                    // // for last id + 1 End;
                    // $invoice_id = $last_id+1;
                    
                    // $action = "Pending";
                

                    // for($i = 0; $i < $count; $i++){
                    //     $query = query("INSERT INTO product_sell(shopkeeper_id, product_id, quantity, price, total_price, invoice_id) VALUES ('$shopkeeper_id' ,'$pid[$i]','$quantity[$i]', '$price[$i]', '$total[$i]', '$invoice_id')");
                    //     confirm($query);
                        
                    //     $unit = $quantity[$i];
                    //     $pID =  $pid[$i];
                            
                            
                    //     $product_code_search_query = query("SELECT * FROM stock WHERE id = '$pID'");
                    //     confirm($product_code_search_query);
                    //     $row_of_stock = fetch_array($product_code_search_query);
                    //     $p_code = $row_of_stock['code'];
                    //     $current_unit = $row_of_stock['unit'];
                        
                    //     $update_unit = $current_unit - ($unit);
                        
                    //     $query_for_stock = query("INSERT INTO product_stock(shop_id, product_id, product_code, quantity, status, current_quantity) VALUES('$shopkeeper_id', '$pID', '$p_code', '$unit', '0','$update_unit')");
                    //     confirm($query_for_stock);
                        
                    //     $query_for_update_product_unit = query("UPDATE stock SET unit = '$update_unit' WHERE id='$pID' AND code='$p_code'");
                    //     confirm($query_for_update_product_unit);
                    // }
                    
                    // $query1 = query("INSERT INTO `quotation`(`shopkeeper_id`, `client_code`, `invoice_id`, `subTotal_price`, `discount_amount`, `vat_percent_rate`, `vat_tk`, `total_vat_tk`, `discount_percent_rate`, `discount_percent_tk`, `sub_total_price_with_discount`, `paid`, `action`, `date`, `no_vat_no_dis_total`, `cur_due`, `previous_due`) VALUES ('$shopkeeper_id', '$client_code', '$invoice_id', '$subtotal', '$discount_amount', '$vat_percent_rate', '$vat_tk','$total_vat_tk','$discount_percent_rate','$discount_percent_tk','$sub_total_price_with_discount','$only_paid','$action','$date','$no_vat_no_dis_total','$cur_due','$previousDue')");
                    
                    // confirm($query1);
                    
                    // $query_up_client=query("UPDATE clients SET due = '$cur_due' WHERE code ='$client_code' ");
                    
                    //  // for net Balance Update
                    // $netBalanceQuery = query("SELECT * FROM net_income WHERE shop_id ='$shopkeeper_id'");
                    // confirm($netBalanceQuery);
                    // $rowOfNetBl = fetch_array($netBalanceQuery);
                    // $netBl = $rowOfNetBl['netBalance'];
                    
                    // $_SESSION['netBalance'] = $netBl;
                    // $netBl = $_SESSION["netBalance"];
                    
                    // $updateIncomeBalance = $netBl + $only_paid;
                    // $query_Net_income_balance = query("UPDATE net_income SET netBalance = '$updateIncomeBalance' WHERE shop_id ='$shopkeeper_id'");
                    // confirm($query_Net_income_balance);


                    
                    

                    //   echo "<script type='text/javascript'>
                    //         window.location = 'quotation-status.php?invoice=$invoice_id';
                    //         </script>";
                    
                    set_message('<h1 class="m-0 text-dark bg-danger text-center" style="padding: 10px; border-radius: 20px;">Please Select a Customer</h1>');
                    redirect("index.php?sellProduct");
                    
                    

                }
                

                }
       
            
        
            
  
                  
        ?>
             
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    
  </div>
  <!-- /.content-wrapper -->
   <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>-->
   <style>
       #result{width:259px;height:634px;overflow:auto;overflow-x: hidden;}
   </style>
   <!-- Script for product search Start -->
	

   
  
 <!--Script for product Search Start-->
<script>

function myFunctionR() {
    var input, filter, ul, li, a, x, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (x = 0; x < li.length; x++) {
        a = li[x].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[x].style.display = "";
        } else {
            li[x].style.display = "none";
        }
    }
}
</script>

    