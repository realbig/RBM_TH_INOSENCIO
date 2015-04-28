/**
 Site header functionality.

 @since 0.1.0
 @package Inosencio
 */
(function ($) {
    'use strict';

    $(function () {
        $('#site-header').find('.site-nav').each(function () {

            $(this).css({
                top: ($(this).parent().height() / 2) - ($(this).height() / 2)
            });
        });
    });

})(jQuery);