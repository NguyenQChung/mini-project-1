<?php include (APPPATH . 'Views/inc/header.php'); ?>
<?php include (APPPATH . 'Views/inc/sidebar.php'); ?>
<script>
    var baseUrl = "<?php echo base_url(); ?>";
</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tickets</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Home">Home</a></li>
                        <li class="breadcrumb-item active">Tickets</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-body row">
                <div class="col-5 text-center d-flex align-items-center justify-content-center">
                    <div class="">
                        <h2>Admin<strong>LTE</strong></h2>
                        <p class="lead mb-5">123 Testing Ave, Testtown, 9876 NA<br>
                            Phone: +1 234 56789012
                        </p>
                    </div>
                </div>
                <div class="col-7">
                    <form action="<?= base_url('tickets') ?>" method="post" id="tickets">
                        <div class="form-group">
                            <label for="inputTitle">Title</label>
                            <input required type="text" id="inputTitle" name="inputTitle" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="inputMessage">Message</label>
                            <textarea required id="inputMessage" name="inputMessage" class="form-control"
                                rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputEmailManager">Email Manager</label>
                            <select class="form-control" id="inputEmailManager" name="inputEmailManager">
                                <option value="admin@gmail.com">Quản lý 1 </option>
                                <option value="admin1@gmail.com">Quản lý 2 </option>
                                <option value="admin2@gmail.com">Quản lý 3 </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Create Ticket">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include (APPPATH . 'Views/inc/footer.php'); ?>