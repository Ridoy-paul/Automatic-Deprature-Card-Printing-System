<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header card">
      <div class="container-fluid">
          <div class="col-md-12">
               <div class="card">
              <div class="card-body">
                  
<?php
                $client_code = $_GET['sellProduct'];
                
                 $query = query("SELECT * FROM admin WHERE username = '" . $_SESSION['username'] . "'");  
                 confirm($query);
                 $row_of_admin = fetch_array($query);
                 $shopkeeper_id = $row_of_admin['id']; 
                         
                
                
                $client_q = query("SELECT * FROM clients where  code='$client_code' AND shop_id='$shopkeeper_id'");
                confirm($client_q);
                while($serchrow=fetch_array($client_q))
                {
                    $client_Code = $serchrow['code'];
                    
                    $_SESSION['clientCode'] = $client_Code;
                    $clientCode = $_SESSION["clientCode"];
                    
                    $client_due= $serchrow['due'];
                    $_SESSION['clientDue'] = $client_due;
                    $clientDue = $_SESSION["clientDue"];
                    $clientDue_discount_tk = $_SESSION["clientDue"];
                    //echo $clientCode;
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
			padding-top: 20px;" class="hero"><a target="_blank" style="text-decoration: none;" href="#"><img  src="'.$shop_logo_send_email.'" style="width:200px; max-width:600px; height: 100px; max-height:300px;"></a></td>
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


                <tr>
                    <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
			padding-top: 25px;
			padding-bottom: 5px;" class="button"><a href="https://github.com/konsav/email-templates/" target="_blank" style="text-decoration: underline;">
                            <table border="0" cellpadding="0" cellspacing="0" align="center" style="max-width: 240px; min-width: 120px; border-collapse: collapse; border-spacing: 0; padding: 0;">

                            </table>
                        </a>
                    </td>
                </tr>

                <!-- LINE -->
                <!-- Set line color -->
                <tr>
                    <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
			padding-top: 25px;" class="line">
                        <hr color="#E0E0E0" align="center" width="100%" size="1" noshade style="margin: 0; padding: 0;" />
                    </td>
                </tr>

                <!-- LIST -->


                <!-- LINE -->
                <!-- Set line color -->


                <!-- PARAGRAPH -->
                <!-- Set text color and font family ("sans-serif" or "Georgia, serif"). Duplicate all text styles in links, including line-height -->


                <!-- End of WRAPPER -->
            </table>

            <!-- WRAPPER -->
            <!-- Set wrapper width (twice) -->
            <table border="1" class="wrapper" style="width:561px !important; background-color: #fff !important;color:#000;">

                <!-- SOCIAL NETWORKS -->
                <!-- Image text color should be opposite to background color. Set your url, image src, alt and title. Alt text should fit the image size. Real image size should be x2 -->
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name </th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total Price</th>
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
                        <td> '.$i.'</td>
                        <td>'.$product_name_send_email.'</td>
                        <td>'.$quantity_send_email.' '.$unit_name_send_email.'</td>
                        <td>'.$price_send_email.'</td>
                        <td>'.$total_price_send_email.'</td>
                    </tr>';
                                    $i++;
                                }
                            }
                                
                
               $message .= ' </tbody>
                <tfoot>
                    <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total Gross</td>
                    <td>'.$subtotal.'</td>
                </tr>';
                if($previousDue > 0){
                    $message .='<tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Previous Due</td>
                    <td>'.$previousDue.'</td>
                </tr>';
                }
                if($vat_percent_rate > 0){
                    $message .='<tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>VAT ('.$vat_percent_rate.'%)</td>
                    <td>'.$vat_tk.'</td>
                </tr>';
                }
                if($discount_amount > 0){
                    $message .='<tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Discount TK</td>
                    <td>'.$discount_amount.'</td>
                </tr>';
                }
                if($discount_percent_rate > 0){
                     $message .='<tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Discount ('.$discount_percent_rate.'%)</td>
                    <td>'.$discount_percent_tk.'</td>
                </tr>';
                }
                
                $message .='<tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total Bill</td>
                    <td>'.$no_vat_no_dis_total.'</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Paid</td>
                    <td>'.number_format($only_paid,2).'</td>
                </tr>';
               
                    $message .='<tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Due</td>
                    <td>'.$cur_due.'</td>
                </tr>
                
                </tfoot>

                

                <!-- FOOTER -->
                <!-- Set text color and font family ("sans-serif" or "Georgia, serif"). Duplicate all text styles in links, including line-height -->


                <!-- End of WRAPPER -->
            </table>



            <!-- End of SECTION / BACKGROUND -->
        </td>
    </tr>
