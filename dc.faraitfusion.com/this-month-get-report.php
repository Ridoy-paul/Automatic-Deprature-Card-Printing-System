<?php require_once("backend/config.php"); ?>
<?php include("header.php"); ?>
<?php include ("left-sidebar.php");?>


           <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-12">
            <h1></h1>
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
                      <div class="col-md-12">
                          <table class="table">
                              <tbody>
                                <tr>
                                  <td><h2><b>This Month Collection:</b></h2></td>
                                  <td><h2><b></b></h2></td>
                                </tr>
                                <tr class="bg-danger">
                                  <td><h4><b>This Month Get</b></h4></td>
                                  <?php
                                    $thisMonth = date("Y-m");
                                    $thisMonthGEtQ =query("SELECT SUM(dueAmount) as thisMonth FROM clientPaymentByMonth WHERE monthName='$thisMonth'");
                                    $thisMGEt=fetch_array($thisMonthGEtQ);
                                  
                                  ?>
                                  <td><h2><b><?php echo number_format($thisMGEt['thisMonth'],2); ?></b></h2></td>
                                </tr>
                              </tbody>
                            </table>
                           
                      </div>
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                            <th>SI.</th>
                            <th>Month Name</th>
                            <th>Client Name</th>
                            <th>Client Phone</th>
                            <th>Amount</th>
                          </tr>
                  </thead>
                  <!--tbody-->
                  <tbody>
                      <?php
                        $thisMonth = date("Y-m");
                        $query = query("SELECT * FROM clientPaymentByMonth WHERE monthName='$thisMonth'");
                        confirm($query);
                        $rows = mysqli_num_rows($query);
                        if($rows > 0)
                        {
                            $i = 1;
                            while($row = fetch_array($query))
                            {
                                $client_id = $row['clientID'];
                                $query_of_client = query("SELECT * FROM `clients` WHERE id='$client_id'");
                                $client_id_row=fetch_array($query_of_client);
                                
                                
                                $monthName = date("M,Y", strtotime($row['monthName']));
                               ?>
                                <tr>
                                    <td><?php echo $i?></td>
                                    <td><?php echo $monthName;?></td>
                                    <td><?php echo $client_id_row['clientName'];?></td>
                                    <td><?php echo $client_id_row['phone'];?></td>
                                    <td><?php echo number_format($row['dueAmount'],2);?></td>
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
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <button onclick="window.print()">Print this page</button>
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

