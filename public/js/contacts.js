$(document).ready(function () {
    window.verifyRecaptchaCallback = function (response) {
        $('input[data-recaptcha]').val(response).trigger('change');
        $('.help-block.with-errors').css('display', 'none');
        //console.log ('Data Verify');
    }

    window.expiredRecaptchaCallback = function () {
        $('input[data-recaptcha]').val("").trigger('change');
        //console.log ('Data Expired');
    }

    $('#form_validation').on('submit', function (e) {
        e.preventDefault();
        if ($('input[data-recaptcha]').val() != '') {
            //console.log ('Можно слать');
            document.forms.form_validation.submit();
        } else {
            //console.log ('Нельзя слать');
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

