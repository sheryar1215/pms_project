<?php
include "config/connection.php"; 
$pageTitle = "Manage Reports";
$menuName = "Reports";

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'config/site_css.php'; ?>

  <style>
    a {
      text-decoration: none;
    }
  </style>
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
          
          

          <div class="container mt-3">
            <div class="row">




              <!-- <h5 class="mt-4 mb-2">Generate All Reports</h5> -->

              <div class="row">
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header">
                      <h3 style="font-weight: bold;" class="card-title">Generate All Reports</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->
                      <div id="accordion">
                        <div class="card card-primary">
                          <div class="card-header">
                            <h4 class="card-title w-100">
                              <a class="d-block w-100" data-toggle="collapse" href="#users_reports">
                               Users Report
                             </a>
                           </h4>
                         </div>
                         <div id="users_reports" class="collapse" data-parent="#accordion">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-lg-12 col-md-12"> 
                                <i class="far fa-user" ></i>
                                  All Users Report
                                 <button data-filter_id="users_report_filter" type="button" class="report_generate_button btn btn-primary float-right" >Generate</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card card-primary">
                        <div class="card-header">
                          <h4 class="card-title w-100">
                            <a class="d-block w-100" data-toggle="collapse" href="#patients_report">
                             Patients Repors
                           </a>
                         </h4>
                       </div>
                       <div id="patients_report" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                          <div class="row">
                              <div class="col-lg-12 col-md-12"> 
                                <i class="far fa-user" ></i>
                                  All Patients Report
                                 <button data-filter_id="patients_report_filter" type="button" class="report_generate_button btn btn-primary float-right" >Generate</button>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="card card-primary">
                      <div class="card-header">
                        <h4 class="card-title w-100">
                          <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                           Medicine Reports
                         </a>
                       </h4>
                     </div>
                     <div id="collapseThree" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                       <tr>
                        <td> <i class="fas fa-notes-medical"></i> Generate Menicines Report</td>
                        <td><button type="button" class="btn btn-primary ml-5" >Generate</button></td>
                      </tr>
                    </div>
                  </div>
                </div>


                <div class="card card-primary">
                  <div class="card-header">
                    <h4 class="card-title w-100">
                      <a class="d-block w-100" data-toggle="collapse" href="#collapseFour">
                        Generate Diseases Reports
                      </a>
                    </h4>
                  </div>
                  <div id="collapseFour" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                      <tr>
                        <td> <i class="fas fa-cogs"></i> Generate Menicines Report</td>
                        <td><button type="button" class="btn btn-primary ml-5" >Generate</button></td>
                      </tr>        
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>


        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 style="font-weight: bold;" class="card-title">Filter</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
              <div class="row" id="users_report_filter" style="display:none;"> 
                  <div class="col-lg-12"> 
                      <h6><strong>Users Report</strong> <span class="float-right">Fields with <i class="text-danger fa fa-star"></i> are mandatory</span></h6>
                  </div>

                  <div class="col-lg-12"> 
                      <button id="print_all_users_report" class="btn btn-success float-right" type="button">Generate</button>
                  </div>  
              </div>

              <div class="row" id="patients_report_filter" style="display:none;"> 
                  <div class="col-lg-12"> 
                      <h6><strong>Patients Report</strong> <span class="float-right">Fields with <i class="text-danger fa fa-star"></i> are mandatory</span></h6>
                  </div>

                  <div class="col-lg-12"> 
                      <button id="print_all_patients_report" class="btn btn-success float-right" type="button">Generate</button>
                  </div>  
              </div>
              
            </div>
          </div> 
        </div>
      </div>
    </div>
  </section>
</div>



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
    $("#reports_menue").addClass('menu-open');
    $("#reports_menue_link").addClass('active');
    $("#reports_link").addClass('active');

      $(".report_generate_button").click(function () {
          var dataFilterId = $(this).data('filter_id');
          $("#"+dataFilterId).show();
      });


      $("#print_all_users_report").click(function () {
          window.open("print_all_users", "_blank");
      });

      $("#print_all_patients_report").click(function () {
          window.open("print_all_patients", "_blank");
      });
  });
</script>
</body>
</html>
