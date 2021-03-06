<?php require_once("backend/config.php"); ?>
<?php include("header.php"); ?>
<?php include ("left-sidebar.php");?>
<?php

     $username =  $_SESSION['username'];
     
    $f_query=query("SELECT * FROM `admin` where username='$username' || gmail = '$username'");
    confirm($f_query);
    $f_rows=fetch_array($f_query);
    $type = $f_rows['type'];
    $name = $f_rows['name'];
    $ID = $f_rows['id'];
    
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-12">
            <h1><b>All Scanned Passport</b></h1>
            <div><?php display_message(); ?></div>
            <h1 class="m-0 text-dark"></h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
              
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                  <div class="row">
                      <!--<div class="col-md-6">-->
                      <!--     <a href="add-client.php" class="btn btn-info" role="button">Add New Client</a>-->
                      <!--</div>-->
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                            <th>SI.</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Passport Num.</th>
                            <th>Print By</th>
                            <th>Action</th>
                          </tr>
                  </thead>
                  <!--tbody-->
                  <tbody>
                      <?php
                        if($type == 'Admin'){
                           $query = query("SELECT * FROM passportInfo ORDER BY id DESC");
                            confirm($query);
                            $rows = mysqli_num_rows($query);
                            if($rows > 0)
                            {
                                $i = 1;
                                while($row = fetch_array($query)) {
                                    $printBy = $row['printBy'];
                                    if($printBy == 'Admin'){
                                        $printBy = "Admin";
                                    }
                                    else {
                                        $crmQ = query("SELECT * FROM admin WHERE id='$printBy'");
                                        confirm($crmQ);
                                        $rowOfAdmin = fetch_array($crmQ);
                                        $printBy = $rowOfAdmin['name'];
                                    }
                                   ?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                        <td><?php echo date( "d M, Y", strtotime($row['date']))?></td>
                                        <td><?php echo $row['name'];?></td>
                                        <td><?php echo $row['passportNum'];?></td>
                                        <td><?php echo $printBy;?></td>
                                        <td>
                                            
                                                    <a href="print-passport.php?passPortNum=<?php echo $row['passportNum']; ?>&flightNum=<?php echo $row['flightNum']; ?>" class="btn btn bg-primary" target="_blank">
                                                    <i class="fa fa-eye"></i> View Departure Card</a>
                                               
                                                
                                                </td>
                                    </tr>
                                    <?php
                                   $i++;
                                   
                                }
                            } 
                        }
                        else if($type == 'CRM'){
                           $query = query("SELECT * FROM passportInfo WHERE printBy='$ID' ORDER BY id DESC");
                            confirm($query);
                            $rows = mysqli_num_rows($query);
                            if($rows > 0)
                            {
                                $i = 1;
                                while($row = fetch_array($query)) {
                                    $printBy = $row['printBy'];
                                    if($printBy == 'Admin'){
                                        $printBy = "Admin";
                                    }
                                    else {
                                        $crmQ = query("SELECT * FROM admin WHERE id='$printBy'");
                                        confirm($crmQ);
                                        $rowOfAdmin = fetch_array($crmQ);
                                        $printBy = $rowOfAdmin['name'];
                                    }
                                   ?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                        <td><?php echo date( "d M, Y", strtotime($row['date']))?></td>
                                        <td><?php echo $row['name'];?></td>
                                        <td><?php echo $row['passportNum'];?></td>
                                        <td><?php echo $printBy;?></td>
                                        <td>
                                            
                                                    <a href="print-passport.php?passPortNum=<?php echo $row['passportNum']; ?>&flightNum=<?php echo $row['flightNum']; ?>" class="btn btn bg-primary" target="_blank">
                                                    <i class="fa fa-eye"></i> View Departure Card</a>
                                               
                                                
                                                </td>
                                    </tr>
                                    <?php
                                   $i++;
                                   
                                }
                            } 
                        }
                        
                        
                      ?>
                  
                  
                  </tbody>
                  <!--tfooter-->
                  
                </table>
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

