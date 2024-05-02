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
                <h3 class="card-title">List Employee</h3>
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
                                <th style="width: 2%">
                                    User_ID
                                </th>
                                <th style="width: 10%">
                                    Title
                                </th>
                                <th style="width: 10%">
                                    Email Manager
                                </th>
                                <th style="width: 30%">
                                    Message
                                </th>
                                <th style="width: 8%" class="text-center">
                                    Status
                                </th>
                                <th style="width: 20%">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tickets as $ticket): ?>
                                <tr>
                                    <td><?= $ticket['id'] ?></td>
                                    <td><?= $ticket['user_id'] ?></td>
                                    <td> <?= $ticket['title'] ?> </td>
                                    <td><?= $ticket['email_manager'] ?></td>
                                    <td><?= $ticket['body'] ?></td>
                                    <td><?= $ticket['status'] ?></td>
                                    <td class="project-actions text-right">
                                        <a href="#editTicket" class="btn btn-info btn-sm editTicket" data-toggle="modal">
                                            <i data-toggle="tooltip" class="fas fa-pencil-alt editTicket"
                                                title="EditTicket">
                                            </i>
                                            Edit
                                        </a>
                                        <a class="btn btn-danger btn-sm delete" data-toggle="modal" href="#">
                                            <i class="fas fa-trash">
                                            </i>
                                            Delete
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

<!-- Form Edit User -->
<div id="editTicket" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url() . "updateTicket" ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Employee</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="updateId" class="updateId">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control updateTitle" name="title" required>
                    </div>
                    <div class="form-group">
                        <label>Email Manager</label>
                        <input type="text" class="form-control updateEmailManager" name="email_manager" required>
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <input type="text" class="form-control updateMessage" name="body" required>
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