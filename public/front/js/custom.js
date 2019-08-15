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

    function selectColorPicker(color, firstLaunch) {

        if(color != '') {
            $('.form-color-picker li').each(function() {
                $(this).removeClass('border');
            });

            if($('#cAvatarColor').val() == color && firstLaunch == false) {
                $('#cAvatarColor').val('');
            } else {
                $('.form-color-picker li').each(function() {
                    if($(this).data('color') == color) {
                        $(this).addClass('border');
                    }
                });
                $('#cAvatarColor').val(color);
            }
        }

    }

    $('.form-color-picker li').click(function() {
        selectColorPicker($(this).data('color'), false);
    });

    selectColorPicker($('#cAvatarColor').val(), true);

    $('.comment-reply-link').click(function() {
        var commentId = $(this).data('comment-id');
        $('#comment-reply-form-' + commentId).toggle('fast');
    });

    $('#checkbox-privacy-consent').click(function() {

        var dateObj = new Date();
        var month = dateObj.getUTCMonth() + 1; //months from 1-12
        if(month < 10) {
            month = '0' + month;
        }
        var day = dateObj.getUTCDate();
        var year = dateObj.getUTCFullYear();
        
        newdate = year + "-" + month + "-" + day;

        if($("#privacy_consent_date").val() == '') {
            $("#privacy_consent_date").val(newdate);
        } else {
            $("#privacy_consent_date").val('');
        }

        });

})(jQuery);