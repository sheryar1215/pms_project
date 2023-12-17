<?php
  $pageTitle = "Manage Medicines Details";
  $menuName = "Medicines Details";
  
  include "common_services/common_functions.php";
  include "config/connection.php";

  if(isset($_POST['save']))
  {
    
    $medicineNameId = $_POST['medicine_id'];
    $medicinePacking = $_POST['medicine_details_name'];

    try{

      $con->beginTransaction();
        
      $insertquery = "insert into `medicine_details`(`medicien_id`,`packing`)
      
      value($medicineNameId,'$medicinePacking');
      ";
      $insertStatment = $con->prepare($insertquery);
      $insertStatment->execute();
   
      $con->commit();

      $message = "Insert Medicines Details Sucessfully";
    }
  catch(PDOException $th){
  
    $con->rollBack();
    $message = "some database Query Error occurs";
  }
  header("location:congrats?goto_page=medicines_details&message=$message");
  }

       $selectQuery = "select `medicines`.`medicine_name` , `medicine_details`.* 
       from `medicines` ,`medicine_details` where `medicine_details`.`medicien_id` = `medicines`.`id` ";
  
       $selectStatment = $con->prepare($selectQuery);
       $selectStatment->execute();

  
  ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'config/site_css.php'; ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <?php include 'config/pre_loader.php'; ?>

  <!-- Navbar -->
  <?php include 'config/navbar.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include 'config/side_bar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php include 'config/bread_crumb.php'; ?>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <!-- our code starts here -->
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Manage Medicines Packing</h3>
                </div>

                <form method="post">
                  <div class="card-body">
                    <div class="row">


                    <div class="col-lg-4">
                        <div class="form-group">
                          <label >Medicines Packing</label>
                          <select name="medicine_id" id="medicine_id" 
                          class="form-control" required = "required">                                                      
                            <?php
                           echo getAllMedicineNames($con);
                          ?>                          

                          </select>
                          
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label >Medicines Packing</label>
                          <input type="text" class="form-control" id="medicine_details_name" 
                          name="medicine_details_name" placeholder="Enter Medicine Packing" required = "required">
                        </div>
                      </div>


                      <div class="col-lg-2">
                        <div class="form-group">
                          <label for="">&nbsp;</label>
                          <button  id="save" name="save" type="submit" class="btn-block btn btn-success">Save</button>
                        </div>
                      </div>

                    </div>

                    <!-- /.card-body -->

                </form>
              </div>
            </div>

            <!-- table starts -->

            <div class="card">
                <div class="card-header bg-primary">
                  <h3 class="card-title">All Medicines</h3>
                </div>

                <div class="card-body">
                  <table id="medicine_details_table" class="table table-hover table-bordered">
                    <thead>
                      <tr>
                        <th>S_NO</th>
                        <th>Medicines Name</th>
                        <th>Packing</th>
                        <th>Update</th>
                      </tr>
                    </thead>
                  
                    <tbody>
                      <?php
                      $count = 0;
                      while($row = $selectStatment->fetch(PDO::FETCH_ASSOC)){
                      $count++;
                      ?>
                      <tr>
                      <td><?php echo $count ;?></td>
                      <td><?php echo $row['medicine_name'];?></td>
                      <td><?php echo $row['packing'];?></td>
                      <td><a href="medicine_details_update?id=<?php echo $row['id'];?>"class="btn btn-warning text-light" ><i class="fa fa-edit"></i></a></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- table ends -->

            <!-- our code ends here -->
          </div>
      </section>
    </div>
  <!-- /.content-wrapper -->
  <?php include 'config/footer.php' ?>
</div>
<!-- ./wrapper -->

<?php  include 'config/site_js.php'; ?>

<script>
  $(document).ready(function () {
    $("#medicines_menu").addClass('menu-open');
    $("#medicine_menu_link").addClass('active');
    $("#medicine_details_link").addClass('active');
  
    addDataTable("medicine_details_table");

    $("#medicine_details_name").blur(function(){

      var columData = $(this).val();

      if(columData !== "")
      {

        $.ajax({
          url:"ajax/check_generic_uniqueness",
          type:"post",
          async: false,
          data :{

            table_name : "medicine_details",
            colunm_name : "packing",
            colunm_data : columData,
          },
          success : function(count)
          {
            count = count * 1;
            if(count > 0)
            {
              showMessage("error", "medicine details already exists");
              alert("i am here");
              $("#save").attr("disable" ,true);
            }else{
              $("#save").removeAttr("disable" ,true);  
            }
          }


        });


      }

    });


  
  });
</script>

</body>
</html>
