      <!-- Sidebar -->
      <div class="sidebar" data-background-color="dark">
          <div class="sidebar-logo">
              <!-- Logo Header -->
              <div class="logo-header" data-background-color="dark">

                  <input type="hidden" id="USER_ID" value="<?= $_SESSION['USER_ID'] ?>">

                  <a href="index.php" class="logo d-flex justify-content-center" style="width: 80%;">
                      <img src="../../assets/img/logo/cs-logo.png" alt="navbar brand" class="navbar-brand" height="100%" />
                  </a>
                  <div class="nav-toggle">
                      <button class="btn btn-toggle toggle-sidebar">
                          <i class="gg-menu-right"></i>
                      </button>
                      <button class="btn btn-toggle sidenav-toggler">
                          <i class="gg-menu-left"></i>
                      </button>
                  </div>
                  <button class="topbar-toggler more">
                      <i class="gg-more-vertical-alt"></i>
                  </button>
              </div>
              <!-- End Logo Header -->
          </div>
          <div class="sidebar-wrapper scrollbar scrollbar-inner">
              <div class="sidebar-content">
                  <ul class="nav nav-secondary">
                      <li class="nav-item <?= $_SESSION['PAGE_NAME'] == 'SYSTEM_HOME' ? 'active' : '' ?>">
                          <a href="index.php">
                              <i class="fas fa-home"></i>
                              <p>หน้าหลัก</p>
                          </a>
                      </li>
                      <li class="nav-item <?= $_SESSION['PAGE_NAME'] == 'SYSTEM_STUDENT' ? 'active' : '' ?>">
                          <a href="student_table.php">
                              <i class="fas fa-user-graduate"></i>
                              <p>ข้อมูลนักศึกษา</p>
                          </a>
                      </li>
                      <li class="nav-item <?= $_SESSION['PAGE_NAME'] == 'SYSTEM_TEACHER' ? 'active' : '' ?>">
                          <a href="teacher_table.php">
                              <i class="fas fa-user-tie"></i>
                              <p>ข้อมูลอาจารย์</p>
                          </a>
                      </li>
                      <li class="nav-item <?= $_SESSION['PAGE_NAME'] == 'SYSTEM_THESIS' ? 'active' : '' ?>">
                          <a href="thesis_table.php">
                              <i class="fas fa-newspaper"></i>
                              <p>ข้อมูลโครงงาน/ปริญญานิพนธ์</p>
                          </a>
                      </li>
                      <li class="nav-item <?= $_SESSION['PAGE_NAME'] == 'SYSTEM_DATA_BASIC' ? 'active' : '' ?>">
                          <a href="data_basic.php">
                              <i class="fas fa-database"></i>
                              <p>ข้อมูลพื้นฐาน</p>
                          </a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
      <!-- End Sidebar -->