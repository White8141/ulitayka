$(document).ready(function () {
    window.verifyRecaptchaCallback = function (response) {
        $('.help-block.with-errors').css('display', 'none');
        $('input[data-recaptcha]').val(response).trigger('change');
    }

    window.expiredRecaptchaCallback = function () {
        $('input[data-recaptcha]').val("").trigger('change');
    }

    $('#form_validation').on('submit', function (e) {
        e.preventDefault();
        if ($('input[data-recaptcha]').val() != '') {
            document.forms.form_validation.submit();
        } else {
            $('.help-block.with-errors').css('display', 'block');
        }
    })

});

// показать всплывающее сообщение, если есть
function printToolbar(message) {
    if (message != "") {
        document.querySelector('#toastMessage p').innerHTML = message;
        $('#toastMessage').show(500);
        setTimeout(function () {
            $('#toastMessage').slideUp(500);
        }, 2000);
    }
};

