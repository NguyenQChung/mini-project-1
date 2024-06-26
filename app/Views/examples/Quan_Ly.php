<?php include (APPPATH . 'Views/inc/header.php'); ?>
<?php include (APPPATH . 'Views/inc/sidebar.php'); ?>
<!-- Main content -->
<script>
    var baseUrl = "<?php echo base_url(); ?>";
</script>
<div class="content-wrapper">
    <section class="content">

        <?php
        if (session()->getFlashdata("success")) {

            ?>
            <div class="alert w-50 align-self-center alert-success alert-dismissible fade show" role="alert">
                <?php echo session()->getFlashdata("success"); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php }
        ;
        if (session()->getFlashdata("error")) { ?>
            <div class="alert w-50 align-self-center alert-success alert-dismissible fade show" role="alert">
                <?php echo session()->getFlashdata("error"); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Danh Sách Nhân Viên</h3>
                <div class="card-tools">
                    <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
                        <i class="fa fa-plus"></i>
                    </a>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>

                </div>
            </div>

            <div id="user_table">
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    ID
                                </th>
                                <th style="width: 20%">
                                    Họ và Tên
                                </th>
                                <th style="width: 30%">
                                    Email
                                </th>
                                <th>
                                    Ảnh đại diện
                                </th>
                                <th style="width: 8%" class="text-center">
                                    Chức vụ
                                </th>
                                <th style="width: 20%">
                                    <form id="searchForm" class="form-inline" method="GET">
                                        <div class="input-group input-group-sm">
                                            <input id="inputSearch" class="form-control form-control-navbar"
                                                type="search" placeholder="Nhập Họ và Tên" aria-label="Search" name="h">
                                            <div class="input-group-append">
                                                <button class="btn btn-navbar" type="submit">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= $user['id'] ?></td>
                                    <td><?= $user['name'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td style="max-width: 150px;">
                                        <?php if ($user['avatar'] == null) { ?>
                                            <img src="<?php echo base_url('uploads/default.jpg') ?>"
                                                class="rounded-circle img-fluid" style="max-width: 20%; height: auto;" />
                                        <?php } else { ?>
                                            <img src="<?php echo base_url('uploads/' . $user['avatar']) ?>"
                                                class="rounded-circle img-fluid" style="max-width: 20%; height: auto;" />
                                        <?php } ?>
                                    </td>
                                    <td><?= ($user['role'] === 'manager') ? 'Quản lý' : 'Nhân viên'; ?></td>
                                    <td class="project-actions text-right">
                                        <a href="#editEmployeeModal" class="btn btn-info btn-sm edit" data-toggle="modal">
                                            <i data-toggle="tooltip" class="fas fa-pencil-alt" title="Edit">
                                            </i>
                                            Sửa
                                        </a>
                                        <a class="btn btn-danger btn-sm delete" data-toggle="modal" href="#">
                                            <i class="fas fa-trash">
                                            </i>
                                            Xóa
                                        </a>
                                        <a class="btn btn-success btn-sm reset" data-toggle="modal" href="#">
                                            Reset
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <ul class="pagination">
                        <?= $pager->links('group1', 'bs_pagination'); ?>
                    </ul>
                </div>
            </div>

            <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- Form Add User -->
<div id="addEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url() . 'saveUser'; ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm Nhân Viên</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Họ và Tên</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="avatar" class="form-label">Ảnh đại diện:</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="avatar" id="avatar" class="custom-file-input"
                                    onchange="updateFileName(this)">
                                <label class="custom-file-label" for="avatar" id="avatar-label">Chọn tệp</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role">Chức Vụ:</label>
                        <select class="form-control" id="role" name="role">
                            <option value="employee">Nhân Viên</option>
                            <option value="manager">Quản Lý</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" name="submit" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-success" value="Add">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Form Edit User -->
<div id="editEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url() . "updateUser" ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Sửa Thông Tin Nhân Viên</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="updateId" class="updateId">
                    <div class="form-group">
                        <label>Họ và Tên</label>
                        <input type="text" class="form-control updateUsername" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control updateEmail" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="avatar" class="form-label">Ảnh đại diện:</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="avatar" id="avatar" class="custom-file-input"
                                    onchange="updateFileName(this)">
                                <label class="custom-file-label" for="avatar" id="avatar-label">Chọn tệp</label>
                            </div>
                        </div>

                        <img src="" alt="User Image" class="img-thumbnail updateAvatar" style="width: 200px;">
                    </div>
                    <div class="form-group">
                        <label for="role">Chức vụ :</label>
                        <select class="form-control updateRole" id="role" name="role">
                            <option value="employee">Nhân Viên</option>
                            <option value="manager">Quản Lý</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="button" name="submit" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-info" value="Save">
                </div>

            </form>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<?php include (APPPATH . 'Views/inc/footer.php'); ?>