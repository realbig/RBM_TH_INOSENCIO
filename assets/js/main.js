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
        }
    });

    $(function () {

        if ($().textillate) {
            $('.textillate').textillate({
                loop: true,
                minDisplayTime: 1000,
                in: {
                    effect: 'rotateIn',
                    delayScale: 0.75,
                    delay: 50
                },
                out: {
                    effect: 'rotateOut',
                    delayScale: 0.75,
                    delay: 50
                }
            });
        }
    });

})(jQuery);