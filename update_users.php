<?php
$pageTitle = "Manage users";
$menuName = "users";
include "common_services/common_functions.php";
include "config/connection.php";
$id = $_GET['id'];
if (isset($_POST['save'])) {

  $fullName = $_POST['full_name'];
  $userName = $_POST['user_name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $hiddenId = $_POST['hidden_id'];
  $userTypeId = $_POST['user_type_id'];

  try {

    $con->beginTransaction();

    if (isset($_FILES['profile_picture'])) {

      $profilePicture = $_FILES['profile_picture'];
      $size = $profilePicture['size'];
      $tempName = $profilePicture['tmp_name'];
      $fileName = $profilePicture['name'];
      $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
      $allowExtension = array("jpg", "png", "jpeg", "gif");
      $fileNameToStore = time() . "_user_image_sherry." . $ext;
      $path = "assets/images/user_images/" . $fileNameToStore;
      $message = "";

      if (!in_array($ext, $allowExtension)) {
        $message = "your file is not an image";
        // die($message);
      } else if ($size > 200000) {
        $message = "your image is large in bites";
        // die($message);
      } else {

        move_uploaded_file($tempName, $path);
        $message = "your picture update successfully";
        // die($message);
        $updatePicture = "UPDATE `users` set `profile_picture` = '$fileNameToStore'  where `id` = $hiddenId ";
        $stmtPicture = $con->prepare($updatePicture);
        $stmtPicture->execute();
      }
    }


    if ($password !== "") {
      $incPassword = md5($password);
  
      $updateQuery = "UPDATE `users` set `user_type_id` = $userTypeId, `full_name` = '$fullName' ,`user_name` = '$userName' 
        , `email` = '$email', `password` = '$incPassword' where `id` = $hiddenId  ";
        
    } else {

      $updateQuery = "UPDATE `users` set `user_type_id` = $userTypeId, `full_name` = '$fullName' ,`user_name` = '$userName' 
        , `email` = '$email'  where `id` = $hiddenId ";
    }

    $updateStatement = $con->prepare($updateQuery);
    $updateStatement->execute();

    $con->commit();
    $message = "User has been updated successfully.";
  } catch (PDOException $th) {

    $con->rollBack();
    echo $th->getMessage();
    exit;

    $message = "some database query error";
  }
  header("location:congrats?goto_page=users&message=$message");
}
$selectQuery = "select * from users where id = $id";
$selectStatement = $con->prepare($selectQuery);
$selectStatement->execute();

$row = $selectStatement->fetch(pdo::FETCH_ASSOC);
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

          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Manage Users</h3>
            </div>

            <form method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="row">

                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>full Name</label>
                      <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter full Name" value="<?php echo $row['full_name'] ?>">
                    </div>

                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>User Name</label>
                      <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter user Name" value="<?php echo $row['user_name'] ?>">
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo $row['email'] ?>">
                    </div>
                  </div>


                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                    </div>
                  </div>



                  <div class="col-lg-2">
                    <div class="form-group">
                      <label for="">User Type</label>
                      <select class="form-control" name="user_type_id" id="user_type_id">
                        <?php
                        echo getAllUserTypes($con, $row['user_type_id']);
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="profile_picture">Profile</label>
                      <input type="file" class="form-control" name="profile_picture" id="profile_picture">
                    </div>
                  </div>

                  <input type="hidden" name="hidden_id" value="<?php echo $row['id'] ?>">

                  <div class="col-lg-2">
                    <div class="form-group">
                      <label for="">&nbsp;</label>
                      <button id="save" name="save" class="btn-block btn btn-success">update</button>
                    </div>
                  </div>

                </div>
              </div>
              <!-- /.card-body -->

            </form>

          </div>


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
      $("#user_menue").addClass('menu-open');
      $("#user_menue_link").addClass('active');
      $("#user_link").addClass('active');

      addDataTable("user_table_id");

      $("#email").blur(function(obj) {

var email = $(this).val();

var regEx = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

if (regEx.test(email)) {
  $("#email").removeClass('invalid');
  $("#email").addClass('valid');
  $("#save").removeAttr('disabled');
} else {
  $("#email").removeClass('valid');
  $("#email").addClass('invalid');
  $("#save").attr('disabled', true);
}
});
    });
  </script>
 <style>
    .valid {
      border: 2px solid green;
      font-weight: bolder;
    }

    .invalid {
      color: red;
      border: 2px solid red;
      font-weight: bolder;
    }
  </style>
</body>

</html>