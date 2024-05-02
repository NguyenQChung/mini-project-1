<?php include (APPPATH . 'Views/inc/header.php'); ?>
<?php include (APPPATH . 'Views/inc/sidebar.php'); ?>
<style>
    /* Điều chỉnh kiểu dáng cho chữ Welcome */
    .welcome-text {
        font-size: 3em;
        /* Kích thước chữ */
        font-weight: bold;
        /* Độ đậm */
        text-align: center;
        /* Căn giữa */
        margin-top: 50px;
        /* Khoảng cách từ trên xuống */
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Home</h1>
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

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Phần chứa chữ Welcome -->
                            <div class="welcome-text">Welcome</div>
                        </div>
                    </div>
                </div>



            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include (APPPATH . 'Views/inc/footer.php'); ?>