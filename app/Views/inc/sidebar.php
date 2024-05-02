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
                <img src="<?= base_url('dist/img/user2-160x160.jpg') ?>" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <?php if (isset($user) && isset($user['name'])): ?>
                    <div class="info"><a href="#" class="d-block"><?= $user['name'] ?></a></div>
                    <div class="role" style=" color: #c2c7d0;">Role : <?= $user['role'] ?></div>
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
                            HOME
                        </p>
                    </a>
                <li class="nav-item">
                    <a href="tickets" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tickets</p>
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
                <li class="">
                    <a href="<?= base_url('login') ?>" class="nav-link d-flex justify-content-center">
                        <button class="btn btn-primary btn-block">
                            Login
                        </button>
                    </a>
                </li>
                <li class="">
                    <a href="<?= base_url('logout') ?>" class="nav-link d-flex justify-content-center">
                        <button class="btn btn-primary btn-block">
                            Logout
                        </button>
                    </a>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>