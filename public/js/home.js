var i, tempObj, tempDate

$(document).ready(function () {
    console.log ('Home JS Start');

    // календарь  min Date
    $('#userBirthdate').datepicker({
        view: 'years',
        autoClose: 'true',
        dateFormat: 'dd.mm.yyyy',
        onSelect: function (fd, date, inst) {

            if (document.querySelector('#userBirthdate').value != '') {
                $('#userBirthdate').datepicker().data('datepicker').hide();
                $('#userBirthdate').trigger('change');
            }
        },

        onHide: function (dp, animationCompleted) {
            if (document.querySelector('#userBirthdate').value == '' && document.querySelectorAll('#userBirthdate.auto-correct').length > 0) {
                $('#userBirthdate').datepicker().data('datepicker').selectDate(new Date());

            }
        }
    });

});

function preparePage (isProfileFilled, birthdate) {
    //подготовим окно выбора даты рождения страхователя
    if (birthdate != null && birthdate != '' /*&& $('form').is('#userBirthdate')*/) {
        tempObj = birthdate.split('.');
        tempDate = new Date(tempObj[2], tempObj[1]-1, tempObj[0]);
        $('#userBirthdate').datepicker().data('datepicker').selectDate(tempDate);
    }

    if (isProfileFilled == "1") {
        $('.user-data-fill').css('display', 'block');
    } else {
        $('.user-data-empty').css('display', 'block');
    }

    console.log ('Подготовка страницы ');
}

// переключение количества путешественников
function printToolbar(message) {
    if (message != "") {
        //console.log ('Пришло сообщение ' + message);
        document.querySelector('#toastMessage p').innerHTML = message;
        $('#toastMessage').css('display', 'block');
        setTimeout(function () {
            $('#toastMessage').slideUp(500);
        }, 2000);
    } else {
        console.log ('Сообщений нет');

    }


}

function editProfile() {
    console.log ('Открыть редактирование файла');
    $('.user-data-fill').css('display', 'none');
    $('.user-data-empty').css('display', 'block');
}