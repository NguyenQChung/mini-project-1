
function updateFileName(input) {
    var fileName = input.files[0].name;
    var label = document.getElementById("avatar-label");
    label.innerText = fileName;
};
$(document).ready(function () {
    $('body').on('click', '.pagination a', function (e) {
        e.preventDefault();

        var url = $(this).attr('href');
        $.ajax({
            url: url,
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

    $(document).on('submit', '#editEmployeeModal form', function (e) {
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
                    // Nếu cập nhật thành công, tải lại dữ liệu người dùng
                    $.ajax({
                        url: baseUrl + 'quanly',
                        type: 'GET',
                        success: function (data) {
                            // Cập nhật nội dung của trang với dữ liệu mới
                            $('.content-wrapper').html($(data).find('.content-wrapper').html());
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
    $(document).on('submit', '#addEmployeeModal form', function (e) {
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
                    // Nếu cập nhật thành công, tải lại dữ liệu người dùng
                    $.ajax({
                        url: baseUrl + 'quanly',
                        type: 'GET',
                        success: function (data) {
                            // Cập nhật nội dung của trang với dữ liệu mới
                            $('.content-wrapper').html($(data).find('.content-wrapper').html());
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
    $(document).on('click', '.delete', function (e) {
        e.preventDefault();
        var id = $(this).closest('tr').find('td:eq(0)').text();

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
                    url: baseUrl + "deleteUser",
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
                                    url: baseUrl + 'quanly',
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
    $(document).on('click', '.edit', function (e) {
        e.preventDefault();
        var id = $(this).closest('tr').find('td:eq(0)').text();
        $.ajax({
            url: "getSingleUser/" + id,
            method: "GET",
            success: function (result) {
                console.log(JSON.parse(result));
                var res = (JSON.parse(result));
                $(".updateUsername").val(res.name);
                $(".updateEmail").val(res.email);
                $(".updateId").val(res.id);
                $(".updateAvatar").attr('src', baseUrl + "uploads/" + res.avatar);
                $(".updateRole").val(res.role);
            }
        })

    });
    $(document).on('click', '.reset', function (e) {
        e.preventDefault();
        var id = $(this).closest('tr').find('td:eq(0)').text();
        $.ajax({
            url: baseUrl + "resetPassword",
            method: "POST",
            data: { id: id },
            success: function (res) {
                if (res.includes("1")) {
                    Swal.fire({
                        title: "Đã Reset Password",
                        text: "Thành Công",
                        icon: "success"
                    }).then(() => {
                        $.ajax({
                            url: baseUrl + 'quanly',
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
    })
})
