<?php if ($_SESSION['USER_ID']) { ?>
    <div class="main-header">
        <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
                <a href="../../index.html" class="logo">
                    <img src="../../assets/img/logo/cs-logo.png" alt="navbar brand" class="navbar-brand" height="20" />
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
        <!-- Navbar Header -->
        <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
            <div class="container-fluid">
                <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-grid w-100">
                    <h4 class="fw-bold">ระบบพัฒนาการจัดการสาขาวิทยาการคอมพิวเตอร์ มหาวิทยาลัยราชภัฎบุรีรัมย์</h4>
                    <h6 class="">Computer Science Management Development System Buriram Rajabhat University</h6>
                </nav>

                <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                    <li class="nav-item topbar-user dropdown hidden-caret">
                        <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                            <div class="avatar-sm">
                                <img src="../../assets/img/profile/profile.png" alt="..." class="avatar-img rounded-circle" />
                            </div>
                            <span class="profile-username">
                                <span class="op-7">
                                    <?php if ($_SESSION['login'] == "success") {
                                        echo "สวัสดี!";
                                        $_SESSION['login'] = "";
                                    }; ?>
                                </span>
                                <span class="fw-bold"><?= get_user($_SESSION['USER_ID'],"NAME"); ?></span>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-user animated fadeIn">
                            <div class="dropdown-user-scroll scrollbar-outer">
                                <li>
                                    <div class="user-box">
                                        <div class="avatar-lg">
                                            <img src="../../assets/img/profile/profile.png" alt="image profile" class="avatar-img rounded" />
                                        </div>
                                        <div class="u-text">
                                            <h4><?= get_user($_SESSION['USER_ID'],"NAME"); ?></h4>
                                            <p class="text-muted"><?= get_user($_SESSION['USER_ID'],"EMAIL"); ?></p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0);" onclick="signout_process()">ออกจากระบบ</a>
                                </li>
                            </div>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- End Navbar -->
    </div>
<?php } ?>