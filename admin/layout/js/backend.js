// In the case of input not empty => does not interfere label with a value of input
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
let inputpass = document.querySelector('.password')
function showPassword(){
    inputpass.type ='text'; 
}
function hidePassword(){
    inputpass.type ='password';
}


// Confirmation Message On Button
$('.confirm').click(function () {
    return confirm('Are You Sure?');
});


// Category View Option
$('.cat h3').click(function () {
    $(this).next('.full-view').fadeToggle(200);
});
$('.option span').click(function () {
    $(this).addClass('active').siblings('span').removeClass('active');
    if ($(this).data('view') === 'full') {
        $('.cat .full-view').fadeIn(200);
    } else {
        $('.cat .full-view').fadeOut(200);
    }
});


// Trigger selectboxit
$("select").selectBoxIt({
    autoWidth:false
});


// Dashbord 
$('.toggle-info').click(function(){
    $(this).toggleClass('selected').parent().next('.card-body').fadeToggle(100);
    if($(this).hasClass('selected')) {
        $(this).html('<i class="fa fa-minus"></i>')
    } else {
        $(this).html('<i class="fa fa-plus"></i>')
    }
});


// show delete button on childs cats
$('.child-link').hover(function(){
    $(this).find('.show-delete').fadeIn(400);
} , function(){
    $(this).find('.show-delete').fadeOut(400);
})


// custom the input field 
$(document).ready(function(){
	$("input[type='file']").wrap("<div class='custom-file'></div>");
	$(".custom-file").prepend("<div>Click for upload your Avatar</div>"); 
	$(".custom-file").append("<i class='fas fa-upload'></i>"); 
	$("input[type='file']").change (function(){
		$(this).prev("div").text($(this).val().substr(12));
	});
});
