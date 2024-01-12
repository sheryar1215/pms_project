<?php
$pageTitle = "Manage Search Prescriptions";
$menuName = " Search Prescription";

include "config/connection.php";

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
            <div class="row">


              <div class="col-lg-12">
                <!-- general form elements -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Search Prescription </h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form method="post">
                    <div class="card-body">

                      <div class="row">

                        <div class="col-lg-4">
                          <div class="form-group">
                            <label> Patient Name</label>
                            <input type="text" data-search_by="name" class="form-control" name="Patient_name" id="Patient_name" placeholder="Patient_name" onkeypress="search_prescription(this, event);" >
                          </div>
                        </div>

                        <div class="col-lg-4">
                          <div class="form-group">
                            <label>Contact</label>
                            <input data-search_by="contact" type="text" class="form-control" name="contact" id="contact" placeholder="Contact no" onkeypress="search_prescription(this, event);">
                          </div>
                        </div>


                        <div class="col-lg-4">
                          <div class="form-group">
                            <label>Address</label>
                            <input type="text" data-search_by="address" class="form-control" name="address" id="address" placeholder="address" onkeypress="search_prescription(this, event);">
                          </div>

                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>       
            </div>







            <div class="col-lg-12">

              <div class="card">
                <div class="card-header bg-primary">
                  <h3 class="card-title">Prescription</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="search_prescription_table" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S NO</th>
                        <th>Name</th>
                        <th>Visit Date</th>
                        <th>Age</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="search_prescription_table_tbody">

                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>

            </div>

          </div> <!-- /row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>



    <!-- /.content-wrapper -->
    <?php include 'config/footer.php' ?>
  </div>
  <!-- ./wrapper -->

  <?php  include 'config/site_js.php'; ?>

  <script>
    $(document).ready(function(){

      $("#search_prescription_link").addClass('active');
      $("#patients_menue").addClass('menu-open');
      $("#patients_menue_link").addClass('active');
      // $('#my_table').DataTable();



      
    });

    addDataTable("Search_prescription_table");


    function search_prescription(obj, e) {
      if(e.which == 13) {
        var value = $(obj).val();
        var serachBy = $(obj).data('search_by');

        if(value != '') {
          $.ajax({

            url: "ajax/get_data_for_search_prescription",
            type: "get",
            async: false,
            data: {
              value: value,
              search_by: serachBy,
            },
            success: function(response) {
              $("#search_prescription_table_tbody").html(response);

            }


          });
        } else {
          showMessage('error', 'Da sari zwi sha!');
        }

      }
    }
  </script>
</body>
</html>
