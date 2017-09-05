/**
 Attorneys archive

 @since 0.1.0
 @package Inosencio
 */
(function ($) {
    'use strict';

    $(function () {

        var $attorney_select_items = $('.attorney-select').find('li'),
            $attorney_items = $('.attorneys').find('li');

        $attorney_items.filter(':not(:first-of-type)').hide();
        $attorney_select_items.first().addClass('active');

        $attorney_select_items.click(function () {

            $attorney_items.hide();
            $attorney_items.eq($(this).index()).show();

            $attorney_select_items.removeClass('active');
            $(this).addClass('active');
        });
    });

})(jQuery);