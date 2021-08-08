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
<?php
    $crmID = $_GET['ID'];
    $crmQ = query("SELECT * FROM admin WHERE id='$crmID' AND type='CRM'");
    confirm($crmQ);
    $rowOfCRM = fetch_array($crmQ);
    $name = $rowOfCRM['name'];
    $phone = $rowOfCRM['phone'];
    $gmail = $rowOfCRM['gmail'];
    $passWithoutMD = $rowOfCRM['passWithoutMD'];


?>
            <div class="card">
              <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <h4 style="text-align:left;"><b>Update CRM</b></h4>
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
                                  <input type="text" name="name" class="form-control" id="" placeholder="CRM Name" value="<?php echo $name; ?>" required>
                                </div>
                            </div>
                            
                           
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">*Phone</label>
                                <div class="col-sm-10">
                                  <input type="text" name="phone" class="form-control" maxlength="11"  minlength="11" value="<?php echo $phone; ?>" placeholder="CRM phone number" required>
                                </div>
                            </div>
                            
                           
                            
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">*email</label>
                                <div class="col-sm-10">
                                  <input type="email" name="email" class="form-control" id="" value="<?php echo $gmail; ?>" placeholder="CRM email" required readonly>
                                </div>
                            </div>
                            
                            
                            
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">*Password</label>
                                <div class="col-sm-10">
                                  <input type="text" name="Password" class="form-control" minlength="8" id="" value="<?php echo $passWithoutMD; ?>" placeholder="Login Password (Min Length 8)" required>
                                </div>
                            </div>
                            
                            
                            
                        </div>    
                            
                <div class="card-footer text-right">
                  <input  type="submit" name="UpdateCrm" id="insert" value="Update" class="btn btn-primary btn-lg form-control">
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
            
            
            if(isset($_POST['UpdateCrm'])){
                
            $crmID = $_GET['ID'];
            $name = escape_string($_POST['name']);
            $phone= escape_string($_POST['phone']);
            
            $Password= md5($_POST['Password']);
            $without_md5= escape_string($_POST['Password']);
            
            
            $query_update = query("UPDATE admin SET name='$name', phone='$phone', password='$Password', passWithoutMD='$without_md5' WHERE id='$crmID'");
            confirm($query_update);
            if($query_update){
                set_message("<p style='color:white;font-size:15px; background: #343A40; border: 2px solid #F50057; border-radius: 10px; padding: 10px 10px; '>CRM Update Successfully</p>");
                redirect("active-crm.php");
            }
            else{
                set_message('<h2 class="m-0 text-dark bg-primary text-center" style="padding: 10px; border-radius: 20px;">Failed</h2>'); 
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

