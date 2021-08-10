// placeholder go to top when focus
$(".custom-input input:not([type=submit]) ").on("focusout", function () {
    if ($(this).val() != "") {
        $(this).parent().addClass("has-data");
    } else {
        $(this).parent().removeClass("has-data");
    }
});


// Add Asterisk On Required Field
$('input').each(function () {
    if ($(this).attr('required') === 'required') {
        $(this).after('<span class="asterisk">*</span>');
    }
});

// Confirmation Message On Button
$('.confirm').click(function () {
    return confirm('Are You Sure?');
});
