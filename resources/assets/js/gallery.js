let Clipboard = require('Clipboard');

import MaterialDateTimePicker from "material-datetime-picker";
import moment from "moment";

$(document).ready(function () {

    let cp = new Clipboard('.clipboard');
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
    window.editingImage = {};
    const picker        = new MaterialDateTimePicker()
        .on('submit', (val) => {
            let moment    = picker.get();
            let timestamp = moment.unix();
            updateDeletionTimestamp(timestamp);
        });
    $('.auto-delete-button').on('click', function () {
        let that                                  = $(this);
        let container                             = that.parents('.image-card-container');
        let visibleTimestamp                      = container.find('.autodelete');
        let autoDeleteUrl                         = that.data('auto-delete-url');
        let currentTimestamp                      = that.data('timestamp');
        let csrfToken                             = window.csrf_token;
        window.gallery.autoDeleteUrl              = autoDeleteUrl;
        window.gallery.autoDeleteVisibleTimestamp = visibleTimestamp;
        picker.open();

        let neverButton = $(`<a class="c-btn c-btn--flat js-never">${window.gallery.never}</a>`);
        $('.modal-btns').prepend(neverButton);

        neverButton.on('click', function () {
            updateDeletionTimestamp(-1);
            picker.close();
        });

        if (currentTimestamp === null) {
            console.info('Current timestamp is null');
            picker.value = moment();
            picker.set(new Date());
        } else {
            picker.value = moment(currentTimestamp);
            picker.set(new Date(currentTimestamp * 1000));
        }

        return true;
    });
    function updateDeletionTimestamp(timestamp) {

        $.ajax({
            url:      window.gallery.autoDeleteUrl,
            type:     'POST',
            dataType: 'json',
            data:     {
                _token:                       window.csrf_token,
                _method:                      'PUT',
                scheduled_deletion_timestamp: timestamp
            },
            success:  function (data) {
                if (data.success) {
                    Materialize.toast(data.message, 5000);
                    window.gallery.autoDeleteVisibleTimestamp.text(data.readableTimestamp);
                } else {
                    Materialize.toast(data.error, 10000);
                }
            },
            error:    function (data) {
                if (typeof data.responseJSON === 'undefined') {
                    Materialize.toast("An unknown error has occurred");
                } else {
                    Materialize.toast(data.error, 10000);
                }
            }
        });
    }

});