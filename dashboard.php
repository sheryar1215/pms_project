<?php
include "config/connection.php"; 
$pageTitle = "Dashboard";
$menuName = "Dashboard";

$queryTotalMedicines = "select count(*) as medicines_count from
medicines as m, medicine_details as md where m.id=md.medicien_id";

$stmtTotalMedicines = $con->prepare($queryTotalMedicines);
$stmtTotalMedicines->execute();
$rowTotalMedicines = $stmtTotalMedicines->fetch(PDO::FETCH_ASSOC);



$queryTotalPatients = "select count(*) as patients_count from
patients as p;";

$stmtTotalPatients = $con->prepare($queryTotalPatients);
$stmtTotalPatients->execute();
$rowTotalPatients = $stmtTotalPatients->fetch(PDO::FETCH_ASSOC);


$queryTotalTests = "select count(*) as tests_count from
lab_tests as t;";

$stmtTotalTests = $con->prepare($queryTotalTests);
$stmtTotalTests->execute();
$rowTotalTests = $stmtTotalTests->fetch(PDO::FETCH_ASSOC);


$queryTotalPrescriptions = "select count(*) as prescriptions_count from
patient_visits as p;";

$stmtTotalPrescriptions = $con->prepare($queryTotalPrescriptions);
$stmtTotalPrescriptions->execute();
$rowTotalPrescriptions = $stmtTotalPrescriptions->fetch(PDO::FETCH_ASSOC);



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

          <section class="content">
            <div class="container-fluid">
              <!-- Small boxes (Stat box) -->
              <div class="row">
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-info">
                    <div class="inner">
                      <h3><?php echo $rowTotalMedicines['medicines_count']; ?></h3>

                      <p>Total Medicines</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-success">
                    <div class="inner">
                      <h3><?php echo $rowTotalPatients['patients_count']; ?><sup style="font-size: 20px"></sup></h3>

                      <p>Total Patients</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-warning">
                    <div class="inner">
                      <h3><?php echo $rowTotalTests['tests_count']; ?></h3>

                      <p>Total Tests</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-danger">
                    <div class="inner">
                      <h3><?php echo $rowTotalPrescriptions['prescriptions_count']; ?></h3>

                      <p>Total Prescriptions</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
              </div>


            </section>    <!-- our code ends here -->
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
        $("#dashboard_menu_link").addClass('active');

    // showMessage('success', 'Test');
    

    

  });
</script>
</body>
</html>
