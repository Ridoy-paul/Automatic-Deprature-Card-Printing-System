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
                        <h2 style="text-align:left;"><b>Add New Flight Type</b></h2>
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
                                <label for="inputEmail3" class="col-sm-2 col-form-label">*Type Name</label>
                                <div class="col-sm-10">
                                  <input type="text" name="typeName" class="form-control" id="" placeholder="Ex. BIMAN BANGLADESH" required>
                                </div>
                            </div>
                            
                           
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">*Code</label>
                                <div class="col-sm-10">
                                  <input type="text" name="typeCode" class="form-control"   id="" placeholder="Ex. BG" required>
                                </div>
                            </div>
                            
                        </div>    
                            
                <div class="card-footer text-right">
                  <input  type="submit" name="addFlightType" id="insert" value="ADD" class="btn btn-primary btn-lg form-control">
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
            
            
            if(isset($_POST['addFlightType'])){
                
            $typeName = escape_string($_POST['typeName']);
            $typeCode= escape_string($_POST['typeCode']);
           
            
            $select_flightType=query("SELECT * FROM `flightType` WHERE code='$typeCode'");
            $rows=mysqli_num_rows($select_flightType);
            if($rows>0)
            {
                $typeInfo = fetch_array($select_flightType);
                $code = $typeInfo['code'];
                $typeName = $typeInfo['typeName'];
                set_message("<p style='text-align: center; color:white;font-size:15px; background: #343A40; border: 2px solid #F50057; border-radius: 10px; padding: 10px 10px; '>Sorry, this code $code is already exist as $typeName, Please try again with new code</p>");
                redirect("add-flight-type.php");
            }
            else
            {
            $query_insert = query("INSERT INTO `flightType`(typeName, code, status) VALUES('$typeName','$typeCode', 'SHOW')");
            confirm($query_insert);
            if($query_insert){
                set_message("<p style='color:white;font-size:15px; background: green; border: 2px solid #F50057; border-radius: 10px; padding: 10px 10px; '>Flight Type Added Successfully</p>");
                redirect("active-flight-type.php");
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

