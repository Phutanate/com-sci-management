      <!-- Sidebar -->
      <div class="sidebar" data-background-color="dark">
          <div class="sidebar-logo">
              <!-- Logo Header -->
              <div class="logo-header" data-background-color="dark">
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
                      <li class="nav-item <?= $_SESSION['PAGE_NAME'] == 'PUBLIC_HOME' ? 'active' : '' ?>">
                          <a href="index.php">
                              <i class="fas fa-home"></i>
                              <p>หน้าหลัก</p>
                          </a>
                      </li>
                      <li class="nav-item <?= $_SESSION['PAGE_NAME'] == 'PUBLIC_STUDENT' ? 'active' : '' ?>">
                          <a href="student_table.php">
                              <i class="fas fa-user-graduate"></i>
                              <p>ข้อมูลนักศึกษา</p>
                          </a>
                      </li>
                      <li class="nav-item <?= $_SESSION['PAGE_NAME'] == 'PUBLIC_TEACHER' ? 'active' : '' ?>">
                          <a href="teacher_table.php">
                              <i class="fas fa-user-tie"></i>
                              <p>ข้อมูลอาจารย์</p>
                          </a>
                      </li>
                      <li class="nav-item <?= $_SESSION['PAGE_NAME'] == 'PUBLIC_THESIS' ? 'active' : '' ?>">
                          <a href="thesis_table.php">
                              <i class="fas fa-newspaper"></i>
                              <p>โครงงาน/ปริญญานิพนธ์</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                              <i class="fas fa-door-open"></i>
                              <p>เข้าสู่ระบบ</p>
                              <span class="caret"></span>
                          </a>
                          <div class="collapse" id="dashboard">
                              <ul class="nav nav-collapse">
                                  <li>
                                      <div class="d-grid justify-content-center">
                                          <p class="" style="color: #b9babf !important;">สำหรับเจ้าหน้าที่เท่านั้น</p>
                                      </div>
                                      <div id="login_group">
                                          <form onsubmit="signin_process(event)">
                                              <div class="mx-5 my-3">
                                                  <input id="USER_USERNAME" class="form-control" type="text" name="USER_USERNAME" placeholder="ชื่อผู้ใช้">
                                              </div>
                                              <div class="mx-5 my-3 position-relative">
                                                  <input id="USER_PASSWORD" class="form-control" type="password" name="USER_PASSWORD" placeholder="รหัสผ่าน">
                                                  <span id="togglePassword" class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;" onclick="toggle_password()">
                                                      <i class="fas fa-eye-slash text-secondary op-4"></i>
                                                  </span>
                                              </div>

                                              <div class="d-grid justify-content-center">
                                                  <input type="submit" class="btn btn-primary" value="เข้าสู่ระบบ">
                                                  <a href="javascript:void(0);" onclick="reset_password_group_show()">ลืมรหัสผ่าน ?</a>
                                              </div>
                                          </form>
                                      </div>

                                      <div id="reset_password_group" style="display: none;">
                                          <form onsubmit="reset_password_process(event)">
                                              <div class="mx-5 my-3">
                                                  <input class="form-control" type="email" id="USER_EMAIL" name="USER_EMAIL" placeholder="อีเมลล์">
                                              </div>

                                              <div class="d-grid justify-content-center">
                                                  <input type="submit" class="btn btn-primary" value="รีเซ็ทรหัสผ่าน">
                                                  <a href="javascript:void(0);" onclick="login_group_show()">เข้าสู่ระบบ ?</a>
                                              </div>
                                          </form>
                                      </div>
                                  </li>
                              </ul>
                          </div>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
      <!-- End Sidebar -->