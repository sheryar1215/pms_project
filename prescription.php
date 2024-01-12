<?php
$pageTitle = "Manage Prescriptions";
$menuName = "Prescription";

include "config/connection.php";
include "common_services/common_functions.php";

  if(isset($_POST['save'])) {
    
    
    $createdBy = $_SESSION['user_id'];
    $createdAt = date('Y-m-d H:i:s');

    $patientsId = $_POST['patients_id'];
    $visitDate = $_POST['visit_date'];
    $suger = $_POST['suger'];
    $bloodPresure = $_POST['blood_presure'];
    $nextVisitDate = $_POST['next_visit_date'];
    
    $medicineDetailIds = $_POST['medicine_detail_ids'];    
    $quantities = $_POST['quantities'];
    $dosages = $_POST['dosages'];  
    
    $diseases = $_POST['diseases'];

    $labTestIds = $_POST['lab_test_ids'];
    $labTestResults = $_POST['lab_test_results'];


    try {
      $con->beginTransaction();

      //inserting 1 row in patient visits table
      $queryInsertPatientVisits = "INSERT INTO `patient_visits`(`patient_id`, `date`, `blood_presure`, `suger`, `next_visit_date`, `created_by`, `created_at`) 
        VALUES ($patientsId, '$visitDate', '$bloodPresure', '$suger', '$nextVisitDate',
        $createdBy, '$createdAt');";

        $stmtInsertPatientVisits = $con->prepare($queryInsertPatientVisits);
        $stmtInsertPatientVisits->execute();

        $patientVisitId = $con->lastInsertId();
        $_SESSION['patient_visit_id'] = $patientVisitId;


        //inserting rows in patient visits medications table..
        foreach ($medicineDetailIds as $index => $medicineDetailsId) {
          $curDosage = $dosages[$index];
          $curQuantity = $quantities[$index];

          $queryInsertPatientVisitMedications = "INSERT INTO `patient_visit_medications`(`patient_visit_id`, `medicien_detail_id`, `created_by`, `created_at`, `quantity`, `dosage`) VALUES ($patientVisitId, $medicineDetailsId, 
            $createdBy, '$createdAt', '$curDosage', $curQuantity);";

          $stmtInsertPatientVisitMedications = $con->prepare($queryInsertPatientVisitMedications);

          $stmtInsertPatientVisitMedications->execute();
        }

        // inserting rows in patient visit deases table
        foreach($diseases as $key) {
          $queryInsertPatientVisitDiseases = "INSERT INTO `patient_visit_diseases`(`patient_visit_id`, `disease_id`, `created_by`, `created_at`) 
            VALUES ($patientVisitId, $key, $createdBy, '$createdAt');";

            $stmtInsertPatientVisitDiseases = $con->prepare($queryInsertPatientVisitDiseases);
            $stmtInsertPatientVisitDiseases->execute();
        }

        //inserting rows in patient visit tests table
        foreach($labTestIds as $index=> $testId) {
          $curTestResult = $labTestResults[$index];
          $queryInsertPatientVisitLabTest = "INSERT INTO `patient_visit_tests`(`patient_visit_id`, `lab_test_id`, `test_result`) 
            VALUES ($patientVisitId, $testId, '$curTestResult')";

            $stmtInsertPatientVisitLabTest = $con->prepare($queryInsertPatientVisitLabTest);
            $stmtInsertPatientVisitLabTest->execute();
        }


      $con->commit();

      $message =  "success-Prescription saved successfully.";

    } catch (PDOException $ex) {
      $con->rollback();
      echo $ex->getMessage();
      exit;
    }
    

    header("location:congrats?goto_page=prescription&message=$message");

}


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

          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">patients</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="post">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Select Patient</label>
                      <select class="form-control" style="width: 100%;" id="patients_id" name="patients_id">
                        <?php echo getAllPatientsNames($con); ?>
                      </select>
                    </div>
                  </div>
                  <!-- /.form-group -->
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label>Visit Date</label>
                      <input type="date" class="form-control" id="visit_date" name="visit_date" value="<?php echo date('Y-m-d') ?>" required="required">
                    </div>
                  </div>

                  <div class="col-lg-1">
                    <div class="form-group">
                      <label>S/G</label>
                      <input type="text" class="form-control" id="suger" name="suger" required="required">
                    </div>
                  </div>
                  <div class="col-lg-1">
                    <div class="form-group">
                      <label>B/P</label>
                      <input type="text" class="form-control" id="blood_presure" name="blood_presure" required="required">
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Next Visit Date</label>
                      <input type="date" class="form-control" id="next_visit_date" name="next_visit_date" required="required">
                    </div>
                  </div>

                </div>



                <hr style="border: 1px solid  black;">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Select Medicines</label>
                      <select class="form-control " style="width: 100%;" id="medicine_name">
                        <?php echo getAllMedicineNames($con); ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Packing</label>
                      <select class="form-control " style="width: 100%;" id="packing">

                      </select>
                    </div>
                  </div>
                  <!-- /.form-group -->
                  <div class="col-lg-2">
                    <div class="form-group">
                      <label>Quantity</label>
                      <input type="text" class="form-control" id="quantity">
                    </div>
                  </div>

                  <div class="col-lg-2">
                    <div class="form-group">
                      <label>Dosage</label>
                      <input type="text" class="form-control" id="dosage">
                    </div>
                  </div>
                  <div class="col-lg-1">
                    <div class="form-group">
                      <br>
                      <button type="button" id="add_medicine_to_list" class="form-control bg-success mt-2 p-2"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>
                </div>
                <div class="row">

                  <div class="card-body">
                    <table id="medicine_table" class="table table-hover table-bordered">
                      <thead>
                        <tr>
                          <th>S_NO</th>
                          <th>Medicines Name</th>
                          <th>Packing</th>
                          <th>Quality</th>
                          <th>Dosage</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody id="medicine_table_tbody">

                      </tbody>
                    </table>
                  </div>
                </div>

                <hr style="border: 1px solid  black;">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Select Diseases</label>
                      <select name="diseas_id" id="diseas_id" class="form-control">

                        <?php echo  getAlldiseasesNames($con) ?>

                      </select>
                    </div>
                  </div>
                  <div class="col-lg-1">
                    <div class="form-group">
                      <br>
                      <button type="button" id="disease_btn" class="form-control bg-success mt-2 p-2"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>

                  <hr style="border: 1px solid  black;">
                </div>

                <div class="card-body">
                  <table id="" class="table table-hover table-bordered">
                    <thead>
                      <tr>
                        <th>S_NO</th>
                        <th>Disease Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody id="disease_table">

                    </tbody>
                  </table>
                </div>

                <hr style="border: 1px solid  black;">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Select Tests</label>
                      <select id="test_id" class="form-control " style="width: 100%;">
                        <?php echo  getAllTests($con) ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Tests Result</label>

                      <input type="text" id="test_result" class="form-control">

                    </div>
                  </div>
                  <div class="col-lg-1">
                    <div class="form-group">
                      <br>
                      <button id="tests_btn" type="button" class="form-control bg-success mt-2 p-2"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>

                  <div class="card-body">
                    <table id="" class="table table-hover table-bordered">
                      <thead>
                        <tr>
                          <th>S_NO</th>
                          <th>Test Name</th>
                          <th>Test Result</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody id="test_table_tbody">

                      </tbody>  
                    </table>
                  </div>

                </div>

                <div class="row text-right">
                  <div class="col-lg-12">
                    <button class="btn btn-success" name="save" type="submit">Save Prescription</button>
                  </div>
                </div>
              </form>
            </div>

            <!-- our code ends here -->
      </section>
    </div>
    <!-- /.content-wrapper -->
    <?php include 'config/footer.php' ?>
  </div>
  <!-- ./wrapper -->

  <?php include 'config/site_js.php'; ?>


  <?php
    if(isset($_SESSION['patient_visit_id'])) {
  ?>

<script>
  var patientVisitId = "<?php echo $_SESSION['patient_visit_id']; ?>";

  window.open('print_prescription?patient_visit_id='+patientVisitId, '_blank');
</script>
<?php } ?>



  <script>
    $(document).ready(function() {
      $("#Prescriptions_link").addClass('active');
      $("#patients_menue").addClass('menu-open');
      $("#patients_menue_link").addClass('active');

      $("#medicine_name").change(function() {
        var medicineId = $(this).val();

        if (medicineId != '') {
          $.ajax({

            url: "ajax/get_packing_against_medicine",
            type: "get",
            async: false,
            data: {
              medicine_id: medicineId
            },
            success: function(response) {
              if (response != "") {
                $("#packing").html(response);
              } else {
                $("#packing").html("");
                showMessage("error", "Packing not found!");
              }

            }


          });
        }
      });
      var medicineSerial = 1;
      var diseasSerial = 1;
      var testSerial = 1;
      $("#add_medicine_to_list").click(function() {
        var items = "";
        var medicineId = $("#medicine_name").val().trim();
        var medicineName = $("#medicine_name option:selected").text();

        var medicineDetailsId = $("#packing").val().trim();
        var packingText = $("#packing option:selected").text();

        var quantity = $("#quantity").val();  
        var dosage = $("#dosage").val().trim();

        var button = "<button onclick='deleteRow(this, `serial_medicine`)' class='btn btn-danger'><i class='fa fa-times'></i></button>";
        items = $("#medicine_table_tbody").html();

        items = items + "<tr>";
        items = items + "<td class='serial_medicine'>" + medicineSerial++ + "</td>";
        items = items + "<td>" + medicineName + "</td>";
        items = items + "<td> <input type='hidden' value='"+medicineDetailsId+"' name='medicine_detail_ids[]'>" + packingText + "</td>";
        items = items + "<td><input type='hidden' value='"+quantity+"' name='quantities[]'>" + quantity + "</td>";
        items = items + "<td><input type='hidden' value='"+dosage+"' name='dosages[]'>" + dosage + "</td>";
        items = items + "<td>" + button + "</td>";
        items = items + "</tr>";

        $("#medicine_table_tbody").html(items);

        $("#medicine_name").val('');
        $("#packing").val('');
        $("#quantity").val('');
        $("#dosage").val('');
        $("#medicine_name").focus();
      });


      $("#disease_btn").click(function() {

        var diseaseId = $("#diseas_id").val().trim();
        var diseaseName = $("#diseas_id option:selected").text();
        var button = "<button onclick='deleteRow(this, `diseas_serial`)' class='btn btn-danger'><i class='fa fa-times'></i></button>";
        var item = $("#disease_table").html();

        item = item + "<tr>";
        item = item + "<td class='diseas_serial'>" + diseasSerial++ + "</td>";
        item = item + "<td> <input type='hidden' value='"+diseaseId+"' name='diseases[]'>" + diseaseName + "</td>";
        item = item + "<td>" + button + "</td>";
        item = item + "</tr>";

        $("#disease_table").html(item);

        $("#diseas_id").val('');
        $("#diseas_id").focus();
      });

      $("#tests_btn").click(function() {

        var testId = $("#test_id").val().trim();
        var testName = $("#test_id option:selected").text();
        var testResult = $("#test_result").val();
        var button = "<button onclick='deleteRow(this, `test_serial`)' class='btn btn-danger'><i class='fa fa-times'></i></button>";
        var item = $("#test_table_tbody").html();

        item = item + "<tr>";
        item = item + "<td class='test_serial'>" + testSerial++ + "</td>";
        item = item + "<td> <input type='hidden' value='"+testId+"' name='lab_test_ids[]'>" + testName + "</td>";
        item = item + "<td> <input type='hidden' value='"+testResult+"' name='lab_test_results[]'>" + testResult + "</td>";
        item = item + "<td>" + button + "</td>";
        item = item + "</tr>";

        $("#test_table_tbody").html(item);

        $("#test_id").val('');
        $("#test_id").focus();
      });

    });

    function deleteRow(obj, serialClass) {
      if (confirm('Are you sure to delete?')) {
        $(obj).closest('tr').remove();

        reArrangeSerials(serialClass);
      }
    }

    function reArrangeSerials(serialClass) {
      var i = 1;
      $("." + serialClass).each(function() {
        $(this).html(i);
        i++;
      });
    }
  </script>
</body>
</html>