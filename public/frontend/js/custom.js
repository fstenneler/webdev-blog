/* ===================================================================
 * Wordsmith - Main JS
 *
 * ------------------------------------------------------------------- */

(function($) {

    $('.header__sign-in-trigger').click(function() {
        if($('#header__connection_modal').is(':visible')) {
            $('#header__connection_modal').fadeOut('1000');
        } else {
            $('#header__connection_modal').fadeIn('1000');
        }
    });

    $('.form-color-picker li').click(function() {

        var element = $(this);
        $('.form-color-picker li').each(function() {
            $(this).removeClass('border');
        });

        if($('#cAvatarColor').val() == element.data('color')) {
            $('#cAvatarColor').val('');
        } else {
            element.addClass('border');
            $('#cAvatarColor').val(element.data('color'));
        }
    });

    $('.comment-reply-link').click(function() {
        var commentId = $(this).data('commentId');
        $('#comment-reply-form-' + commentId).toggle('fast');
    });

})(jQuery);