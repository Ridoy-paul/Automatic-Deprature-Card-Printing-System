<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">All Products</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="col-12">
                 <div class="card">
              <div class="card-header">
                <button type="button" class="btn btn-default" id="add" data-toggle="modal" data-target="#modal_insert">
                  Add new Product
                </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sl.</th>
                    <th>Product Model</th>
                    <th>Type</th>
                    <th>Unit</th>
                    <th>Price(BDT)</th>
                    <th>Price($USD)</th>
                    <th>Price(EURO)</th>
                    <th>Description</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  
                  <tbody>
                      <?php
                        $query = query("SELECT * FROM products ORDER BY id DESC");
                        confirm($query);
                        $rows = mysqli_num_rows($query);
                        if($rows > 0){
                            $i = 1;
                            while($row = fetch_array($query)){
                                ?><tr>
                               <td><?php echo $i ?></td>
                               <td>
                                   <a href=""><?php echo $row['model'] ?></a>
                               </td>
                               <td><?php echo $row['type'] ?></td>
                               <td><?php echo $row['unit'] ?></td>
                                <td><?php echo $row['priceBDT'] ?></td>
                               <td><?php echo $row['priceUSD'] ?></td>
                               <td><?php echo $row['priceEURO'] ?></td>
                               <td><abbr title="Click to View" class="text-success">
                                 <button onclick="ViewDescription(<?php echo $row['id'] ?>)" type="button" class="btn btn-primary" data-toggle="modal" data-target="">View</button>
                                 </td>
                                 <?php
                                 if(isset($_SESSION['username'])){
                                     $username =  $_SESSION['username'];
            $f_query=query("SELECT * FROM `admin` where username='$username' || gmail = '$username'");
            confirm($f_query);
            $f_rows=fetch_array($f_query);
            $type = $f_rows['type'];
            if ($type == 'Admin'){
                ?>
                <td>
                                               <abbr title="Click to Edit" class="text-success">
                                 <i onclick="EditProduct(<?php echo $row['id'] ?>)"  class="far fa-edit btn btn-sm btn-primary"></i></abbr>
                                              <abbr title="Click to Delete" class="text-success">
                                 <a onclick="DeleteProduct(<?php echo $row['id']?>)" href=""><i class="fas fa-eye-slash btn btn-sm btn-danger"></i></a></abbr>
                              </td>
                <?php
            }
            else{
                ?><td>
                                               <abbr title="Click to Edit" class="text-success">
                                 <i onclick="EditProduct(<?php echo $row['id'] ?>)"  class="far fa-edit btn btn-sm btn-primary"></i></abbr>
                                              
                              </td><?php
            }
            
                                 }
                                 ?>
                                
                    </tr><?php
                               
                             $i++;
                            }
                        }
?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
             
            
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
  <!--Data Insert Modal Start -->
  <!-- /.content-wrapper -->
  <div class="modal fade" id="modal_insert">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add New Product</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" id="insert_form">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Product Model</label>
                        <input type="text" name="type" class="form-control" id="model" placeholder="Ex: Model with product name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Type</label>
                        <input type="text" name="type" class="form-control" id="type" placeholder="Ex: type">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Price(BDT)</label>
                        <input type="number" name="hotline" class="form-control" id="price_bdt" placeholder="Ex: ">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Price(USD)</label>
                        
                        <input type="number" name="email" class="form-control" id="price_usd" placeholder="Ex: 450">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Price(EURO)</label>
                        <input type="number" name="email" class="form-control" id="price_euro" placeholder="Ex: 500">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Unit</label>
                        <select class="form-control" id="unit" name="unit">
                            <option value="Set">Set</option>
                            <option value="No./S">No./S</option>
                            <option value="Meter">Meter</option>
                            <option value="Kg">Kg</option>
                            
                        </select>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input onclick="addProduct()" type="submit" name="insert" id="insert" value="Insert" class="btn btn-success swalDefaultSuccess"/>
                </div>
              </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      
      <!--Data Insert Modal End -->
      
      <!--Data Update Modal Start -->
      <div class="modal fade" id="modal_update">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Update Contact</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" id="update_form">
                <div class="card-body">
                    <div class="form-group">
                        <label for="update_model">Product Model</label>
                        <input type="text" name="type" class="form-control" id="update_model" placeholder="Ex: Model with product name">
                    </div>
                    <div class="form-group">
                        <label for="update_type">Type</label>
                        <input type="text" name="type" class="form-control" id="update_type" placeholder="Ex: type">
                    </div>
                    <div class="form-group">
                        <label for="update_description">Description</label>
                        <textarea class="form-control" name="description" id="update_description" rows="3" placeholder="Enter description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="update_price_bdt">Price(BDT)</label>
                        <input type="number" name="hotline" class="form-control" id="update_price_bdt" placeholder="Ex: ">
                    </div>
                    <div class="form-group">
                        <label for="update_price_usd">Price(USD)</label>
                        <input type="number" name="email" class="form-control" id="update_price_usd" placeholder="Ex: 450">
                    </div>
                    <div class="form-group">
                        <label for="update_price_euro">Price(EURO)</label>
                        <input type="number" name="email" class="form-control" id="update_price_euro" placeholder="Ex: 500">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Unit</label>
                        <select class="form-control" id="update_unit" name="update_unit">
                            <option value="Set">Set</option>
                            <option value="No./S">No./S</option>
                            <option value="Meter">Meter</option>
                            <option value="Kg">Kg</option>
                            
                        </select>
                    </div>
                </div>
                <input type="hidden" name="hidden_product_id" id="hidden_product_id" />
                <!-- /.card-body -->

                <div class="card-footer">
                  <input onclick="UpdateProduct()" type="submit" name="insert" id="insert" value="Update" class="btn btn-success swalDefaultSuccess form-control"/>
                </div>
              </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!--Data Update Modal End -->
      
      
      
      <!-- Modal for view details-->
<div class="modal fade" id="modal_view_description" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <textarea id="description_data" name="" id="" cols="30" rows="10" class="form-control"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

