<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">All Companies</h1>
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
                  Add new Company
                </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sl.</th>
                    <th>Company Name</th>
                    <th>Type</th>
                    <th>Location</th>
                    <th>Hotline</th>
                    <th>Email</th>
                     <th>Visiting Card</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  
                  <tbody>
                      <?php
                        $query = query("SELECT * FROM company ORDER BY id DESC");
                        confirm($query);
                        $rows = mysqli_num_rows($query);
                        if($rows > 0){
                            $i = 1;
                            while($row = fetch_array($query)){
                                $companyID = $row['type'];
                                $queryForCompanyType = query("SELECT * FROM companyType WHERE id='$companyID'");
                                confirm($queryForCompanyType);
                                $companyRow = fetch_array($queryForCompanyType);
                                
                            
                                ?><tr>
                                                   <td><?php echo $i?></td>
                                                   <td><?php echo $row['name']?></td>
                                                   <td><?php echo $companyRow['companyType']?></td>
                                                    <td><?php echo $row['location']?></td>
                                                   <td><?php echo $row['hotline']?></td>
                                                   <td><?php echo $row['email']?></td>
                                                   <td><a class="btn btn-sm btn-secondary"  href="showvscard.php?visitingCard=<?php echo $row['id']?>">View Visiting Card</a></td>
                                                   <?php
                                                   include("../backend/functions.php"); 
                                                    if(isset($_SESSION['username'])){
                                                        $username =  $_SESSION['username'];
            $f_query=query("SELECT * FROM `admin` where username='$username' || gmail = '$username'");
            confirm($f_query);
            $f_rows=fetch_array($f_query);
            $type = $f_rows['type'];
            if ($type == 'Admin'){
                ?><td>                              <abbr title="Click to Delete" class="text-success">
                                                     <a class="btn btn-sm btn-warning"  href="vscard.php?visitingCard=<?php echo $row['id']?>">Insert Visiting Card</a></abbr>
                                                    <abbr title="Click to Edit" class="text-success">
                                                     <i onclick="EditCompany(<?php echo $row['id']?>)"  class="far fa-edit btn btn-sm btn-primary"></i></abbr>
                                                                  <abbr title="Click to Delete" class="text-success">
                                                     <a onclick="DeleteCompany(<?php echo $row['id']?>)" href=""><i class="fas fa-eye-slash btn btn-sm btn-danger"></i></a></abbr>
                                                  </td><?php
            }
            else{
                ?><td>
                                                    <abbr title="Click to Edit" class="text-success">
                                                     <i onclick="EditCompany(<?php echo $row['id']?>)"  class="far fa-edit btn btn-sm btn-primary"></i></abbr>
                                                                  
                                                  </td><?php
            }
                                                    }
                                                   ?>
                                                    
                                        </tr><?php
                                       
                                

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
              <h4 class="modal-title">Add Company</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" id="insert_form">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Company Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter Group name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Company Type</label>
                        <select class="form-control" id="type" name="type">
                          <?php  
                            include("../backend/functions.php"); 
                            $query = query("SELECT * FROM companyType");  
                              $rows = mysqli_num_rows($query);
                              if($rows > 0){
                                  while($row = mysqli_fetch_array($query)){
                                       
                                      $company_name = <<<DELIMITER
                                      <option value={$row['id']}>{$row['companyType']}</option>
                                      
DELIMITER;
                                      echo $company_name;
                                  }
                                  
                              }
                                   ?>
                          
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Location</label>
                        <input type="text" name="location" class="form-control" id="location" placeholder="Ex: Dhaka">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hotline</label>
                        <input type="text" name="hotline" class="form-control" id="hotline" placeholder="Ex: +880 162">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        
                        <input type="email" name="email" class="form-control" id="email" placeholder="Ex: abc@gmail.com">
                    </div>
                    <input type="hidden" name="grp_id" id="grp_id" />
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input onclick="addRecoed()" type="submit" name="insert" id="insert" value="Insert" class="btn btn-success swalDefaultSuccess form-control"/>
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
      