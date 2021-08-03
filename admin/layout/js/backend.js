$(".custom-input input[type='text'] , .custom-input input[type='password'] ").on("focusout", function () {
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

// Convert Password Field To Text Field On Hover

// var passField = $('.password');
// $('.show-pass').hover(function () {
//     passField.attr('type', 'text');
// }, function () {
//     passField.attr('type', 'password');
// });

let inputpass = document.querySelector('.password')
function showPassword(){
    inputpass.type ='text'; 
}
function hidePassword(){
    inputpass.type ='password';
}
