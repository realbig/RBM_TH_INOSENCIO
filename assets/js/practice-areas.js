/**
 Practice areas archive

 @since 0.1.0
 @package Inosencio
 */
(function ($) {
    'use strict';

    $(function () {

        if (!$('body').hasClass('post-type-archive-practice_area')) {
            return;
        }

        var $practice_areas = $('.practice-areas'),
            hash = window.location.hash;

        $practice_areas.find('.practice-area-content').hide();

        $practice_areas.find('.practice-area > a').click(function (e) {

            e.preventDefault();

            var $practice_area = $(this).closest('.practice-area');

            $practice_areas.find('.practice-area').removeClass('active');
            $practice_areas.find('.practice-area-content').hide();
            $practice_area.siblings('.practice-area-content').show();
            $practice_area.addClass('active');

            window.location.hash = '#' + $practice_area.attr('id');

            return false;
        });

        if (hash.length) {
            $(hash).find('> a').click();
        }
    });

})(jQuery);