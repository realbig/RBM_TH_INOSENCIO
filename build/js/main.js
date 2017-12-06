/**
 Main functions file.

 @since 0.1.0
 @package Inosencio
 */
(function ($) {
    'use strict';

    // Foundation
    $(document).foundation();

    // Page loading overlay
    $('#site-content').append('<div id="page-load-overlay"><div class="loader fa fa-circle-o-notch fa-spin-fast" /></div>');

    setTimeout(function () {

        var $overlay = $('#page-load-overlay');

        if ($overlay.length) {
            $overlay.animate({
                opacity: 1
            }, 300);
        }
    }, 300);

    $(window).load(function () {
        $('#page-load-overlay').animate({
            opacity: 0
        }, {
            duration: 500,
            complete: function () {
                $(this).remove();
            }
        });
    });

})(jQuery);