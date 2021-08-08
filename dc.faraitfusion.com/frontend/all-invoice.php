<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">All invoices</h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="col-12">
                 <div class="card">
             
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sl.</th>
                    <th>Client Name</th>
                    <th>Total Price</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
            <?php
                
                $query = query("SELECT * FROM admin WHERE username = '". $_SESSION['username'] ."'");  
                confirm($query);
                $row_of_admin = fetch_array($query);
                $shopkeeper_id = $row_of_admin['id']; 
                
                
                $query = query("SELECT * FROM quotation WHERE shopkeeper_id='$shopkeeper_id' AND action='Pending'  ORDER BY id DESC");
                confirm($query);
                $rows = mysqli_num_rows($query);
                if($rows > 0){
                    $i = 0;
                    while($row = fetch_array($query)){
                        $i +=1;
                        
                        $client_code = $row['client_code'];
                        //echo $client_code;
                        $date = $row['date'];
                        $forMatedDate = date("d M, Y", strtotime($date));
                        $total_price = $row['subTotal_price'];
                        
                        $invoice_id = $row['invoice_id'];
                        
                        //This is for contact person ID to Name Start
                        $client_name_query = query("SELECT * FROM clients WHERE code ='$client_code'");
                        confirm($client_name_query);
                        $client_row = fetch_array($client_name_query);
                        $client_name = $client_row['name'];
                        
                        $details = <<<DELIMITER
                            <tr>
                                <td>$i</td>
                                <td>{$client_name}</td>
                                <td>{$total_price}</td>
                                <td>$forMatedDate</td>

                                <td>
                                    <a href="quotation-status.php?invoice=$invoice_id" class="btn btn-primary btn-sm">See Invoice</a>
                                    <a href="invoice.php?invoice=$invoice_id"  class="btn btn-success btn-sm" target="_blank">Print Invoice</a>
                                </td> 
                                </td> 

                              </tr>

            
            
DELIMITER;
            echo $details;
                        
                        
                    }
                }

 
 ?>                     
                      
	 
	  
	                                 
                                                  

                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
             
            
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

      