(function($) {

    "use strict"; // Start of use strict


    $(document).ready(function() {
        $('#dataTable').DataTable();
    } );
  
    $('.form-color-picker li').click(function() {

        var element = $(this);
        $('.form-color-picker li').each(function() {
            $(this).removeClass('border');
        });

        if($('#userAvatar').val() == element.data('color')) {
            $('#userAvatar').val('');
        } else {
            element.addClass('border');
            $('#userAvatar').val(element.data('color'));
        }
    });

    $('#post-content').richText();

  })(jQuery); // End of use strict
  