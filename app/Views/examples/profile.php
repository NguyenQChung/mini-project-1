<?php include (APPPATH . 'Views/inc/header.php'); ?>
<?php include (APPPATH . 'Views/inc/sidebar.php'); ?>


<!-- Main content -->
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center ">
        <div class="col-md-6 mt-5">
          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <?php if (isset($user) && isset($user['avatar'])): ?>
                  <img src="<?= base_url('uploads/' . $user['avatar']) ?>" class="profile-user-img img-fluid img-circle"
                    alt="User Image">
                <?php else: ?>
                  <img src="<?= base_url('dist/img/user2-160x160.jpg') ?>" class="profile-user-img img-fluid img-circle"
                    alt="User Image">
                <?php endif; ?>
              </div>

              <h3 class="profile-username text-center"><?= $user['name'] ?></h3>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Chức Vụ </b> <a class="float-right"><?= $user['role'] ?> </a>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <a class="float-right"><?= $user['email'] ?> </a>
                </li>
                <li class="list-group-item">
                  <b>Ngày Vào </b> <a class="float-right"><?= date('d-m-Y', strtotime($user['created_at'])) ?></a>
                </li>
              </ul>

              <a href="#changePass" class="btn btn-primary btn-block" data-toggle="modal"><b>Đổi Mật Khẩu</b></a>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
  </section>
</div>

<div id="changePass" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url() . 'changepassword'; ?>" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h4 class="modal-title">Đổi mật khẩu</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Mật khẩu cũ </label>
            <input type="password" class="form-control" name="password" required>
            <small id="oldPasswordError" class="text-danger" style="display: none;">Mật khẩu cũ không đúng.</small>
          </div>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Mật khẩu mới </label>
            <input type="password" class="form-control" name="matKhauMoi" required>
          </div>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nhập lại mật khẩu mới </label>
            <input type="password" class="form-control" name="nhapLai" required>
            <small id="rePasswordError" class="text-danger" style="display: none;">Nhập lại mật khẩu không khớp ! Vui
              lòng nhập lại . </small>
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
</div>




<?php include (APPPATH . 'Views/inc/footer.php'); ?>