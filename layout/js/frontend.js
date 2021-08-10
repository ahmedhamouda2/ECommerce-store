// switch between login and signup
$(".login-page h2 span").click(function(){
    $(this).addClass('selected').siblings().removeClass('selected');
    $('.login-page form').hide();
    $('.' + $(this).data('class')).fadeIn(200)
})


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
