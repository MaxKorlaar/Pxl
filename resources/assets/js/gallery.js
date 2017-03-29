let Clipboard = require('Clipboard');
let cp        = new Clipboard('.clipboard');

$('.delete-button').on('click', function () {
    let icon;
    let that      = $(this);
    let imageUrl  = that.data('image-url');
    let container = that.parents('.image-card-container');
    let deleteUrl = that.data('delete-url');
    let csrfToken = window.csrf_token;
    if (that.data('confirm')) {
        that.removeClass('pulse').addClass('disabled').attr('disabled', true);
        clearTimeout(that.data('confirm-timeout'));

        $.ajax({
            url:      deleteUrl,
            type:     'POST',
            dataType: 'json',
            data:     {
                _token:  csrfToken,
                _method: 'DELETE'
            },
            success:  function (data) {
                console.info(data);
                if (data.success) {
                    container.fadeOut();
                    Materialize.toast(data.message, 5000);
                } else {
                    Materialize.toast(data.error, 5000);
                }
            },
            error:    function (data) {
                if (typeof data.responseJSON === 'undefined') {
                    Materialize.toast("An unknown error has occurred");
                } else {
                    Materialize.toast(data.error, 10000);
                }
            },
            complete: function (data) {
                that.removeClass('disabled').attr('disabled', false);
            }
        });
    } else {
        icon = that.find('.material-icons');
        icon.fadeOut(250, function () {
            let timeout;
            icon.text('help').fadeIn(250);
            that.data('confirm', true);
            that.addClass('pulse');
            timeout = setTimeout(function () {
                icon.fadeOut(250, function () {
                    icon.text('delete').fadeIn(250);
                    that.data('confirm', false);
                    that.removeClass('pulse');

                });
            }, 5000);
            that.data('confirm-timeout', timeout);
        });
    }
});