<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">All Product Images</h1>
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
              <div class="card-header">
                <button type="button" class="btn btn-default" id="add" data-toggle="modal" data-target="#modal_insert">
                  Add new Image
                </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <div id="contact_person_data"></div>
                  <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sl.</th>
                    <th>Company Name</th>
                    <th>CRM Name</th>
                    <th>Status</th>
                    <th>Note</th>
                    <th>Visit Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  
                  <tbody>
                      <?php
                        $query = query("SELECT * FROM visit ORDER BY id DESC");
                        confirm($query);
                        $rows = mysqli_num_rows($query);
                        if($rows > 0){
                            $i = 1;
                            while($row = fetch_array($query)){
                                $date = $row['visit_date'];
                                $forMatedDate = date("d M, Y", strtotime($date));
                                
                                
                                $companyID = $row['company_id'];
                                $queryForCompanyName = query("SELECT * FROM company WHERE id='$companyID'");
                                confirm($queryForCompanyName);
                                $companyName = fetch_array($queryForCompanyName);
                                
                                $CRMiD = $row['CRM_id'];
                                $queryForCRM_id_to_name = query("SELECT * FROM admin WHERE id='$CRMiD'");
                                confirm($queryForCRM_id_to_name);
                                $CRMname = fetch_array($queryForCRM_id_to_name);
                                
                                $tabel = <<<DELIMITER
                                <tr>
                                                   <td>{$i}</td>
                                                   <td>{$companyName['name']}</td>
                                                   <td>{$CRMname['name']}</td>
                                                    <td>{$row['status']}</td>
                                                   <td>{$row['note']}</td>
                                                   <td>{$forMatedDate}</td>
                                                    <td>
                                               <abbr title="Click to Edit" class="text-success">
                                 <i onclick="EditVisitStatus({$row['id']})"  class="far fa-edit btn btn-sm btn-primary"></i></abbr>
                                              <abbr title="Click to Delete" class="text-success">
                                 <a onclick="DeleteVisitStatus({$row['id']})" href=""><i class="fas fa-eye-slash btn btn-sm btn-danger"></i></a></abbr>
                              </td>
                                        </tr>
DELIMITER;
                            echo $tabel;
                             $i++;
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
  
  <!--Data Insert Modal Start -->
  <!-- /.content-wrapper -->
  <div class="modal fade" id="modal_insert">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add New</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" id="insert_form">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Product Name</label>
                        <select class="form-control" name="product_name" id="product_name">
                          <?php  
                            include("../backend/functions.php"); 
                            $query = query("SELECT * FROM products");  
                              $rows = mysqli_num_rows($query);
                              if($rows > 0){
                                  while($row = mysqli_fetch_array($query)){
                                       
                                      $company_name = <<<DELIMITER
                                      <option value={$row['id']}>{$row['model']}</option>
                                      
DELIMITER;
                                      echo $company_name;
                                  }
                                  
                              }
                                   ?>
                          
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Image</label>
                        <input type="file" name="date" class="form-control" id="date">
                    </div>
                    
                    <input type="hidden" name="grp_id" id="grp_id" />
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input onclick="addProductImage()" type="submit" name="insert" id="insert" value="Insert" class="btn btn-success form-control"/>
                </div>
              </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      
      
      
      <!--Data Insert Modal End -->
      
      <!--Data Update Modal Start -->
      <div class="modal fade" id="modal_update">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Update Contact</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" id="insert_form">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Company Name</label>
                        <select class="form-control" name="update_company_name" id="update_company_name">
                          <?php  
                            include("../backend/functions.php"); 
                            $query = query("SELECT * FROM company");  
                              $rows = mysqli_num_rows($query);
                              if($rows > 0){
                                  while($row = mysqli_fetch_array($query)){
                                       
                                      $company_name = <<<DELIMITER
                                      <option value={$row['id']}>{$row['name']}</option>
                                      
DELIMITER;
                                      echo $company_name;
                                  }
                                  
                              }
                                   ?>
                          
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="update_crm_name">CRM Name</label>
                        <select class="form-control" name="update_crm_name" id="update_crm_name">
                          <?php  
                            include("../backend/functions.php"); 
                            $query = query("SELECT * FROM admin WHERE type='User'");  
                              $rows = mysqli_num_rows($query);
                              if($rows > 0){
                                  while($row = mysqli_fetch_array($query)){
                                       
                                      $company_name = <<<DELIMITER
                                      <option value={$row['id']}>{$row['name']}</option>
                                      
DELIMITER;
                                      echo $company_name;
                                  }
                                  
                              }
                                   ?>
                          
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Status</label>
                        <select class="form-control" name="status" id="update_status">
                            <option value="Accepted">Accepted</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="update_note">Note</label>
                        <textarea name="update_note" id="update_note" cols="30" rows="5" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="update_date">Visit Date</label>
                        <input type="date" name="update_date" class="form-control" id="update_date">
                    </div>
                    
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input onclick="UpdatePerson()" type="submit" name="insert" id="update" value="Update" class="btn btn-success form-control"/>
                </div>
                <input type="hidden">
              </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!--Data Update Modal End -->

