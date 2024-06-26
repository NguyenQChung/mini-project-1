<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('Home') ?>" class="brand-link">
        <img src="<?= base_url('dist/img/AdminLTELogo.png') ?>" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Quản Lý Nhân Sự
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php if (isset($user) && isset($user['avatar'])): ?>
                    <img src="<?= base_url('uploads/' . $user['avatar']) ?>" class="img-circle elevation-2"
                        alt="User Image">
                <?php else: ?>
                    <img src="<?= base_url('dist/img/user2-160x160.jpg') ?>" class="img-circle elevation-2"
                        alt="User Image">
                <?php endif; ?>
            </div>
            <div class="info">
                <?php if (isset($user) && isset($user['name'])): ?>
                    <div class="info"><a href="profile" class="d-block"><?= $user['name'] ?></a></div>
                    <div class="role" style=" color: #c2c7d0;">Chức vụ : <?= $user['role'] ?></div>
                <?php else: ?>
                    <div class="info"><a href="#" class="d-block">Unknown User</a></div>
                <?php endif; ?>
            </div>
        </div>


        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="Home" class="nav-link active">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <p>
                            TRANG CHỦ
                        </p>
                    </a>
                <li class="nav-item">
                    <a href="tickets" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tạo phiếu yêu cầu </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="ListTicket" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Danh sách phiếu yêu cầu </p>
                    </a>
                </li>
                <?php if (isset($user['role']) && $user['role'] === 'manager') { ?>
                    <li class="nav-item">
                        <a href="quanly" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Quản Lý</p>
                        </a>
                    </li>
                <?php } ?>

                <?php if (!session()->get('logged_in')): ?>
                    <li class="">
                        <a href="<?= base_url('login') ?>" class="nav-link ">
                            <button class="btn btn-primary btn-block">
                                Đăng Nhập
                            </button>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item menu-open">
                        <a href="<?= base_url('logout') ?>" class="nav-link active ">
                            <i class="fas fa-sign-out-alt" aria-hidden=" true"></i>
                            <p>Đăng Xuất</p>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>