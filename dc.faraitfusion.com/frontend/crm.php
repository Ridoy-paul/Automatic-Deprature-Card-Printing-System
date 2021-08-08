<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">All Contacts</h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <?php  
        include("../backend/functions.php"); 
        if(isset($_SESSION['username'])){
            $username =  $_SESSION['username'];
            $f_query=query("SELECT * FROM `admin` where username='$username' || gmail = '$username'");
            confirm($f_query);
            $f_rows=fetch_array($f_query);
            $type = $f_rows['type'];
            if ($type == 'Admin'){
                ?>
                <div class="row">

            <div class="col-12">
                 <div class="card">
              <div class="card-header">
                <button type="button" class="btn btn-default" id="add" data-toggle="modal" data-target="#modal_insert">
                  Add new CRM
                </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <div id="contact_person_data"></div>
                  <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sl.</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>User Name</th>
                    <th>Password</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  
                  <tbody>
                      <?php
                        $query = query("SELECT * FROM admin WHERE type='User' ORDER BY id DESC");
                        confirm($query);
                        $rows = mysqli_num_rows($query);
                        
                        if($rows > 0){
                            $i = 1;
                            while($row = fetch_array($query)){
                                ?>
                                <tr>
                                                   <td><?php echo $i?></td>
                                                   <td><?php echo $row['name']?></td>
                                                   <td><?php echo $row['position']?></td>
                                                    <td><?php echo $row['phone']?></td>
                                                   <td><?php echo $row['gmail']?></td>
                                                   <td><?php echo $row['username']?></td>
                                                   <td><?php echo $row['password']?></td>
                                                    <td>
                                              
                                              <abbr title="Click to Delete" class="text-success">
                                                  <?php include("../backend/functions.php");?>
                                                
                                 <!--<a onclick="DeleteCRM({$row['id']})" href=""><i class="fas fa-eye-slash btn btn-sm btn-danger"></i></a>-->
                                 <a href="delete-admin.php?id=<?php echo $row['id'];?>" class="btn btn-danger ml-2" style="padding:3px 6px;"><i class="fas fa-fw fa-trash "></i></a>
                                 <a  href="edit-crm.php?id=<?php echo $row['id']?>"><i class="fas fa-eye-slash btn btn-sm btn-success"></i></a>
                                 
                                 </abbr>
                              </td>
                                        </tr>
                                <?php
                            
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
                <?php
            }
            else
            {
                ?>
                <div class="row">

            <div class="col-12">
                 <div class="card">
              <div class="card-header">
                <button type="button" class="btn btn-default" id="add" data-toggle="modal" data-target="#modal_insert">
                  Add new CRM
                </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <div id="contact_person_data"></div>
                  <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sl.</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>User Name</th>
                    <th>Password</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  
                  <tbody>
                      <?php
                        $query = query("SELECT * FROM admin WHERE type='User' ORDER BY id DESC");
                        confirm($query);
                        $rows = mysqli_num_rows($query);
                        if($rows > 0){
                            $i = 1;
                            while($row = fetch_array($query)){
                                ?>
                                <tr>
                                                   <td><?php echo $i?></td>
                                                   <td><?php echo $row['name']?></td>
                                                   <td><?php echo $row['position']?></td>
                                                    <td><?php echo $row['phone']?></td>
                                                   <td><?php echo $row['gmail']?></td>
                                                   <td><?php echo $row['username']?></td>
                                                   <td><?php echo $row['password']?></td>
                                                    <td>
                                               <abbr title="Click to Edit" class="text-success">
                                 <i onclick="EditCRM(<?php echo $row['id']?>)"  class="far fa-edit btn btn-sm btn-primary"></i></abbr>
                                             
                              </td>
                                        </tr>
                                <?php
                            
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
                <?php
            }
        }
        ?>
        
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
              <h4 class="modal-title">Add New CRM</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" id="insert_form">
                <div class="card-body">
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Ex: Name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Position</label>
                        <input type="text" name="position" class="form-control" id="position" placeholder="Ex: Manager">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone</label>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Ex: +880 162">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Gmail</label>
                        <input type="email" name="gmail" class="form-control" id="gmail" placeholder="Ex: abc@gmail.com">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">User Name</label>
                        
                        <input type="text" name="userName" class="form-control" id="userName" placeholder="Ex: monirHossain123">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        
                        <input type="text" name="password" class="form-control" id="password" placeholder="Ex: name123">
                    </div>
                    <input type="hidden" name="grp_id" id="grp_id" />
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input onclick="addCRM()" type="submit" name="insert" id="insert" value="Insert" class="btn btn-success form-control"/>
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
              <h4 class="modal-title">Update CRM</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" id="insert_form">
                <div class="card-body">
                    
                    <div class="form-group">
                        <label for="update_name">Name</label>
                        <input type="text" name="name" class="form-control" id="update_name" placeholder="Ex: Name">
                    </div>
                    <div class="form-group">
                        <label for="update_position">Position</label>
                        <input type="text" name="position" class="form-control" id="update_position" placeholder="Ex: Manager">
                    </div>
                    <div class="form-group">
                        <label for="update_phone">Phone</label>
                        <input type="text" name="phone" class="form-control" id="update_phone" placeholder="Ex: +880 162">
                    </div>
                    <div class="form-group">
                        <label for="update_gmail">Gmail</label>
                        <input type="email" name="gmail" class="form-control" id="update_gmail" placeholder="Ex: abc@gmail.com">
                    </div>
                    <div class="form-group">
                        <label for="update_userName">User Name</label>
                        <input type="text" name="userName" class="form-control" id="update_userName" placeholder="Ex: monirHossain123">
                    </div>
                    <div class="form-group">
                        <label for="update_password">Password</label>
                        <input type="text" name="password" class="form-control" id="update_password" placeholder="Ex: name123">
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

