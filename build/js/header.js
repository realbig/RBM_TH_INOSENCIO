/**
 Site header functionality.

 @since 0.1.0
 @package Inosencio
 */
(function ($) {
    'use strict';

    $(function () {

        nav_position();

        $('.toggle-nav').click(function () {
            $('#mobile-nav').toggleClass('active');
        });
    });

    $(window).resize(nav_position);

    function nav_position() {

        $('#site-header').find('.site-nav').each(function () {

            $(this).css({
                top: ($(this).parent().height() / 2) - ($(this).height() / 2)
            });
        });
    }

})(jQuery);