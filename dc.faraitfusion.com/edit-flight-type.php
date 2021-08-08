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
                            $typeID = $_GET['typeID'];
                            $query = query("SELECT * FROM flightType WHERE id='$typeID'");
                            confirm($query);
                            $rowOfT = fetch_array($query);
                            $typeName = $rowOfT['typeName'];
                            $Code = $rowOfT['code'];
                        
                        ?>
            <div class="card">
              <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <h2 style="text-align:left;"><b>Update <span class="text-primary"><?php echo $typeName; ?></span> Flight Type</b></h2>
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
                                  <input type="text" name="typeName" class="form-control" id="" placeholder="Ex. BIMAN BANGLADESH" value="<?php echo $typeName; ?>" required>
                                </div>
                            </div>
                            
                           
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">*Code</label>
                                <div class="col-sm-10">
                                  <input type="text" name="typeCode" class="form-control"   id="" placeholder="Ex. BG" value="<?php echo $Code; ?>" required>
                                </div>
                            </div>
                            
                        </div>    
                            
                <div class="card-footer text-right">
                  <input  type="submit" name="addFlightType" id="insert" value="Update" class="btn btn-primary btn-lg form-control">
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
                
            $typeID = $_GET['typeID'];
            $typeName = escape_string($_POST['typeName']);
            $typeCode= escape_string($_POST['typeCode']);
           
            
            $query_update = query("UPDATE flightType SET typeName='$typeName', code='$typeCode' WHERE id='$typeID'");
            confirm($query_update);
            if($query_update){
                set_message("<p style='color:white;font-size:15px; background: green; border: 2px solid #F50057; border-radius: 10px; padding: 10px 10px; '>Flight Type Update Successfully</p>");
                redirect("active-flight-type.php");
            }
            else{
                set_message('<h2 class="m-0 text-dark bg-primary text-center" style="padding: 10px; border-radius: 20px;">Failed</h2>'); 
                redirect("active-flight-type.php");
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

