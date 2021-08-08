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
    $clientID = $_GET['ClientID'];
    $clientQ = query("SELECT * FROM clients WHERE id = '$clientID'");
    confirm($clientQ);
    $clieentRow = fetch_array($clientQ);
    
    $clientName = $clieentRow['name'];
    //echo $clientName;
    //echo __DIR__;


?>
            <div class="card">
              <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <h3 style=""><b>Client Info</b></h3>
                        <h1 class="m-0 text-dark"><?php //display_message(); ?></h1>
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                  <tbody>
                                    <tr>
                                      <td><b>Client Name: </b></td>
                                      <td><?php echo $clientName;?></td>
                                    </tr>
                                    <tr>
                                      <td><b>Client Phone: </b></td>
                                      <td><?php echo $clieentRow['phone'];?></td>
                                    </tr>
                                    <tr>
                                      <td><b>Client email: </b></td>
                                      <td><?php echo $clieentRow['email'];?></td>
                                    </tr>
                                    <tr>
                                      <td><b>Company Name: </b></td>
                                      <td><?php echo $clieentRow['companyName'];?></td>
                                    </tr>
                                  </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                  <tbody>
                                     <tr>
                                      <td><b>Company Address: </b></td>
                                      <td><?php echo $clieentRow['companyAddress'];?></td>
                                    </tr>
                                    <tr>
                                      <td><b>Client Designation: </b></td>
                                      <td><?php echo $clieentRow['designation'];?></td>
                                    </tr>
                                    <tr>
                                      <td><b>Query: </b></td>
                                      <td><?php echo $clieentRow['query'];?></td>
                                    </tr>
                                    <tr>
                                      <td><b>Note: </b></td>
                                      <td><?php echo $clieentRow['note'];?></td>
                                    </tr>
                                  </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" id="insert_form" style="padding: 0px 0px;" class="card">
                        <div class="card-body">
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="flatNum">SMS Text</label>
                                        <textarea id="w3review" name="description" rows="10" cols="50">
                                            
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>    
                            
                <div class="card-footer text-right bg-light">
                  <input  type="submit" name="quotationAdd" id="insert" value="Send" class="btn btn-primary btn-lg">
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
            
            if(isset($_POST['quotationAdd'])){
                
                 $quoteDetails = escape_string($_POST['description']); 
                 $package = "http://fif.eduorganizer.com/".$packageDetails;
                 
                 $query = query("INSERT INTO  quotationDemo(quoteName, quoteDetails) VALUES('Paul','$quoteDetails')");
                 confirm($query);
                 
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
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<!-- Editable -->
<script src="plugins/jquery-datatables-editable/jquery.dataTables.js"></script>
<script src="plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="plugins/tiny-editable/mindmup-editabletable.js"></script>
<script src="plugins/tiny-editable/numeric-input-example.js"></script>
<script>
$('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
$('#editable-datatable').editableTableWidget().numericInputExample().find('td:first').focus();
$(function() {
$('#editable-datatable').DataTable();
});
</script>

<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/ckeditor/ckeditor.js"></script>
<script src="plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>

<script>

$('#dateC').datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    yearRange: "-100:+0",
    dateFormat: "dd-mm-yy"

});

</script>
<script>
    CKEDITOR.replace('remarks');
    CKEDITOR.replace('description');
    CKEDITOR.replace('update_description');
</script>



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

