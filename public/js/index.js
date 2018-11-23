var i, tempArray, tempObj, tempDate;
//var moment = require('moment');

$(document).ready(function () {
    // календарь  min Date
    $('#dateFrom').datepicker({
        minDate: new Date(),
        dateFormat: 'dd.mm.yyyy',
        //autoClose: 'true',
        onSelect: function (fd, date, inst) {

            if (document.querySelector('#dateFrom').value != '') {
                $('#dateFrom').datepicker().data('datepicker').hide();
                //if (document.querySelector('#dateFrom').value > document.querySelector('#dateTill').value)  $('#dateTill').datepicker().data('datepicker').clear();
                //если последняя дата установленна раньше первой, удаляем ее
                tempArray = document.querySelector('#dateFrom').value.split('.');
                tempFrom = new Date(tempArray[2], tempArray[1] - 1, tempArray[0]);
                if (document.querySelector('#dateTill').value) {
                    tempObj = document.querySelector('#dateTill').value.split('.');
                    tempTill = new Date(tempObj[2], tempObj[1] - 1, tempObj[0]);
                    if (tempFrom - tempTill > 0) {
                        $('#dateTill').datepicker().data('datepicker').clear();
                    }
                }
                $('#dateTill').datepicker().data('datepicker').update('minDate', tempFrom);
                $('#dateTill').datepicker().data('datepicker').show();
                $('#dateFrom').trigger('change');
            }
        },
        onShow: function () {
            $('#dateTill').datepicker().data('datepicker').hide();
        },
        onHide: function (dp, animationCompleted) {
            if (document.querySelector('#dateFrom').value == '' && document.querySelectorAll('#dateFrom.auto-correct').length > 0) {
                $('#dateFrom').datepicker().data('datepicker').selectDate(new Date());

            }
        }
    });

    $('#dateTill').datepicker({
        minDate: new Date(),
        dateFormat: 'dd.mm.yyyy',
        //autoClose: true,
        onSelect: function (fd, date, inst) {
            if (document.querySelector('#dateTill').value != '') {
                $('#dateTill').datepicker().data('datepicker').hide();
            }
            $('#dateTill').trigger('change');
            //console.log ('Date from selected');
        },
        onHide: function (fd, date, inst) {
            //если пользователь не выбрал дату окончания, берется на месяц вперед
            if (document.querySelector('#dateTill').value == '' && document.querySelectorAll('#dateTill.auto-correct').length > 0) {
                if (document.querySelector('#dateFrom').value != '') {
                    tempDate = new Date(document.querySelector('#dateFrom').value);
                } else {
                    tempDate = new Date();
                    tempDate.setMonth(tempDate.getMonth() + 1);
                }

                $('#dateTill').datepicker().data('datepicker').selectDate(tempDate);
            }
        }
    });

    /*$(function () {
        $('#datePickerFrom').datetimepicker();
    });*/

    //console.log ('Now ' + moment().format('DD.MM.YYYY'));

    tempArray = [];

    $.getJSON('/js/json/country.json', function (data) {
        $.each(data, function(key, val) {
            tempArray.push({countryName: key,
                countryViewName: val
            });
        });

        var myMs = $('#mainCountries').magicSuggest({
            data: tempArray,
            placeholder: 'Страна поездки',
            valueField: 'countryName',
            displayField: 'countryViewName',
            maxSelection: 10,
            expandOnFocus: true,
            hideTrigger: true
        });
    });

    var html;
    for (i = 1; i <= 100; i++) {

        if (i == 30) {
            html += '<option value="' + i + '" selected>' + i + ' лет </option>';
        } else {
            html += '<option value="' + i + '">' + i + '</option>';
        }
    }
    $('.age-human').append(html);

    // выпадающий список путешественников
    $('.box-2').click(function () {
        $(this).next().toggle();
        $('.human-drop').mouseleave(function () {
            $(this).hide();
        });
    });

    //отзывы
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        navText: ["", ""],
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            400: {
                items: 1,
                nav: false
            },
            600: {
                items: 1,
                nav: false
            },
            1000: {
                items: 1,
                nav: true,
                loop: true
            }
        }
    });

});

// переключение количества путешественников
function conditions(boxId) {
    tempObj = $('#tr_check_' + boxId)[0];
    if (tempObj.checked) {
        $('#tr' + boxId).show();
        console.log ('Блок показан');
    } else {
        $('#tr' + boxId).hide();
        console.log ('Блок спрятан');
    }

}
