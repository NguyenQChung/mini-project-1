
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
});
$(document).on('click', '.edit', function (e) {
    e.preventDefault();
    var id = $(this).closest('tr').find('td:eq(0)').text();
    console.log(id);
    $.ajax({
        url: "getSingleUser/" + id,
        method: "GET",
        success: function (result) {
            console.log(JSON.parse(result));
            var res = (JSON.parse(result));
            $(".updateUsername").val(res.name);
            $(".updateEmail").val(res.email);
            $(".updateId").val(res.id);
            $(".updateAvatar").attr('src', baseUrl + res.avatar);
            $(".updateRole").val(res.role);
        }
    })

});
