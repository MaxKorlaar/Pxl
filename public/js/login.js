$('form').on('submit', function (e) {
    let formHeight = 0, formWidth = 0;
    e.preventDefault();
    formHeight = $('.login-form').height();
    formWidth  = $('.login-form').width();
    $('.login-form').addClass('hide');
    $('.loader-wrapper').css({height: formHeight + 'px', width: formWidth + 'px'}).removeClass('hide');
    $('.card-action .btn').addClass('disabled');

    $.ajax({
        url:      window.auth.doLoginUrl,
        type:     'POST',
        dataType: 'json',
        data:     $('form').serialize(),
        success:  function (data) {
            if (data.success) {
                $('.login-card').addClass('green');
                window.location.href = data.redirect;
            } else {
                if (typeof data.twoFactor !== 'undefined') {
                    $('.card-action .btn').removeClass('disabled');
                    $('.login-form').removeClass('hide');
                    $('.loader-wrapper').addClass('hide');
                    if (data.twoFactor === 'required') {
                        if (!$('.login-credentials').hasClass('hide')) {
                            $('.login-credentials').addClass('hide');
                            $('.twoFactor-wrapper').removeClass('hide');
                        }
                    } else if (data.twoFactor === 'invalid') {
                        Materialize.toast(data.error, 10000);
                        $('#2fa_key').addClass('invalid');
                    }
                }
            }
        },
        error:    function (data) {
            if (typeof data.responseJSON === 'undefined') {
                if (data.status === 200) {
                    $('.login-card').addClass('green');
                    window.location.href = window.auth.homeUrl;
                } else {
                    Materialize.toast("Unknown response: " + data.status, 10000);
                }
            } else {
                if (typeof data.responseJSON.success !== 'undefined') {
                    Materialize.toast(data.responseJSON.error, 10000);
                }
                if (data.status === 403) {
                    $('#password').addClass('invalid');
                    $('#username').addClass('invalid');
                }
                if (typeof data.responseJSON.password !== 'undefined') {
                    Materialize.toast(data.responseJSON.password[0], 10000);
                    $('#password').addClass('invalid');
                }
                if (typeof data.responseJSON.username !== 'undefined') {
                    Materialize.toast(data.responseJSON.username[0], 10000);
                    $('#username').addClass('invalid');
                }
            }
            $('.card-action .btn').removeClass('disabled');
            $('.login-form').removeClass('hide');
            $('.loader-wrapper').addClass('hide');
        }
    });
    return false;
});
$(document).ready(function () {
    Materialize.updateTextFields();
});