</table>
';
                      
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
                    
                    
                    $client_due= $serchrow['due'];
                    $_SESSION['clientDue'] = $client_due;
                    $clientDue = $_SESSION["clientDue"];
                    //echo $clientCode;
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
                                        <input type="text" name="search_text" id="search_text" placeholder="Search by Customer Details" class="form-control" />
                                   
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
              <div id="resultR"></div>
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
                     if($vat_status == "Yes"){
                         ?><tr>
                                <th></th>
                                <th>VAT(%)</th>
                                <th><input type="number" id = "vat" name="vat" value="<?php echo $vat_rate; ?>" class="form-control" readonly></input></th>
                                <th>
                                    <input type="number" id = "vat_price" name="vat_price" value="0" class="form-control" step=any readonly></input>
                                </th>
                            </tr><?php  
                            if($discount_type == 'tk'){
                                ?>
                                <tr>
                                    <th></th>
                                    <th id = "">Total with Vat</th>
                                    <th></th>
                                    <th>
                                        <input type="text" id = "total_with_tk" name="total_with_tk" value = "" class="form-control" readonly></input>
                                    </th>
                                </tr>
                                
                                <?php
                            }
                             if($discount_type == 'parcent'){
                                ?>
                                <tr>
                                    <th></th>
                                    <th id = "">subtotal with vat </th>
                                    <th></th>
                                    <th>
                                        <input type="text" id = "total_with_percentage_taka" name="total_with_percentage_taka" value = "" class="form-control" readonly></input>
                                    </th>
                                </tr>
                                <?php
                            }
                     }
                     else{
                         ?>
                            
                       <?php  
                     }
                     // discount taka
                     if($discount_type == 'tk'){
                         ?><tr>
                            <th></th>
                            <th>Discount TK</th>
                            <th><input type="number" id = "discount" name="discount" value="0" class="form-control" ></input></th>
                            <th>
                                <input type="number" id = "discount_price" name="discount_price" value="0" class="form-control" readonly ></input>
                            </th>
                        </tr><?php
                         if($vat_status == "Yes"){
                             ?>
                             
                             <tr>
                                <th></th>
                                <th id = "">Total</th>
                                <th></th>
                                <th>
                                    <input type="text" id = "totalss" name="" value = "" class="form-control" readonly>
                                </th>
                            </tr>
                             <!--for due-->
                            <tr style="background-color: #E2686D;">
                                    <th></th>
                                    <th>Previous Due</th>
                                    <th></th>
                                    <th>
                                        <input type="text" id = "due_per_with_vat" name="" value = "<?php echo $clientDue; ?>" class="form-control" readonly>
                                    </th>
                                </tr>
                            <tr>
                                <th></th>
                                <th>Total Payable</th>
                                <th></th>
                                <th>
                                   <input type="text" name="" id="total_for_discount_taka_with_vat" class="form-control">
                                </th>
                            </tr>
                            <tr>
                                <th></th>
                                <th id = "">Paid</th>
                                <th></th>
                                <th>
                                   <input type="number" name="" id="paid" class="form-control" required value="0">
                                </th>
                            </tr>
                            <tr>
                        <th></th>
                        <th id = ""></th>
                        <th>Balance</th>
                        <th>
                           <input type="text" name="currentDue" id="currentDue" class="form-control" required value="0" step=any readonly>
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
                                <input type="text" id = "due_per" name="preDue" value = "<?php echo $clientDue_discount_tk; ?>" class="form-control" readonly></input>
                            </th>
                        </tr>
                    <tr>
                        <th></th>
                        <th id = "">Total Payable</th>
                        <th></th>
                        <th>
                           <input type="number" name="total_payable_with_all" id="total_for_discount_taka" class="form-control" required value="0">
                        </th>
                    </tr>
                    <tr>
                        <th></th>
                        <th id = "">Paid</th>
                        <th></th>
                        <th>
                           <input type="number" name="paid" id="paid_tk_without_vat" class="form-control" required value="0">
                        </th>
                    </tr>
                    <tr>
                        <th></th>
                        <th id = ""></th>
                        <th>Balance</th>
                        <th>
                           <input type="text" name="currentDue" id="currentDue" class="form-control" required value="0" step=any readonly>
                        </th>
                    </tr>
                    
                    
                    
                    
                    
                  
                             <?php
                         }
                     }
                     // discount percentage
                     else if($discount_type == 'parcent'){
                         ?>
                         <tr>
                            <th></th>
                            <th>Discount Percent(%)</th>
                            <th><input type="number" id = "dics_per" name="dics_per" value="0" class="form-control" ></input></th>
                            <th>
                                <input type="number" id = "dics_per_price" name="dics_per_price" value="0" class="form-control" ></input>
                            </th>
                        </tr><?php
                       
                        if($vat_status == "Yes"){
                            ?>
                            <tr>
                                <th></th>
                                <th id = "">Total</th>
                                <th></th>
                                <th>
                                    <input type="text" id = "total_payable_with_vat" name="total_payable_with_vat" value = "0" class="form-control" readonly></input>
                                </th>
                            </tr>
                            <!--for due with vat-->
                    <tr style="background-color: #E2686D;">
                            <th></th>
                            <th>Previous Due</th>
                            <th></th>
                            <th>
                                <input type="text" id = "due_per_dis_vat" name="due_per_dis_vat" value = "<?php echo $clientDue_discount_tk; ?>" class="form-control" readonly></input>
                            </th>
                        </tr>
                    <tr>
                        <th></th>
                        <th id = "">Total Payable</th>
                        <th></th>
                        <th>
                           <input type="number" name="total_for_discount_vat" id="total_for_discount_vat" class="form-control" required value="0">
                        </th>
                    </tr>
                    <tr>
                        <th></th>
                        <th id = "">Paid</th>
                        <th></th>
                        <th>
                           <input type="number" name="paid_with_discount_percentage" id="paid_with_discount_percentage" class="form-control" required value="0">
                        </th>
                    </tr>
                    <tr>
                        <th></th>
                        <th id = ""></th>
                        <th>Balance</th>
                        <th>
                           <input type="text" name="currentDue" id="currentDue" class="form-control" required value="0" step=any readonly>
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
                                <input type="text" id = "due_per_dis" name="due_per_dis" value = "<?php echo $clientDue_discount_tk; ?>" class="form-control" readonly></input>
                            </th>
                        </tr>
                    <tr>
                        <th></th>
                        <th id = "">Total Payable</th>
                        <th></th>
                        <th>
                           <input type="number" name="total_for_discount" id="total_for_discount" class="form-control" required value="0">
                        </th>
                    </tr>
                    <tr>
                        <th></th>
                        <th id = "">Paid</th>
                        <th></th>
                        <th>
                           <input type="number" name="paid_with_discount_percentage_without_vat" id="paid_with_discount_percentage_without_vat" class="form-control" required value="0">
                        </th>
                    </tr>
                    <tr>
                        <th></th>
                        <th id = ""></th>
                        <th>Balance</th>
                        <th>
                           <input type="text" name="currentDue" id="currentDue" class="form-control" required value="0" step=any readonly>
                        </th>
                    </tr>
                            <?php
                        }
                       
                   
                     }
                    ?>
                   <!--<tr style="background-color: #E2686D;">-->
                   <!--     <th></th>-->
                   <!--     <th>Previous Due</th>-->
                   <!--     <th></th>-->
                   <!--     <th>-->
                   <!--         <input type="text" id = "due_per" name="preDue" value = "<?php echo $clientDue_discount_tk; ?>" class="form-control" readonly></input>-->
                   <!--     </th>-->
                   <!-- </tr>-->
                    
                   <!-- <tr>-->
                   <!--     <th></th>-->
                   <!--     <th id = "">Total Payable</th>-->
                   <!--     <th></th>-->
                   <!--     <th>-->
                   <!--        <input type="number" name="total_payable_with_all" id="total_for_discount_taka" class="form-control" required value="0">-->
                   <!--     </th>-->
                   <!-- </tr>-->
                   <!-- <tr>-->
                   <!--     <th></th>-->
                   <!--     <th id = "">Paid</th>-->
                   <!--     <th></th>-->
                   <!--     <th>-->
                   <!--        <input type="number" name="paid" id="paid" class="form-control" required value="0">-->
                   <!--     </th>-->
                   <!-- </tr>-->
                </tfoot>
            </table>
            
                <hr class="bg-warning">
                <hr class="bg-warning">
                <div class="row">
                        </div>
                    <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                            <label for="date">Date</label>
                                            <input type="text" name="date" id="date" class="form-control" required value="<?php echo date("d-m-yy");?>">
                                            <!--<p>Date: <input type="text" id="date" value="<?php echo date("M/dd/yyyy");?>" ></p>-->
                                       </div>
                            </div>
                            <!--<div class="col-md-6">-->
                            <!--    <div class="form-group">-->
                            <!--                <label for="date">Current Due</label>-->
                            <!--                <input type="text" name="currentDue" id="currentDue" class="form-control" required value="0" step=any readonly>-->
                                            <!--<p>Date: <input type="text" id="date" value="<?php echo date("M/dd/yyyy");?>" ></p>-->
                            <!--           </div>-->
                            <!--</div>-->
                        </div>
                        <input type="hidden" name="clientCode" id="date" class="form-control" value="<?php echo $clientCode; ?>" required>
                       
                   <button type="submit" name="sell" class="btn btn-primary btn-block mt-4">Submit</button>
                      
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
                    $client_code = $_POST['clientCode'];
                    $shopkeeper_id = $shopkeeper_id;
                    
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
                    $discount_percent_rate = $_POST['dics_per'];
                    $discount_percent_tk = $_POST['dics_per_price'];
                    
                    
                    $total_with_tk=$_POST['total_with_tk'];
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
                    // $company_count = query("SELECT COUNT(company_id) as total_ccompanyid FROM quotation WHERE company_id='$company_id' group by company_id");
                    // confirm($company_count);
                    // $company_row = fetch_array($company_count);
                    // $total_company_row=$company_row['total_ccompanyid'];
                    // $total_company_count = $total_company_row +1;
                    
                    
                    //subtotal price
                    $subtotal = $_POST['subtotal'];
                    $discount_amount = $_POST['discount'];
                    $total_payable_with_discount = $_POST['total_payable_with_discount'];
                    
                    // for last id + 1 start;
                    $invoice_id = query("SELECT * FROM product_sell ORDER BY id DESC");
                    confirm($invoice_id);
                    $row = fetch_array($invoice_id);
                    $last_id = $row['id'];
                    // for last id + 1 End;
                    $invoice_id = $last_id+1;
                    
                    $action = "Pending";
                

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
                    
               
                    

                    $query1 = query("INSERT INTO quotation (shopkeeper_id, client_code, invoice_id, subTotal_price, discount_amount, vat_percent_rate, vat_tk, discount_percent_rate, discount_percent_tk, sub_total_price_with_discount, action, date) VALUES ('$shopkeeper_id', '$client_code', '$invoice_id', '$subtotal', '$discount_amount', '$vat_percent_rate', '$vat_tk', '$discount_percent_rate', '$discount_percent_tk', '$total_payable_with_discount', '$action',  '$date')");
                    confirm($query1);


                    
                    

                       echo "<script type='text/javascript'>
                            window.location = 'quotation-status.php?invoice=$invoice_id';
                            </script>";

                }
                else{
                    
                    
                    $shopkeeper_id = $shopkeeper_id;
                    
                    $unknown_client_query = query("SELECT * FROM clients WHERE name ='Unknown' AND shop_id='$shopkeeper_id'");
                    confirm($unknown_client_query);
                    $row_of_clients = fetch_array($unknown_client_query);
                    $client_code = $row_of_clients['code'];
                    
                    
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
                    
                    
                    
                    // $company_count = query("SELECT COUNT(company_id) as total_ccompanyid FROM quotation WHERE company_id='$company_id' group by company_id");
                    // confirm($company_count);
                    // $company_row = fetch_array($company_count);
                    // $total_company_row=$company_row['total_ccompanyid'];
                    // $total_company_count = $total_company_row +1;
                    
                    
                    //subtotal price
                    $subtotal = $_POST['subtotal'];
                    $discount_amount = $_POST['discount'];
                    $total_payable_with_discount = $_POST['total_payable_with_discount'];
                    
                    // for last id + 1 start;
                    $invoice_id = query("SELECT * FROM product_sell ORDER BY id DESC");
                    confirm($invoice_id);
                    $row = fetch_array($invoice_id);
                    $last_id = $row['id'];
                    // for last id + 1 End;
                    $invoice_id = $last_id+1;
                    
                    $action = "Pending";
                

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
                    
               
                    

                    $query1 = query("INSERT INTO quotation (shopkeeper_id, client_code, invoice_id, subTotal_price, discount_amount, sub_total_price_with_discount, action, date) VALUES ('$shopkeeper_id', '$client_code', '$invoice_id', '$subtotal', '$discount_amount', '$total_payable_with_discount', '$action',  '$date')");
                    confirm($query1);


                    
                    

                       echo "<script type='text/javascript'>
                            window.location = 'quotation-status.php?invoice=$invoice_id';
                            </script>";

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
<!--Script for product Search End-->

<!--  <script>-->
<!--$(document).ready(function(){-->
<!--      $('#productsearch').keyup(function(){-->
<!--  var s = $('#productsearch').val();-->
<!--            $.ajax({-->
<!--                type:'POST',-->
<!--                url:'search-product.php',-->
               
<!--                data:'usearch='+s,-->
<!--                success:function(data){-->
<!--                    $('#result').html(data);-->
<!--                }-->
                
<!--            });-->
<!-- });-->

<!--});-->
   
<!--  </script>-->
  
  <!--Client ajax search/ it's in the footer   -->
<!--<script>-->
<!--$(document).ready(function(){-->
<!--	load_data();-->
<!--	function load_data(query)-->
<!--	{-->
<!--		$.ajax({-->
<!--			url:"fetch.php",-->
<!--			method:"post",-->
<!--			data:{query:query},-->
<!--			success:function(data)-->
<!--			{-->
<!--				$('#resultR').html(data);-->
<!--			}-->
<!--		});-->
<!--	}-->
	
<!--	$('#search_text').keyup(function(){-->
<!--		var search = $(this).val();-->
<!--		if(search != '')-->
<!--		{-->
<!--			load_data(search);-->
<!--		}-->
<!--		else-->
<!--		{-->
<!--			load_data();			-->
<!--		}-->
<!--	});-->
<!--});-->
<!--</script>-->

    