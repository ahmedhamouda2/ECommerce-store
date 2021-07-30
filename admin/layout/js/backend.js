$(".custom-input input[type='text'] , .custom-input input[type='password'] ").on("focusout", function () {
    if ($(this).val() != "") {
        $(this).parent().addClass("has-data");
    } else {
        $(this).parent().removeClass("has-data");
    }
});