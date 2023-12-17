<?php
include "config/connection.php";

if(isset($_GET['message']))
{
  "<script>alert('".$_GET['message']."')</script>";
}

$id = $_GET['id'];


if(isset($_POST['save']))
{ 

  $medicineName = $_POST['medicine_name'];
  $hiddenId = $_POST['hidden_id'];
try{
  
  $updateQuery = "UPDATE `medicines` set `medicine_name` = '$medicineName' where id = $hiddenId";
  $updateStatment = $con->prepare($updateQuery);
  $updateStatment->execute();
  $message = "Medicine has been updated sucessfully";
}catch(PDOException $ex){
  $message = "some update query error accurs";
}
header("location:congrats.php?goto_page=medicines.php&message=$message");
}

$selectQuery ="SELECT * FROM `medicines` where `id` = $id ";
$selectStatment = $con->prepare($selectQuery);
$selectStatment->execute();

$row = $selectStatment->fetch(PDO::FETCH_ASSOC);


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
     
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- our code starts here -->
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Update Medicines</h3>
                </div>

                <form method="post">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label >Update Medicine Name</label>
                          <input type="text" class="form-control" id="medicine_name"  
                          value = "<?php echo $row['medicine_name'] ?>"
                          name="medicine_name"  required = "required" placeholder="Enter Medicine Name">

                          <input type="hidden" name="hidden_id" id="hidden_id" value="<?php echo $row['id']; ?>">
                        </div>
                      </div>


                      <div class="col-lg-2">
                        <div class="form-group">
                          <label for="">&nbsp;</label>
                          <button  id="save" name="save" type="submit" class="btn-block btn btn-success">Update</button>
                        </div>
                      </div>

                    </div>

                    <!-- /.card-body -->

                </form>
              </div>
            </div>

            <!-- table starts here -->
            
              <!--  table end here -->
            <!-- our code ends here -->
          </div>
      </section>
    </div>
    <!-- /.content-wrapper -->
    <?php include 'config/footer.php' ?>
  </div>
  <!-- ./wrapper -->

  <?php include 'config/site_js.php'; ?>


  <script>
    $(document).ready(function() {
      
      $("#medicines").blur(function(){
       
       alert("i am here"); 
        var medicineName = $(this).val();
        var hiddenId = $("#hidden_id").val();
        
        if(medicineName !== '') {
          $.ajax({

            url:"ajax/check_generic_updates_uniqueness",
            type:"get",
            async:false,
            data : {
              column_update_name :"medicine_name",
              table_name : "medicines",
              column_data: medicineName,
              hidden_id: hiddenId
            },
            success : function(count)
            {
              count = count * 1 ; 

              if(count > 0)
              {
                alert("Medicine already exist");
                $("#save").attr("disabled", true);
              }else{
                // alert("medicine add sucessfully");
                $("#save").removeAttr("disabled");
              }

            }


          });
        }

      });
    });
  </script>
</body>

</html>
