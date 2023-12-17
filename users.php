<?php
$pageTitle = "Manage users";
$menuName = "users";
include "common_services/common_functions.php";
include "config/connection.php";

if (isset($_POST['save'])) {

  $profilePicture = $_FILES['profile_picture'];
  $size = $profilePicture['size'];
  $fileName = $profilePicture['name'];
  $temName = $profilePicture['tmp_name'];
  $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
  $allowedExtenssions = array("jpg", "jpeg", "png", "gif");
  $fileNameToStore = time() . "_user_image_sheryar." . $ext;
  $path = "assets/images/user_images/" . $fileNameToStore;
  $isFileUploaded = 0;
  $message = "";

  if (!in_array($ext, $allowedExtenssions)) {
    $message = "Your file is not an image";
    $isFileUploaded = 0;
  } else if ($size  > 200000) {
    $message = "File size is too large.";
    $isFileUploaded = 0;
  } else {

    move_uploaded_file($temName, $path);
    $isFileUploaded = 1;
  }

  $fullName = $_POST['full_name'];
  $userName = $_POST['user_name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $incPassword = md5($password);
  $user_type_id = $_POST['user_type_id'];

  try {

    $con->beginTransaction();

    if ($isFileUploaded == 1) {
      $insertQuery = "INSERT INTO `users`(`user_type_id`,`full_name`,`user_name`,`email`,`password`, `profile_picture`) value
      ($user_type_id,'$fullName','$userName','$email','$incPassword', '$fileNameToStore')";
      $insertStatment = $con->prepare($insertQuery);
      $insertStatment->execute();

      $message = "insert data in user sucessfully";
    }


    $con->commit();
  } catch (PDOException $th) {
    $con->rollBack();
    $message = "some database query erro";
  }
  header("location:congrats?goto_page=users&message=$message");
}
$selectQuery = "select `users`.* , `user_types`.`type` from users , user_types  
 where users.`user_type_id` = user_types.id ";
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
                      <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter full Name" required="required">
                    </div>

                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>User Name</label>
                      <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter user Name" required="required">
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required="required">
                    </div>
                  </div>


                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required="required">
                    </div>
                  </div>



                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="">User Type</label>
                      <select name="user_type_id" id="user_type_id" class="form-control" required="required">
                        <?php
                        echo getAllUserTypes($con);
                        ?>
                      </select>
                    </div>
                  </div>


                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="profile_picture">Profile</label>
                      <input type="file" class="form-control" name="profile_picture" id="profile_picture" required="required">
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="">&nbsp;</label>
                      <button id="save" name="save" class="btn-block btn btn-success">Save</button>
                    </div>
                  </div>

                </div>
              </div>
              <!-- /.card-body -->

            </form>

          </div>

          <!-- table starts here -->

          <div class="col-12">
            <div class="card">
              <div class="card-header bg-primary">
                <h3 class="card-title">All users</h3>
              </div>

              <div class="card-body">
                <table id="users_table" class="table table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>S_No</th>
                      <th>Full Name</th>
                      <th>User Name</th>
                      <th>Email</th>
                      <th>User Type</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $count = 0;
                    while ($row = $selectStatment->fetch(PDO::FETCH_ASSOC)) {
                      $count++;
                      $btnClass = "";
                      $btnIcon = "";
                      if ($row['is_active']) {
                        $btnClass = "btn btn-success";
                        $btnIcon = "fa fa-unlock";
                      } else {
                        $btnClass = "btn btn-danger";
                        $btnIcon = "fa fa-lock";
                      }
                    ?>
                      <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $row['full_name'] ?></td>
                        <td><?php echo $row['user_name'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['type'] ?></td>
                        <td><a class="<?php echo $btnClass ?>" href="common_block_unblock?id=<?php echo $row['id'] ?>&status=<?php echo $row['is_active'] ?>&table_name=users&goto_page=users&type=users"> <i class="<?php echo $btnIcon; ?>"></i></a>
      <a href="update_users?id=<?php echo $row['id']; ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        </td>
                      </tr>

                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div> 
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
      $("#user_menue").addClass('menu-open');
      $("#user_menue_link").addClass('active');
      $("#user_link").addClass('active');

      addDataTable("users_table");

      $("#email").blur(function() {

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

      $("#user_name").blur(function(){
        var userName = $(this).val();
        var nameRegx = "^[A-Za-z][A-Za-z0-9_]{7,29}$";

        if (regEx.test(userName)) {
          $("#user_name").removeClass('invalid');
          $("#user_name").addClass('valid');
          $("#save").removeAttr('disabled');
        }else {
          $("#user_name").removeClass('valid');
          $("#user_name").addClass('invalid');
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