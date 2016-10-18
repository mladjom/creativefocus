(function ($) {
    /**
     * Handles toggling the navigation menu for small screens.
     */
    $('.menu-toggle').click(function () {
        if ($(this).parent().hasClass('toggled')) {
            $('.toggled').removeClass('toggled');
        } else {
            $('.toggled').removeClass('toggled');
            $(this).parent().addClass('toggled');
        }
    });
    $('nav ul li ul').each(function () {
        $(this).before('<span class=\"arrow\"></span>');
    });

    $('nav ul li').click(function () {
        $(this).children('ul').toggleClass('active');
        $(this).children('.arrow').toggleClass('rotate');
    });
    // Search toggle.
    $('.search-toggle').on('click', function (event) {
        var that = $(this),
            wrapper = $('.search-box-wrapper');

        that.toggleClass('active');
        wrapper.toggleClass('hide');

        if (that.is('.active') || $('.search-toggle .screen-reader-text')[0] === event.target) {
            wrapper.find('.search-field').focus();
        }
    });
})(jQuery);
