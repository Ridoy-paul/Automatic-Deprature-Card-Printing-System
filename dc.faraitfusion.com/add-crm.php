<?php require_once("backend/config.php"); ?>
<?php include("header.php"); ?>
<?php include ("left-sidebar.php");?>

<?php

     $username =  $_SESSION['username'];
     
    $f_query=query("SELECT * FROM `admin` where username='$username' || gmail = '$username'");
    confirm($f_query);
    $f_rows=fetch_array($f_query);
    $type = $f_rows['type'];
    
    if ($type == 'Admin'){
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
              <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <h1 style="text-align:left;"><b>Add New CRM</b></h1>
                        <h1 class="m-0 text-dark"><?php display_message(); ?></h1>
                    </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="">
                <div class="row">
                    <div class="col-md-12">
                        
                        <form method="post" id="insert_form" style="padding: 0px 50px;" class="card">
                        <div class="card-body">
                           
                            
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">*Name</label>
                                <div class="col-sm-10">
                                  <input type="text" name="name" class="form-control" id="" placeholder="CRM Name" required>
                                </div>
                            </div>
                            
                           
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">*Phone</label>
                                <div class="col-sm-10">
                                  <input type="text" name="phone" class="form-control" maxlength="11"  minlength="11" id="" placeholder="CRM phone number" required>
                                </div>
                            </div>
                            
                           
                            
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">*email</label>
                                <div class="col-sm-10">
                                  <input type="email" name="email" class="form-control" id="" placeholder="CRM email" required>
                                </div>
                            </div>
                            
                            
                            
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">*Password</label>
                                <div class="col-sm-10">
                                  <input type="password" name="Password" class="form-control" minlength="8" id="" placeholder="Login Password (Min Length 8)" required>
                                </div>
                            </div>
                            
                            
                        </div>    
                            
                <div class="card-footer text-right">
                  <input  type="submit" name="addcrm" id="insert" value="ADD" class="btn btn-primary btn-lg form-control">
                </div>
              </form>
                    
                </div>
              </div>
              <!-- /.card-body -->
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
}
        ?>

   


 <?php
            
            
            if(isset($_POST['addcrm'])){
                
            $name = escape_string($_POST['name']);
            $phone= escape_string($_POST['phone']);
            $email= escape_string($_POST['email']);
            $username= escape_string($_POST['email']);
            $Password= md5($_POST['Password']);
            $without_md5= escape_string($_POST['Password']);
            
            $select_crm=query("SELECT * FROM `admin` WHERE gmail='$email'");
            $rows=mysqli_num_rows($select_crm);
            if($rows>0)
            {
                $crmInfo = fetch_array($select_crm);
                $name = $crmInfo['name'];
                $phone = $crmInfo['phone'];
                set_message("<p style='color:white;font-size:15px; background: #343A40; border: 2px solid #F50057; border-radius: 10px; padding: 10px 10px; '>Sorry, this CRM is already exist as $name <br> Phone: $phone</p>");
                redirect("add-crm.php");
            }
            else
            {
            $query_insert = query("INSERT INTO `admin`(`name`, `phone`, `gmail`, `username`, `password`, `passWithoutMD`, `type`, `status`) VALUES('$name','$phone','$email','$username','$Password','$without_md5', 'CRM', 'SHOW')");
            confirm($query_insert);
            if($query_insert){
                set_message("<p style='color:white;font-size:15px; background: #343A40; border: 2px solid #F50057; border-radius: 10px; padding: 10px 10px; '>CRM Added Successfully</p>");
                redirect("all-crm.php");
            }
            else{
                set_message('<h2 class="m-0 text-dark bg-primary text-center" style="padding: 10px; border-radius: 20px;">Failed</h2>'); 
            }
        }
     }
 
            ?>
<!--FOOTER START HERE-->


    <footer class="main-footer">
        <strong>Copyright &copy; 2020 <a href="http://faraitfusion.com">FARA IT Fusion</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.1.0
        </div>
    </footer>


    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>




</body>
</html>

