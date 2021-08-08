<?php require_once("backend/config.php"); ?>
<?php include("header.php"); ?>
<?php include ("left-sidebar.php");?>

<?php

     $username =  $_SESSION['username'];
     
    $f_query=query("SELECT * FROM `admin` where username='$username' || gmail = '$username'");
    confirm($f_query);
    $f_rows=fetch_array($f_query);
    $type = $f_rows['type'];
    
    $DBcrmId = $f_rows['id'];
    
    $crmID = $_GET['crmID'];
    
    $today = date("Y-m-d");
    
    if ($type == 'Admin' || ($type == 'CRM' && $crmID == $DBcrmId)){
        ?>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->
            <div class="">
              <div class="">
                <div class="row">
                    <div class="col-md-12">
                        <h1 style="text-align:left;"><b></b></h1>
                    </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div style="padding: 10px 10px;" class="">
                <div class="row">
                   <div class="col-md-4 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3 id="h3Title">Todays Print</h3>
                                <?php
                                    $todaysPrintQ = query("SELECT COUNT(id) AS todayTotal FROM passportInfo WHERE printBy='$crmID' AND date='$today'");
                                    confirm($todaysPrintQ);
                                    $rowOfPQ = fetch_array($todaysPrintQ);
                                    $totalTD = $rowOfPQ['todayTotal'];
                                
                                ?>
                                    <h2><b><?php echo number_format($totalTD); ?></b></h2>
                            </div>
                            <div class="icon">
                                <i class="fas fa-plane"></i>
                            </div>
                            <a href="all-scanned-passport.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3 id="h3Title">Todays Income</h3>
                                <?php
                                    $todaysIncomeQ = query("SELECT SUM(print_price) AS todayIncome FROM passportInfo WHERE printBy='$crmID' AND date='$today'");
                                    confirm($todaysIncomeQ);
                                    $rowOfTI = fetch_array($todaysIncomeQ);
                                    $todayIncome = $rowOfTI['todayIncome'];
                                
                                ?>
                                    <h2><b><?php echo number_format($todayIncome, 2); ?></b></h2>
                            </div>
                            <div class="icon">
                                <i class="fas fa-file-invoice-dollar"></i>
                            </div>
                            <a href="all-scanned-passport.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3 id="h3Title">Total Print</h3>
                                    <?php
                                    $totalPrintQ = query("SELECT COUNT(id) AS TotalPrint FROM passportInfo WHERE printBy='$crmID'");
                                    confirm($totalPrintQ);
                                    $rowOfTP = fetch_array($totalPrintQ);
                                    $totalPrint = $rowOfTP['TotalPrint'];
                                
                                ?>
                                    <h2><b><?php echo number_format($totalPrint); ?></b></h2>
                            </div>
                            <div class="icon">
                                <i class="fab fa-telegram-plane"></i>
                            </div>
                            <a href="all-scanned-passport.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3 id="h3Title">Total Income</h3>
                                    <?php
                                    $totalIncomeQ = query("SELECT SUM(print_price) AS totalIncome FROM passportInfo WHERE printBy='$crmID'");
                                    confirm($totalIncomeQ);
                                    $rowOfTotalI = fetch_array($totalIncomeQ);
                                    $totalIncome = $rowOfTotalI['totalIncome'];
                                
                                ?>
                                    <h2><b><?php echo number_format($totalIncome, 2); ?></b></h2>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="all-scanned-passport.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
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

