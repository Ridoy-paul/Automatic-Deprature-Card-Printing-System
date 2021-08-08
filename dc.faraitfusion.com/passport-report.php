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
                        <div class="card">
                        <div class="card-header bg-dark" style="padding: 10px; font-weight: bold;">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 style="font-weight: bold;">Scanned Passport Report</h3>
                                      <p>Last 7 Days</p>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-danger btn-lg"  data-toggle="modal" data-target="#exampleModalForAll">
                                         Datewise Report Search
                                        </button>
                                        
                                        
                                        <!--DateWise Sell Search Modal -->
                                        <div class="modal fade" id="exampleModalForAll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" style="color: black;" id="exampleModalLabel">DateWise Report</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                            <form method="get" id="insert_form" action="passport-startdate-to-enddate-report.php" target="_blank">
                                               <div class="form-group">
                                                    <label style="color: black;" for="exampleInputEmail1">Start Date</label>
                                                    <input type="text" name="AllStartDate" id="AllStartDate" class="form-control" placeholder="Insert a Start Date" value="" required>
                                                </div>
                                                <div class="form-group">
                                                    <label style="color: black;" for="exampleInputEmail1">End Date</label>
                                                    <input type="text" name="AllEndDate" class="form-control" id="AllEndDate" placeholder="Insert a End Date" value=""  required>
                                                </div>
                                                
                                              </div>
                                              <div class="card-footer">
                                                  <input  type="submit" name="ReceivedSearch" id="insert" value="Search" class="btn btn-success form-control" required>
                                                </div>
                                                </form>
                                            </div>
                                          </div>
                                        </div>
                                        
                                </div>
                            </div>
                          
                          </div>
                          <div class="card-body">
                              <div class="row">
                                <div class="col-md-3 col-3 text-center">
                                    <h5 class="">Today</h5>
                                </div>
                                <div class="col-md-3 col-3 text-center">
                                    <h5 class=""><?php
                                            
                                            $date = date("Y-m-d");
                                            //echo $date;
                                            $query = query("SELECT COUNT(id) AS total FROM passportInfo WHERE date='$date'");
                                            confirm($query);
                                            $row = fetch_array($query);
                                            $sum = $row['total'];
                                            echo $sum;
                                          
                                    ?></h5>
                                </div>
                                <div class="col-md-3 col-3 text-center">
                                    <h5 class="">Cost: <?php
                                            
                                            $date = date("Y-m-d");
                                            //echo $date;
                                            $Costquery = query("SELECT SUM(print_price) AS totalCost FROM passportInfo WHERE date='$date'");
                                            confirm($Costquery);
                                            $row = fetch_array($Costquery);
                                            $sum = $row['totalCost']+0;
                                            echo $sum;
                                          
                                    ?></h5>
                                </div>
                                
                                <div class="col-md-3 col-3 text-center">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">See All</button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                            <i class="fa fa-eye"></i> View Departure Card</a>
                                                                       
                                                                        
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
                                </div>
                                
                              </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3 col-3 text-center">
                                    <h5 class=""><?php 
                                        $date = date('Y-m-d', strtotime('-1 days'));
                                        $forMatedDate = date("d M, Y", strtotime($date));
                                        echo $forMatedDate;
                                    ?></h5>
                                </div>
                                <div class="col-md-3 col-3 text-center">
                                    <h5 class="">
                                    <?php
                                            
                                            $date = date('Y-m-d', strtotime('-1 days'));
                                            $query = query("SELECT COUNT(id) AS total FROM passportInfo WHERE date='$date'");
                                            confirm($query);
                                            $row = fetch_array($query);
                                            $sum = $row['total'];
                                            echo $sum;
                                          
                                    ?>
                                    </h5>
                                </div>
                                <div class="col-md-3 col-3 text-center">
                                    <h5 class="">Cost: <?php
                                            
                                            $date = date('Y-m-d', strtotime('-1 days'));
                                            //echo $date;
                                            $Costquery = query("SELECT SUM(print_price) AS totalCost FROM passportInfo WHERE date='$date'");
                                            confirm($Costquery);
                                            $row = fetch_array($Costquery);
                                            $sum = $row['totalCost']+0;
                                            echo $sum;
                                          
                                    ?></h5>
                                </div>
                                <div class="col-md-3 col-3 text-center">
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
                                </div>
                              </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3 col-3 text-center">
                                    <h5 class=""><?php 
                                        $date = date('Y-m-d', strtotime('-2 days'));
                                        $forMatedDate = date("d M, Y", strtotime($date));
                                        echo $forMatedDate;
                                    
                                    ?></h5>
                                </div>
                                <div class="col-md-3 col-3 text-center">
                                    <h5 class="">
                                    <?php
                                            
                                            $date = date('Y-m-d', strtotime('-2 days'));
                                            $query = query("SELECT COUNT(id) AS total FROM passportInfo WHERE date='$date'");
                                            confirm($query);
                                            $row = fetch_array($query);
                                            $sum = $row['total'];
                                            echo $sum;
                                          
                                    ?>
                                    </h5>
                                </div>
                                <div class="col-md-3 col-3 text-center">
                                    <h5 class="">Cost: <?php
                                            
                                            $date = date('Y-m-d', strtotime('-2 days'));
                                            //echo $date;
                                            $Costquery = query("SELECT SUM(print_price) AS totalCost FROM passportInfo WHERE date='$date'");
                                            confirm($Costquery);
                                            $row = fetch_array($Costquery);
                                            $sum = $row['totalCost']+0;
                                            echo $sum;
                                          
                                    ?></h5>
                                </div>
                                <div class="col-md-3 col-3 text-center">
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
                                </div>
                              </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3 col-3 text-center">
                                    <h5 class=""><?php 
                                        $date = date('Y-m-d', strtotime('-3 days'));
                                        $forMatedDate = date("d M, Y", strtotime($date));
                                        echo $forMatedDate;
                                    
                                    ?></h5>
                                </div>
                                <div class="col-md-3 col-3 text-center">
                                    <h5 class="">
                                        <?php
                                            
                                            $date = date('Y-m-d', strtotime('-3 days'));
                                            $query = query("SELECT COUNT(id) AS total FROM passportInfo WHERE date='$date'");
                                            confirm($query);
                                            $row = fetch_array($query);
                                            $sum = $row['total'];
                                            echo $sum;
                                          
                                    ?>
                                    </h5>
                                </div>
                                <div class="col-md-3 col-3 text-center">
                                    <h5 class="">Cost: <?php
                                            
                                            $date = date('Y-m-d', strtotime('-3 days'));
                                            //echo $date;
                                            $Costquery = query("SELECT SUM(print_price) AS totalCost FROM passportInfo WHERE date='$date'");
                                            confirm($Costquery);
                                            $row = fetch_array($Costquery);
                                            $sum = $row['totalCost']+0;
                                            echo $sum;
                                          
                                    ?></h5>
                                </div>
                                <div class="col-md-3 col-3 text-center">
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
                                </div>
                              </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3 col-3 text-center">
                                    <h5 class=""><?php 
                                        $date = date('Y-m-d', strtotime('-4 days'));
                                        $forMatedDate = date("d M, Y", strtotime($date));
                                        echo $forMatedDate;
                                    
                                    ?></h5>
                                </div>
                                <div class="col-md-3 col-3 text-center">
                                    <h5 class="">
                                        <?php
                                            
                                            $date = date('Y-m-d', strtotime('-4 days'));
                                            $query = query("SELECT COUNT(id) AS total FROM passportInfo WHERE date='$date'");
                                            confirm($query);
                                            $row = fetch_array($query);
                                            $sum = $row['total'];
                                            echo $sum;
                                          
                                    ?>
                                    </h5>
                                </div>
                                <div class="col-md-3 col-3 text-center">
                                    <h5 class="">Cost: <?php
                                            
                                            $date = date('Y-m-d', strtotime('-4 days'));
                                            //echo $date;
                                            $Costquery = query("SELECT SUM(print_price) AS totalCost FROM passportInfo WHERE date='$date'");
                                            confirm($Costquery);
                                            $row = fetch_array($Costquery);
                                            $sum = $row['totalCost']+0;
                                            echo $sum;
                                          
                                    ?></h5>
                                </div>
                                <div class="col-md-3 col-3 text-center">
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
                                </div>
                              </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3 col-3 text-center">
                                    <h5 class=""><?php 
                                        $date = date('Y-m-d', strtotime('-5 days'));
                                        $forMatedDate = date("d M, Y", strtotime($date));
                                        echo $forMatedDate;
                                    
                                    ?></h5>
                                </div>
                                <div class="col-md-3 col-3 text-center">
                                    <h5 class="">
                                        <?php
                                            
                                            $date = date('Y-m-d', strtotime('-5 days'));
                                            $query = query("SELECT COUNT(id) AS total FROM passportInfo WHERE date='$date'");
                                            confirm($query);
                                            $row = fetch_array($query);
                                            $sum = $row['total'];
                                            echo $sum;
                                          
                                    ?>
                                    </h5>
                                </div>
                                <div class="col-md-3 col-3 text-center">
                                    <h5 class="">Cost: <?php
                                            
                                            $date = date('Y-m-d', strtotime('-5 days'));
                                            //echo $date;
                                            $Costquery = query("SELECT SUM(print_price) AS totalCost FROM passportInfo WHERE date='$date'");
                                            confirm($Costquery);
                                            $row = fetch_array($Costquery);
                                            $sum = $row['totalCost']+0;
                                            echo $sum;
                                          
                                    ?></h5>
                                </div>
                                <div class="col-md-3 col-3 text-center">
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
                                </div>
                              </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3 col-3 text-center">
                                    <h5 class=""><?php 
                                        $date = date('Y-m-d', strtotime('-6 days'));
                                        $forMatedDate = date("d M, Y", strtotime($date));
                                        echo $forMatedDate;
                                    
                                    ?></h5>
                                </div>
                                <div class="col-md-3 col-3 text-center">
                                    <h5 class="">
                                        <?php
                                            
                                            $date = date('Y-m-d', strtotime('-6 days'));
                                            $query = query("SELECT COUNT(id) AS total FROM passportInfo WHERE date='$date'");
                                            confirm($query);
                                            $row = fetch_array($query);
                                            $sum = $row['total'];
                                            echo $sum;
                                          
                                    ?>
                                    </h5>
                                </div>
                                <div class="col-md-3 col-3 text-center">
                                    <h5 class="">Cost: <?php
                                            
                                            $date = date('Y-m-d', strtotime('-6 days'));
                                            //echo $date;
                                            $Costquery = query("SELECT SUM(print_price) AS totalCost FROM passportInfo WHERE date='$date'");
                                            confirm($Costquery);
                                            $row = fetch_array($Costquery);
                                            $sum = $row['totalCost']+0;
                                            echo $sum;
                                          
                                    ?></h5>
                                </div>
                                <div class="col-md-3 col-3 text-center">
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
                                </div>
                              </div>
                            <hr>
                            
                          </div>
                        </div>
                    </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  
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

    <!--<footer class="main-footer">-->
        <!--<strong>Copyright &copy; 2020 <a href="http://faraitfusion.com">FARA IT Fusion</a>.</strong>-->
        <!--All rights reserved.-->
        <!--<div class="float-right d-none d-sm-inline-block">-->
        <!--    <b>Version</b> 1.1.0-->
        <!--</div>-->
    <!--</footer>-->


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
$('#receivedStartDate').datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    yearRange: "-100:+0",
    dateFormat: "yy-mm-dd"

});

$('#receivedEndDate').datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    yearRange: "-100:+0",
    dateFormat: "yy-mm-dd"

});

$('#sellStartDate').datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    yearRange: "-100:+0",
    dateFormat: "yy-mm-dd"

});

$('#sellEndDate').datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    yearRange: "-100:+0",
    dateFormat: "yy-mm-dd"

});

$('#AllStartDate').datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    yearRange: "-100:+0",
    dateFormat: "yy-mm-dd"

});

$('#AllEndDate').datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    yearRange: "-100:+0",
    dateFormat: "yy-mm-dd"

});

</script>







</body>
</html>

