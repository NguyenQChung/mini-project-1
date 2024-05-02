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











})