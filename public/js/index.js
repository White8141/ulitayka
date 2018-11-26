var i, tempArray, tempObj, tempDate, tempFrom, tempTill, currDate;
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

    $('#form-1').keydown(function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            tempVar = event.target.value;
            tempArray = [];
            for (i = 0; i < tempVar.length; i ++) {
                console.log ();
                if (!isNaN(tempVar.charAt(i)) && i < tempVar.length - 1) {
                    if (!isNaN(tempVar.charAt(i+1))) {
                        if (tempArray.length == 2 && !isNaN(tempVar.charAt(i+2)) && !isNaN(tempVar.charAt(i+3))) {
                            tempArray.push(tempVar.substr(i, 4));
                        } else {
                            tempArray.push(tempVar.substr(i, 2));
                        }
                        i ++;
                    } else {
                        tempArray.push(tempVar.substr(i, 1));
                    }
                } else {
                    if (!isNaN(tempVar.charAt(i))) {
                        tempArray.push(tempVar.substr(i, 1));
                    }
                }
            }

            currDate = new Date();

            if (tempArray.length == 0) {
                tempArray[0] = String(currDate.getDay());
                tempArray[1] = String(currDate.getMonth() + 1);
                tempArray[2] = String(currDate.getFullYear());
            }

            if (tempArray.length == 1) {
                tempArray[1] = String(currDate.getMonth() + 1);
                tempArray[2] = String(currDate.getFullYear());
            }

            if (tempArray.length == 2) {
                tempArray[2] = String(currDate.getFullYear());
            }

            if (tempArray[2].length < 4) {
                tempArray[2] = '20' + tempArray[2].slice(-2);
            } else {
                tempArray[2] = tempArray[2].substr(0, 4);
            }

            tempDate = new Date (tempArray[2], tempArray[1]- 1, tempArray[0]);

            if (tempDate != 'Invalid Date') {
                console.log ('Дата создана');
                if (event.target.id == 'dateFrom') {
                    if ((currDate - tempDate) > 0 ) {
                        console.log ('Нужно менять на текущую');
                        tempDate.setDate(currDate.getDate() + 1);
                    } else {
                        console.log ('Нормальная дата');
                    }
                    myDatepicker = $('#dateFrom').datepicker().data('datepicker');
                    myDatepicker.selectDate(tempDate);
                }
                if (event.target.id == 'dateTill') {
                    if (document.querySelector('#dateFrom').value && document.querySelector('#dateFrom').value != '') {
                        tempObj = document.querySelector('#dateFrom').value.split('.');
                        tempFrom = new Date(tempObj[2], tempObj[1] - 1, tempObj[0]);
                        if (tempFrom - tempDate > 0) {
                            console.log ('Нужно менять на день вперед от начальной');
                            tempDate.setDate(tempFrom.getDate() + 1);
                        } else {
                            console.log ('Нормальная дата');
                        }
                    } else {
                        if ((currDate - tempDate) > 0 ) {
                            console.log ('Нужно менять на день вперед от сегодня');
                            tempDate.setDate(currDate.getDate() + 1);
                        } else {
                            console.log ('Нормальная дата');
                        }
                    }
                    myDatepicker = $('#dateTill').datepicker().data('datepicker');
                    myDatepicker.selectDate(tempDate);
                }
            } else {
                console.log ('Дата неправильная');
                tempDate = new Date();
                if (event.target.id == 'dateFrom') {
                    tempDate.setDate(currDate.getDate() + 1);
                    myDatepicker = $('#dateFrom').datepicker().data('datepicker');
                    myDatepicker.selectDate(tempDate);
                }
                if (event.target.id == 'dateTill') {
                    if (document.querySelector('#dateFrom').value && document.querySelector('#dateFrom').value != '') {
                        tempObj = document.querySelector('#dateFrom').value.split('.');
                        tempFrom = new Date(tempObj[2], tempObj[1] - 1, tempObj[0]);
                        if (tempFrom - tempDate > 0) {
                            console.log ('Нужно менять на неделю вперед от начальной');
                            tempDate.setDate(tempFrom.getDate() + 1);
                        } else {
                            console.log ('Нормальная дата');
                        }
                    } else {
                        if ((currDate - tempDate) > 0 ) {
                            console.log ('Нужно менять на неделю вперед от текущей');
                            tempDate.setDate(currDate.getDate() + 1);
                        } else {
                            console.log ('Нормальная дата');
                        }
                    }
                    myDatepicker = $('#dateTill').datepicker().data('datepicker');
                    myDatepicker.selectDate(new Date());
                }
            }

            return false;
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
