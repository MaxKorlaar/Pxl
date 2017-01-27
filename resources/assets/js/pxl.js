$(document).ready(function() {
    $(".button-collapse").sideNav();
    $("a#logout_button").on('click', function(e) {
        e.preventDefault();
        $("#logout_form").submit();
    })
});