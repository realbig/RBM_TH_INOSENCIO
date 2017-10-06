/**
 Practice areas archive

 @since 0.1.0
 @package Inosencio
 */
(function ($) {
    'use strict';


    $(function () {

        // Prevent page jump
        prevent_jump();

        if (!$('body').hasClass('page-template-practice-areas')) {
            return;
        }

        var $practice_areas = $('.practice-areas'),
            hash = window.location.hash;

        $practice_areas.find('.practice-area-content').hide();

        $practice_areas.find('.practice-area > a').click(function (e) {

            console.log('click');

            var $practice_area = $(this).closest('.practice-area');

            $practice_areas.find('.practice-area').removeClass('active');
            $practice_areas.find('.practice-area-content').hide();
            $practice_area.siblings('.practice-area-content').show();
            $practice_area.addClass('active');

            // Scroll
            var href = $(this).attr('href'),
                hash = href.substring(href.indexOf("#") + 1),
                target = $('#' + hash);

            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top - $('.top-bar').height() - 10
                }, 500);
            }

            e.preventDefault();
            return false;
        });

        // Scroll to practice area if hash is in page load
        if (hash.length) {
            setTimeout(function () {
                $(hash).find('> a').click();
            }, 100);
        }
    });

    function prevent_jump() {

        if (window.location.hash) {
            setTimeout(function() {
                window.scrollTo(0, 0);
            }, 1);
        }
    }

})(jQuery);