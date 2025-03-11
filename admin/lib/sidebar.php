
        <div class="navbar-custom">
            <div class="topbar container-fluid">
                <div class="d-flex align-items-center gap-1">

                    <!-- Topbar Brand Logo -->
                    <div class="logo-topbar">
                        <!-- Logo light -->
                        <a href="" class="logo-light">
                            <span class="logo-lg">
                                <img class="img-fluid" width="190" height="50" src="<?= $aang_url . $data_web['navicon'] ?>" alt="logo">
                            </span>
                            <span class="logo-sm">
                                <img src="<?= $aang_url . $data_web['favicon'] ?>" alt="small logo">
                            </span>
                        </a>
                        <!-- Logo Dark -->
                        <a href="" class="logo-dark">
                            <span class="logo-lg">
                                <img class="img-fluid" width="190" height="50" src="<?= $aang_url . $data_web['navicon'] ?>" alt="dark logo">
                            </span>
                            <span class="logo-sm">
                                <img src="<?= $aang_url . $data_web['favicon'] ?>" alt="small logo">
                            </span>
                        </a>
                    </div>
                    
                    <button class="button-toggle-menu">
                        <i class="mdi mdi-menu"></i>
                    </button>
                </div>

                <ul class="topbar-menu d-flex align-items-center gap-3">
                    <li class="dropdown d-lg-none"></li>
                    <li class="notification-list"></li>
                    <li class="notification-list"></li>

                    <li class="d-none d-sm-inline-block">
                        <div class="nav-link" id="light-dark-mode">
                            <i class="ri-moon-line fs-22"></i>
                        </div>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle arrow-none nav-user" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="account-user-avatar me-2">
                                <img src="<?= $aang_url ?>admin/assets/images/pp_default.jpg" alt="Administrator" width="32" class="rounded-circle">
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                            <a class="dropdown-item fw-bold border-bottom mb-1">
                                <?= $sess_nama2 ?>
                            </a>
                            <a href="<?= $aang_url ?>auth/logout" class="dropdown-item text-danger">
                                <i class="ri-logout-circle-r-line align-middle me-1"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="leftside-menu">
            <!-- Logo Light -->
            <a href="" class="logo logo-light">
                <span class="logo-lg">
                    <img class="img-fluid" width="190" height="50" src="<?= $aang_url . $data_web['navicon'] ?>" alt="logo">
                </span>
                <span class="logo-sm">
                    <img src="<?= $aang_url . $data_web['favicon'] ?>" alt="small logo">
                </span>
            </a>
            <!-- Logo Dark -->
            <a href="" class="logo logo-dark">
                <span class="logo-lg">
                    <img class="img-fluid" width="190" height="50" src="<?= $aang_url . $data_web['navicon'] ?>" alt="dark logo">
                </span>
                <span class="logo-sm">
                    <img src="<?= $aang_url . $data_web['favicon'] ?>" alt="small logo">
                </span>
            </a>

            <!-- Sidebar -->
            <div data-simplebar>
                <hr class="mt-0">
                <ul class="side-nav">
                    <li class="side-nav-item">
                        <a href="<?= $aang_url ?>admin/" class="side-nav-link">
                            <i class="mdi mdi-home-outline"></i>
                            <span> Dashboard </span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="<?= $aang_url ?>admin/postingan/" class="side-nav-link">
                            <i class="mdi mdi-post-outline"></i>
                            <span> Postingan </span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="<?= $aang_url ?>admin/partner/" class="side-nav-link">
                            <i class="mdi mdi-handshake-outline"></i>
                            <span> Partner </span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="<?= $aang_url ?>admin/pengaturan/lp" class="side-nav-link">
                            <i class="mdi mdi-card-account-details-outline"></i>
                            <span> About </span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="<?= $aang_url ?>admin/pengaturan/exp_edu" class="side-nav-link">
                            <i class="mdi mdi-badge-account-outline"></i>
                            <span> Exp & Edu </span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#Settings" aria-expanded="false" aria-controls="Settings" class="side-nav-link">
                            <i class="mdi mdi-cog-outline"></i>
                            <span>Pengaturan</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="Settings">
                            <ul class="side-nav-second-level">
                                <li class="side-nav-item">
                                    <a href="<?= $aang_url ?>admin/akun/" class="side-nav-link">
                                        <span> Akun </span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="<?= $aang_url ?>admin/pengaturan/kontak" class="side-nav-link">
                                        <span> Kontak </span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="<?= $aang_url ?>admin/pengaturan/website" class="side-nav-link">
                                        <span> Website </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid">

                <?php if (isset($_SESSION['response'])) { ?>
                    <div class="toast-container position-fixed top-0 end-0 p-3" data-original-class="toast-container position-absolute p-3">
                        <div class="toast fade show bg-<?= $_SESSION['response']['color'] ?> text-white align-items-center mb-3" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-body">
                                <strong class="d-flex mb-1">
                                    <i class="mdi mdi-<?= $_SESSION['response']['icon'] ?> align-middle me-1"></i>
                                    <?= $_SESSION['response']['title'] ?> 
                                    <a type="button" class="btn-close me-1 m-auto" data-bs-dismiss="toast" aria-label="Close"></a>
                                </strong>
                                <?= $_SESSION['response']['msg'] ?>
                            </div>
                        </div>
                    </div>
                <?php unset($_SESSION['response']); } ?>
