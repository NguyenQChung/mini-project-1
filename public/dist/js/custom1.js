$(document).ready(function () {
    $(document).on('click', '.editTicket', function (e) {
        e.preventDefault();
        var id = $(this).closest('tr').find('td:eq(0)').text();
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
            }
        })
    });


    $(document).on('submit', '#editTicket form', function (e) {
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
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });


    $(document).on('click', '.deleteTicket', function (e) {
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