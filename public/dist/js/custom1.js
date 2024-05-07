$(document).ready(function () {


    $(document).on('click', '.editTicket', function (e) {
        e.preventDefault();
        var id = $(this).closest('tr').find('td:nth-child(2)').text().trim();
        $.ajax({
            url: "getSingleTicket/" + id,
            method: "GET",
            success: function (result) {
                console.log(JSON.parse(result));
                var res = (JSON.parse(result));
                $(".updateId").val(res.id);
                $(".updateTitle").val(res.title);
                $(".updateEmailManager").val(res.email_manager);
                $(".updateMessage").val(res.body);
                $(".updateStatus").val(res.status);
            }
        })
    });


    $(document).on('submit', '#editTicket form', function (e) {

        e.preventDefault();

        var formData = new FormData($(this)[0]);
        console.log(formData); // Lấy dữ liệu từ form
        var url = $(this).attr('action'); // Lấy URL từ action của form
        var modal = $(this).closest('.modal');
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response === '1') {
                    modal.modal('hide');
                    Swal.fire({
                        title: "Cập nhật thông tin phiếu thành công!",
                        text: "",
                        icon: "success"
                    }).then(() => {
                        // Nếu cập nhật thành công, tải lại dữ liệu người dùng
                        $.ajax({
                            url: baseUrl + 'ListTicket',
                            type: 'GET',
                            success: function (data) {
                                // Cập nhật nội dung của trang với dữ liệu mới
                                $('.content-wrapper').html($(data).find('.content-wrapper').html());
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                console.log(textStatus, errorThrown);
                            }
                        })
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });


    $(document).on('show.bs.modal', '#changePass', function (e) {
        // Ẩn thông báo lỗi khi modal được mở
        $('#oldPasswordError').hide();
        $('#rePasswordError').hide();
    });

    $(document).on('submit', '#changePass form', function (e) {
        e.preventDefault();

        var formData = new FormData($(this)[0]); // Lấy dữ liệu từ form
        var url = $(this).attr('action'); // Lấy URL từ action của form
        var modal = $(this).closest('.modal');
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response === '1') {
                    modal.modal('hide');
                    $('#changePass form')[0].reset();
                    // Nếu cập nhật thành công, tải lại dữ liệu người dùng
                    Swal.fire({
                        title: "Đổi Mật Khẩu Thành Công",
                        icon: "success"
                    }).then(() => {
                        $.ajax({
                            url: baseUrl + 'profile',
                            type: 'GET',
                            success: function (data) {
                                // Cập nhật nội dung của trang với dữ liệu mới
                                $('.content-wrapper').html($(data).find('.content-wrapper').html());
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                console.log(textStatus, errorThrown);
                            }
                        });
                    });
                } else if (response === '3') {
                    // Nếu có lỗi, hiển thị thông báo lỗi
                    $('#oldPasswordError').show(); // Hiển thị thông báo lỗi
                }
                else if (response === '2') {
                    $('#rePasswordError').show();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });

    $(document).on('click', '.deleteTicket', function (e) {
        e.preventDefault();
        var id = $(this).closest('tr').find('td:nth-child(2)').text().trim();

        Swal.fire({
            title: "Bạn có chắc muốn xóa không ?",
            text: "Sẽ không lấy lại được dữ liệu !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Xóa"
        }).then((result) => {
            if (result.isConfirmed) {
                // Nếu người dùng xác nhận xóa
                $.ajax({
                    url: baseUrl + "deleteTicket",
                    method: "POST",
                    data: { id: id },
                    success: function (res) {
                        if (res.includes("1")) {
                            // Hiển thị thông báo xóa thành công nếu cần
                            Swal.fire({
                                title: "Đã Xóa",
                                text: "Xóa Thành Công",
                                icon: "success"
                            }).then(() => {
                                // Sau khi xóa thành công, cập nhật lại dữ liệu người dùng
                                $.ajax({
                                    url: baseUrl + 'ListTicket',
                                    type: 'GET',
                                    success: function (data) {
                                        // Cập nhật nội dung của trang với dữ liệu mới
                                        $('.content-wrapper').html($(data).find('.content-wrapper').html());
                                    },
                                    error: function (jqXHR, textStatus, errorThrown) {
                                        console.log(textStatus, errorThrown);
                                    }
                                });
                            });
                        }
                    }
                });
            }
        });
    });








})