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
                    <th>Person Name</th>
                    <th>Company Name</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  
                  
            <?php
                // include("../backend/functions.php");     
                $query = query("SELECT * FROM quotation WHERE action='Sold' ORDER BY id DESC");
                confirm($query);
                $rows = mysqli_num_rows($query);
                if($rows > 0){
                    $i = 0;
                    while($row = fetch_array($query)){
                        $i +=1;
                    $contactPersonID = $row['person_id'];
                        $date = $row['date'];
                        $forMatedDate = date("d M, Y", strtotime($date));
                        $invoice_id = $row['invoice_id'];
                        //This is for contact person ID to Name Start
                        $person_name_query = query("SELECT * FROM contact_person WHERE id ='$contactPersonID'");
                        confirm($person_name_query);
                        $person_row = fetch_array($person_name_query);
                       // $person_name = $person_row['Name'];
                          $company_id = $person_row['company_id'];
                        //This is for contact person ID to Name End
                        
                        //This is for Compant ID to Name Start
                        $company_name_query = query("SELECT * FROM company WHERE id ='$company_id'");
                        confirm($company_name_query);
                        $company_row = fetch_array($company_name_query);
                        $company_name = $company_row['name'];
                        //This is for Compant ID to Name End
                        
                        $details = <<<DELIMITER
                            <tr>
                                <td>$i</td>
                                <td>{$person_row['Name']}</td>
                                <td>$company_name</td>
                                <td>$forMatedDate</td>

                                <td style="width: 195px;">
                                    <a href="invoice.php?invoice=$invoice_id" class="btn btn-primary btn-sm" target ="_blank">View PDF</a>
                                    <a href="return-pending.php?returnPending=$invoice_id" class="btn btn-warning btn-sm">Return pending</a>
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

      