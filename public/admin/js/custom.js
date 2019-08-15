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

    $(".submit-button").click(function() {
        var status = 'Attente';
        if($(this).val() == 'Valider') {
            var status = 'Validé';
        } else if($(this).val() == 'Refuser') {
            var status = 'Refusé';
        }
        $(this).parent().children("input[name='status']").val(status);
        $("#form-16").submit();
    });

  })(jQuery); // End of use strict
  