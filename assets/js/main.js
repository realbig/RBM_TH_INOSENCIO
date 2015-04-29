/**
 Main functions file.

 @since 0.1.0
 @package Inosencio
 */
(function ($) {
    'use strict';

    // Foundation
    $(document).foundation({
        abide: {
            validate_on_blur: false,
            focus_on_invalid: false
        },
        topbar: {
            sticky_class: 'foundation-sticky'
        }
    });

    $(function () {

        // Textillate
        if ($().textillate) {
            $('.textillate').textillate({
                loop: true,
                minDisplayTime: 1000,
                in: {
                    effect: 'flipInX',
                    delayScale: 0.75,
                    delay: 100
                },
                out: {
                    effect: 'flipOutX',
                    delayScale: 0.75,
                    delay: 50
                }
            });
        }
    });

    // Page loading overlay
    $('#site-content').append('<div id="page-load-overlay"><div class="loader fa fa-circle-o-notch fa-spin-fast" /></div>');
    $('#page-load-overlay').css('top', $('#site-header').outerHeight() - $('.page-title').outerHeight());

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