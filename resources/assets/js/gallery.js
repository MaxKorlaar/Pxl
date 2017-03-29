let Clipboard = require('Clipboard');
let cp        = new Clipboard('.clipboard');

$('.delete-button').on('click', function () {
    let icon;
    let that      = $(this);
    let imageUrl  = that.data('image-url');
    let container = that.parents('.image-card-container');

    if(that.data('confirm')) {
        console.info('Confirmed');
    } else {
        icon = that.find('.material-icons');
        that.addClass('pulse');
        icon.fadeOut(250, function () {
            icon.text('help').fadeIn(250);
            that.data('confirm', true);
        });
    }


    //container.fadeOut();
    console.log();
});