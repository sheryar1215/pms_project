<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-5 mb-4 d-flex">
        <div class="image">
          <img src="assets/images/user_images/<?php echo $_SESSION['profile_picture']; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> <?php echo $_SESSION['full_name']; ?></a>
        </div>
      </div>

      
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

               <li class="nav-item">
            <a href="dashboard" class="nav-link" id="dashboard_menu_link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item" id="medicines_menu">
            <a href="#" class="nav-link" id="medicine_menu_link">
              <i class="nav-icon fas fa-notes-medical"></i>
              <p>
                Medicines
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="medicines" class="nav-link" id="medicine_link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Medicines</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="medicines_details" class="nav-link" id="medicine_details_link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Medicine Details</p>
                </a>
              </li>
              </ul>

            </li>

            <li class="nav-item" id="patients_menue">
            <a href="#" class="nav-link" id="patients_menue_link">
              <i class="nav-icon fas fa fa-user"></i>
              <p>
                Patients
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="patients" class="nav-link" id="patients_manage_link" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Patients</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="prescription" class="nav-link" id="Prescriptions_link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Prescription</p>
                </a>
              </li>

              <li class="nav-item" >
                <a href="search_prescription" class="nav-link" id="search_prescription_link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Seach Prescription </p>
                </a>
              </li>
              </ul>
            </li>
        
            <li class="nav-item" id="Miscellaneous_menue">
            <a href="#" class="nav-link" id="Miscellaneous_menue_link">
              <i class="nav-icon fas fa fa-cogs"></i>
              <p>
                Miscellaneous
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="diseases" class="nav-link" id="Manage_Diseases_link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Diseases</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="manage_lab" class="nav-link" id="manage_lab_test">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Lab Tests</p>
                </a>
              </li>
              </ul>
            </li>

            
            <li class="nav-item" id="user_menue">
            <a href="users" class="nav-link" id="user_menue_link">
              <i class="nav-icon fas fa fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" >
              <li class="nav-item" >
                <a href="user_types" class="nav-link" id="user_types_link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage users Types</p>
                </a>
              </li>
              <li class="nav-item" >
                <a href="users" class="nav-link" id="user_link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage users</p>
                </a>
              </li>
              </ul>
            </li>

            
            <li class="nav-item" id="reports_menue">
            <a href="" class="nav-link" id="reports_menue_link">
              <i class="nav-icon fas fa fa-users"></i>
              <p>
                Reports
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" >
              <li class="nav-item">
                <a href="reports.php" class="nav-link" id="reports_link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Reports</p>
                </a>
              </li>
              </ul>
            </li>
  
            <li class="nav-item">
            <a href="logout" class="nav-link" id="">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Logout
              </p>
            </a>
          </li>


        </ul>

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>