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
                        <h1 style=""><b>Setting</b></h1>
                        <h1 class="m-0 text-dark"><?php display_message(); ?></h1>
                    </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <?php
                        $existSettingQ = query("SELECT * FROM setting");
                        confirm($existSettingQ);
                        $rowOfSetting = fetch_array($existSettingQ);
                        $existRow = $rowOfSetting['id'];
                        
                        if(!empty($existRow)){
                            ?>
                                <div class="col-md-12">
                            <form method="post" id="insert_form" class="">
                                <div id="PaycashForm" class="card" style="background-color: rgb(244, 244, 244); padding: 20px;">
                                    <h4 class="card-header bg-info" style="text-align: center;"><b>Exist Setting</b></h4>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Card Print Price: </label>
                                        <div class="col-sm-10">
                                            <h4><?php echo $rowOfSetting['cardCharge'];?></h4>
                                        </div>
                                      </div>
                                     
                                             <div class="card-footer text-center">
                                          <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target=".bd-example-modal-lg">Edit Setting</button>
                                          
                                          <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                              <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update Setting</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                  <div class="row">
                                                      <div class="col-md-12">
                                                        <form method="post" id="insert_form" class="">
                                                            <div id="PaycashForm" class="card" style="background-color: rgb(244, 244, 244); padding: 20px;">
                                                                <div class="form-group row">
                                                                    <label for="inputName" class="col-sm-2 col-form-label">Card Print Price</label>
                                                                    <div class="col-sm-10">
                                                                      <input type="number" class="form-control" id="cardPrintPrice" value="<?php echo $rowOfSetting['cardCharge'];?>" name="cardPrintPrice" step=any required>
                                                                    </div>
                                                                  </div>
                                                                 <!-- <div class="row">-->
                                                                 <!--    <div class="col-md-6">-->
                                                                 <!--        <div class="form-group">-->
                                                                 <!--           <label for="exampleInputEmail1">Sex</label>-->
                                                                 <!--           <div class="form-check form-check-inline" style="margin-left: 10px;">-->
                                                                 <!--             <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male" >-->
                                                                 <!--             <label class="form-check-label" for="inlineRadio1">Male</label>-->
                                                                 <!--           </div>-->
                                                                 <!--           <div class="form-check form-check-inline">-->
                                                                 <!--             <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female"  >-->
                                                                 <!--             <label class="form-check-label" for="inlineRadio2">Female</label>-->
                                                                 <!--           </div>-->
                                                                 <!--         </div>-->
                                                                 <!--    </div>-->
                                                                 <!--    <div class="col-md-6">-->
                                                                 <!--        <div class="form-group row">-->
                                                                 <!--           <label for="inputName" class="col-sm-6 col-form-label">Date of Birth</label>-->
                                                                 <!--           <div class="col-sm-6">-->
                                                                 <!--             <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth"  required>-->
                                                                 <!--           </div>-->
                                                                 <!--         </div>-->
                                                                 <!--    </div>-->
                                                                 <!--</div>-->
                                                                 
                                                                         <div class="card-footer text-right">
                                                                      <input  type="submit" name="setting" id="insert" value="Update" class="btn btn-danger btn-lg">
                                                                    </div>
                                                                  </form>
                                                            </div>
                                                         </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          
                                          
                                          
                                        </div>
                                      </form>
                                </div>
                             </div>
                                
                            <?php
                        }
                    
                    ?>
                             
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
C Date
   


 <?php
            
            
            if(isset($_POST['setting'])){
                
            $cardPrintPrice = escape_string($_POST['cardPrintPrice']);
            
            
            
            // $query_insert = query("INSERT INTO `setting`(`cardCharge`) VALUES ('$cardPrintPrice')");
            
            $query_insert = query("UPDATE `setting` SET cardCharge='$cardPrintPrice'");
            
            confirm($query_insert);
            
            if($query_insert){
            set_message('<h2 class="m-0 text-dark bg-primary text-center" style="padding: 10px; border-radius: 20px;">Setting Updated</h2>');
            redirect("setting-passport.php");
            }
            else{
            set_message('<h2 class="m-0 text-dark bg-danger text-center" style="padding: 10px; border-radius: 20px;">Failed</h2>'); 
            redirect("setting-passport.php");
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

