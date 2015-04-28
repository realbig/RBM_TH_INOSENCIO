/**
 Search bar functionality.

 @since 0.1.0
 @package Inosencio
 */
(function ($) {
    'use strict';

    $(function () {

        var $top_bar = $('#site-header').find('.top-bar'),
            $search_container = $top_bar.find('.search'),
            $search_input = $search_container.find('input[type="search"]'),
            $search_button = $search_container.find('.search-button'),
            placeholder = $search_input.data('placeholder');

        $search_input
            .val(placeholder)
            .on('focus', function () {

                if ($(this).val() == placeholder) {
                    $(this).val('');
                }
        })
            .blur(function () {

                if (!$(this).val()) {
                    $(this).val(placeholder);
                }
        })
            .each(resizeInput);

        function resizeInput() {
            $(this).attr('size', $(this).val().length);
        }

        $search_button.click(function (e) {

            $search_input.focus();

            e.preventDefault();
            return false;
        });
    });

})(jQuery);