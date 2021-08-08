<?php require_once("backend/config.php"); ?>
<?php include("header.php"); ?>
<?php include ("left-sidebar.php");?>

   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
            <h1 class="m-0 text-dark"><?php display_message(); ?></h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-info">
                               <div class="row">
                                <div class="col-md-12 col-12 text-center">
                                     <h2><?php echo date('j M, Y', strtotime($_GET['AllStartDate']));?> To <?php echo date('j M, Y', strtotime($_GET['AllEndDate']));?> Report</h2>
                                </div>
                            </div>
                           </div>
                        </div>
                    </div>
                </div>
        <div class="row">
          <div class="col-md-12">
              
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Date</th>
                                    <th class="text-center">Number Of Passport</th>
                                    <th>Total Cost</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    
                                    $startDate = $_GET['AllStartDate'];
                                    $endDate = $_GET['AllEndDate'];
                                        
                                    //Received
                                    $query_received = query("SELECT * FROM passportInfo WHERE date BETWEEN '$startDate' AND '$endDate' GROUP BY date");
                                    confirm($query_received);
                                    $rows_received=mysqli_num_rows($query_received);
                                     if($rows_received > 0)
                                     {      $i = 1;
                                            while( $row_received = fetch_array($query_received))
                                            {
                                                ?><tr>
                                                <td><?php date_default_timezone_set("Asia/Dhaka"); echo date('j M, Y', strtotime($row_received['date']));?></td>
                                                <td class="text-center">
                                                    <h5 class="">
                                                        <?php
                                                            
                                                            $date = $row_received['date'];
                                                            $query = query("SELECT COUNT(id) AS total FROM passportInfo WHERE date='$date'");
                                                            confirm($query);
                                                            $row = fetch_array($query);
                                                            $sum = $row['total'];
                                                            echo $sum;
                                                          
                                                    ?>
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5 class=""><?php
                                            
                                                        $date = $row_received['date'];
                                                        //echo $date;
                                                        $Costquery = query("SELECT SUM(print_price) AS totalCost FROM passportInfo WHERE date='$date'");
                                                        confirm($Costquery);
                                                        $row = fetch_array($Costquery);
                                                        $sum = $row['totalCost']+0;
                                                        echo $sum;
                                                      
                                                ?></h5>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $date; ?>">See All</button>
                                    
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal<?php echo $date; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                              <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel"><b><?php echo date( "d M, Y", strtotime($date)); ?> all Scanned Passport</b></h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                                </button>
                                                              </div>
                                                              <div class="modal-body">
                                                               <table id="example1" class="table table-bordered table-striped">
                                                                  <thead>
                                                                  <tr>
                                                                            <th>SI.</th>
                                                                            <th>Name</th>
                                                                            <th>Passport Num.</th>
                                                                            <th>Action</th>
                                                                          </tr>
                                                                  </thead>
                                                                  <!--tbody-->
                                                                  <tbody>
                                                                      <?php
                                                                        $query = query("SELECT * FROM passportInfo WHERE date='$date' ORDER BY id DESC");
                                                                        confirm($query);
                                                                        $rows = mysqli_num_rows($query);
                                                                        if($rows > 0)
                                                                        {
                                                                            $i = 1;
                                                                            while($row = fetch_array($query))
                                                                            {
                                                                               ?>
                                                                                <tr>
                                                                                    <td><?php echo $i?></td>
                                                                                    <td><?php echo $row['name'];?></td>
                                                                                    <td><?php echo $row['passportNum'];?></td>
                                                                                    <td>
                                                                                        
                                                                                                <a href="print-passport.php?passPortNum=<?php echo $row['passportNum']; ?>&flightNum=<?php echo $row['flightNum']; ?>" class="btn btn bg-primary" target="_blank">
                                                                                                View Departure Card</a>
                                                                                           
                                                                                            
                                                                                            </td>
                                                                                </tr>
                                                                                <?php
                                                                               $i++;
                                                                               
                                                                            }
                                                                        }
                                                                      ?>
                                                                  
                                                                  
                                                                  </tbody>
                                                                  <!--tfooter-->
                                                                  
                                                                </table>
                                                              </div>
                                                              <div class="modal-footer">
                                                                
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                </td>
                                                
                                            </tr>
                                            
                                            <?php
                                              $i++;
                                            }
                                            
                                     }
                                    ?>
                                  <tr>
                                      <?php
                                        
                                            $queryForTotalScannedPassport = query("SELECT COUNT(id) AS total FROM passportInfo WHERE date BETWEEN '$startDate' AND '$endDate'");
                                            confirm($queryForTotalScannedPassport);
                                            $rowOfPass = fetch_array($queryForTotalScannedPassport);
                                            $totalScanned = $rowOfPass['total'];
                                            
                                            $TotalCostquery = query("SELECT SUM(print_price) AS totalCost FROM passportInfo WHERE date BETWEEN '$startDate' AND '$endDate'");
                                            confirm($TotalCostquery);
                                            $rowOfTotalCost = fetch_array($TotalCostquery);
                                            $totalC = $rowOfTotalCost['totalCost']+0;
                                          
                                      ?>
                                     <td colspan="4">Total Scanned Passport = <?php echo $totalScanned ?></td>
                                   </tr>
                                   <tr>
                                       
                                       
                                       <td colspan="4">Total Cost = <?php 
                                       
                                       echo $totalC; 
                                       ?></td>
                                       
                                   </tr>
                                  
                                </tbody>
                              </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
         
        </div>
        <!--balance sheet start-->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>



<!--FOOTER START HERE-->


    <!--<footer class="main-footer">-->
    <!--    <strong>Copyright &copy; 2020 <a href="http://faraitfusion.com">FARA IT Fusion</a>.</strong>-->
    <!--    All rights reserved.-->
    <!--    <div class="float-right d-none d-sm-inline-block">-->
    <!--        <b>Version</b> 1.1.0-->
    <!--    </div>-->
    <!--</footer>-->


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

