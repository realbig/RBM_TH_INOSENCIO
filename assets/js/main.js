/**
 Main functions file.

 @since 0.1.0
 @package Inosencio
 */
(function ($) {
    'use strict';

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

})(jQuery);