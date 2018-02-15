
$(document).ready(function () {

    // календарь  min Date
    $('#dateFrom').datepicker({
        minDate: new Date(),
        //autoClose: 'true',
        onSelect: function (fd, date, inst) {

            if (document.querySelector('#dateFrom').value != '') {
                $('#dateFrom').datepicker().data('datepicker').hide();
                if (document.querySelector('#dateFrom').value > document.querySelector('#dateTill').value)  $('#dateTill').datepicker().data('datepicker').clear();
                $('#dateTill').datepicker().data('datepicker').update('minDate', new Date(document.querySelector('#dateFrom').value));
                $('#dateTill').datepicker().data('datepicker').show();
            }
        },
        onHide: function (dp, animationCompleted) {
            if (document.querySelector('#dateFrom').value == '' && document.querySelectorAll('#dateFrom.auto-correct').length > 0) {
                $('#dateFrom').datepicker().data('datepicker').selectDate(new Date());

            }
        }
    });

    $('#dateTill').datepicker({
        minDate: new Date(),
        //autoClose: true,
        onSelect: function (fd, date, inst) {
            if (document.querySelector('#dateTill').value != '') {
                $('#dateTill').datepicker().data('datepicker').hide();
            }
            //console.log ('Date from selected');
        },
        onHide: function (fd, date, inst) {
            //если пользователь не выбрал дату окончания, берется на месяц вперед
            if (document.querySelector('#dateTill').value == '' && document.querySelectorAll('#dateTill.auto-correct').length > 0) {
                var tempDate;
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

    //Появляющиеся блоки (входит в страховку, дополнительно, дополнительные опции)
    $('#toggle_insurance').click(function () {
        $(this).next().toggle('slow');
        return false;
    });

    $('#toggle_additional').click(function () {
        $(this).next().toggle('slow');
        return false;
    });

    $('#toggle_options').click(function () {
        $(this).next().toggle('slow');
        return false;
    });

    /* Евро и доллар (Медицинское страхование) */

    function make_dollar() {
        if ($("#radio_dollar").is(":checked")) {
            $(".currency_symbol").html("$");
        } else {
            console.log("ne rabotaet");
        }
    }

    function make_euro() {
        if ($("#radio_euro").is(":checked")) {
            $(".currency_symbol").html("&#8364;");
        } else {
            console.log("ne rabotaet");
        }
    }

    var radiobuttonDollar = document.getElementById("radio_dollar");
    if(radiobuttonDollar){
        radiobuttonDollar.addEventListener("click", make_dollar, false);
    }

    var radiobuttonEuro = document.getElementById("radio_euro");
    if(radiobuttonEuro){
        radiobuttonEuro.addEventListener("click", make_euro, false);
    }

    /* Модалка */
    /*var modal = document.getElementById('myModal');

    var lnk = document.getElementById("myLnk");

    var span = document.getElementsByClassName("close")[0];

    lnk.onclick = function () {
        modal.style.display = "block";
    };

    span.onclick = function () {
        modal.style.display = "none";
    };

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };*/
    /* Конец - Модалка */

});

$(document).ready(function () {

    //плагин слайдер
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


    // выпадающий список
    $('.box-2').click(function () {
        $(this).next().toggle();
        $('.human-drop').mouseleave(function () {
            //$(this).hide();
        });
    });

});

//обработка массива country.json и внесение результатов в выпадающий список в упрощенной форме для страховки
function welcomeCountryParse() {

    $.getJSON('/js/country.json', function (data) {
        $.each(data, function (key, val) {
            if (key.charAt(0) == '+') key = key.substring(1);
            $('#page-country').append('<option value="' + key + '">' + val + '</option>');
        })
    });

    var html, i, tempObj;
    for (i = 1; i <= 100; i++) {

        if (i == 30) {
            html += '<option value="' + i + '" selected>' + i + ' лет </option>';
        } else {
            html += '<option value="' + i + '">' + i + '</option>';
        }
    }
    $('.age-human').append(html);

    console.log('Country parse');
}

//обработка массива country.json и выбор заданных стран
function countryParseWithSelect(view, country, csrfToken) {

    $.getJSON('/js/country.json', function (data) {
        var tempArr = [];
        $.each(data, function(key, val) {
            tempArr.push({countryName: key,
                    countryViewName: val
            });
        });

        var myMs = $('#ms').magicSuggest({
            data: tempArr,
            placeholder: 'Выберите страну',
            valueField: 'countryName',
            displayField: 'countryViewName',
            maxSelection: 10,
            expandOnFocus: true,
            hideTrigger: true
        });

        tempArr = [];
        for (var i = 0; i < country.length; i++) {
            tempArr.push(country[i]);
        }
        myMs.setValue(tempArr);

        switch (view) {
            case 'calc':
                $(myMs).on('selectionchange', function(e,m){
                    chRequest('/calcajax', csrfToken);
                });
                break;
            case 'details':
                $(myMs).on('selectionchange', function(e,m){
                    chDetails('/calcajax', csrfToken);
                });
                break;

        }
    });

    //console.log('Country with value parse');
}

// Вносим в страховку данные, введенные в форму на главной странице
const setCalcDefaultData = (defaultData, csrf) => {

    defaultData = JSON.parse(defaultData);

    //зафиксируем окно с карочками, что бы не уезжало вверх при прокрутке
    /**$('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
        }
    })*/
    
    //сначала выделим страну, выбранную в начальной форме
    countryParseWithSelect('calc', defaultData['countries'], csrf);

    //потом даты поездки
    var myDatepicker = $('#dateFrom').datepicker().data('datepicker');
    if (defaultData['dateFrom'] == null || defaultData['dateFrom'] == '') document.querySelector('#dateFrom').setAttribute('placeholder', 'Туда')
    else myDatepicker.selectDate(new Date(defaultData['dateFrom']));
    myDatepicker = $('#dateTill').datepicker().data('datepicker');
    if (defaultData['dateTill'] == null || defaultData['dateTill'] == '') document.querySelector('#dateTill').setAttribute('placeholder', 'Обратно')
    else myDatepicker.selectDate(new Date(defaultData['dateTill']));

    //потом количество путешественников (и возраст)
    var html, i, tempObj;
    for (i = 1; i <= 100; i++) {

        if (i == 30) {
            html += '<option value="' + i + '" selected>' + i + ' лет </option>';
        } else {
            html += '<option value="' + i + '">' + i + '</option>';
        }
    }
    $('.age-human').append(html);

    for (i = 0; i < 5; i++) {
        tempObj = $('#tr' + i);
        if (defaultData['travelers'][i].hasOwnProperty('accept') && defaultData['travelers'][i]['accept']) {
            document.querySelector('#tr_check_' + i).checked = true;
            tempObj.show();
            tempObj[0].value = defaultData['travelers'][i]['age'];
        } else {
            document.querySelector('#tr_check_' + i).checked = false;
            tempObj.hide();
        }
    }

    //укажем цену выбранного полиса, если она есть в данных
    if (defaultData['prem'] != null) document.querySelector('#prem b').innerHTML = defaultData['prem'];
}

//Отправка запроса на расчёт страховок
const chRequest = (url, csrf) => {

    let currency = document.getElementsByName('radio_currency')[0].checked ? document.getElementsByName('radio_currency')[0].value : document.getElementsByName('radio_currency')[1].value;
    let medical_amount = 30000;
    for( let i = 0; i < document.getElementsByName('medical_amount').length; i++) {
        if(document.getElementsByName('medical_amount')[i].checked) {
            medical_amount = document.getElementsByName('medical_amount')[i].value;
            break;
        }
    }

    let public_amount = 10000;
    for( let i = 0; i < document.getElementsByName('civil_responsibility').length; i++) {
        if(document.getElementsByName('civil_responsibility')[i].checked) {
            public_amount = document.getElementsByName('civil_responsibility')[i].value;
            break;
        }
    }


    let cancel_amount = 500;
    for( let i = 0; i < document.getElementsByName('flight_time_2').length; i++) {
        if(document.getElementsByName('flight_time_2')[i].checked) {
            cancel_amount = document.getElementsByName('flight_time_2')[i].value;
            break;
        }
    }

    let accident_amount = 1000;
    for( let i = 0; i < document.getElementsByName('accident').length; i++) {
        if(document.getElementsByName('accident')[i].checked) {
            accident_amount = document.getElementsByName('accident')[i].value;
            break;
        }
    }

    let laggage_amount = 1000;
    for( let i = 0; i < document.getElementsByName('flight_time').length; i++) {
        if(document.getElementsByName('flight_time')[i].checked) {
            laggage_amount = document.getElementsByName('flight_time')[i].value;
            break;
        }
    }

    let items = $('#ms').magicSuggest().getSelection();
    let args = 'countries[0]=';
    if (items.length > 0)  args += items[0].countryName
    if (items.length > 1) {
        for (let i = 1; i < items.length; i++) {
            args += '&countries[' + i + ']=' + items[i].countryName;
        }
    }

    args += '&dateFrom=' + document.querySelector('#dateFrom').value +
        '&dateTill=' + document.querySelector('#dateTill').value +
        '&travelers[0][accept]=' + document.querySelectorAll('.checkbox-one')[0].checked +
        '&travelers[0][age]=' + document.querySelectorAll('.age-human')[0].selectedOptions[0].value +
        '&travelers[1][accept]=' + document.querySelectorAll('.checkbox-one')[1].checked +
        '&travelers[1][age]=' + document.querySelectorAll('.age-human')[1].selectedOptions[0].value +
        '&travelers[2][accept]=' + document.querySelectorAll('.checkbox-one')[2].checked +
        '&travelers[2][age]=' + document.querySelectorAll('.age-human')[2].selectedOptions[0].value +
        '&travelers[3][accept]=' + document.querySelectorAll('.checkbox-one')[3].checked +
        '&travelers[3][age]=' + document.querySelectorAll('.age-human')[3].selectedOptions[0].value +
        '&travelers[4][accept]=' + document.querySelectorAll('.checkbox-one')[4].checked +
        '&travelers[4][age]=' + document.querySelectorAll('.age-human')[4].selectedOptions[0].value +
        '&risks[0][name]=medical&risks[0][amountCurrency]=' + currency +
        '&risks[0][check]=true&risks[0][amountAtRisk]=' + medical_amount +
        '&risks[1][name]=public&risks[1][amountCurrency]=' + currency +
        '&risks[1][check]=' + document.querySelector('#additional2_7').checked + '&risks[1][amountAtRisk]=' + public_amount +
        '&risks[2][name]=cancel&risks[2][amountCurrency]=' + currency +
        '&risks[2][check]=' + document.querySelector('#additional2_6').checked + '&risks[2][amountAtRisk]=' + cancel_amount +
        '&risks[3][name]=accident&risks[3][amountCurrency]=' + currency +
        '&risks[3][check]=' + document.querySelector('#additional_accident').checked + '&risks[3][amountAtRisk]=' + accident_amount +
        '&risks[4][name]=laggage&risks[4][amountCurrency]=' + currency +
        '&risks[4][check]=' + document.querySelector('#additional2_2').checked + '&risks[4][amountAtRisk]=' + laggage_amount +
        '&additionalConditions[0][name]=leisure&additionalConditions[0][check]=' + document.querySelector('#sport_0').checked +
        '&additionalConditions[1][name]=competition&additionalConditions[1][check]=' + document.querySelector('#sport_1').checked +
        '&additionalConditions[2][name]=extreme&additionalConditions[2][check]=' + document.querySelector('#sport_2').checked;

        //additionalConditions

    console.log(args);

    let func = viewCalc;

    ajaxRequest(url, csrf, args, func, 'post');

};

// Обновляем блок со страховкой
const viewCalc = response => {
    response = JSON.parse(response);
    let cards = document.getElementsByClassName('insCard');
    for ( let i = 0; i < cards.length; i++) {
        let id = cards[i].getAttribute('id');
        if(response[id]){
            console.log('API ' + id + ', cost ' + response[id]['prem']);
            cards[i].style.display = 'block';
            document.querySelector('#dis_' + id).style.display = 'none';
            document.querySelector('#' + id + ' .prem b').innerHTML = response[id]['prem'];
            document.querySelector('#' + id + ' .assistance p').innerHTML = '<b>' + response[id]['assistance']['name'] + '</b><br>' + response[id]['assistance']['info'];
        } else {
            cards[i].style.display = 'none';
            document.querySelector('#dis_' + id).style.display = 'block';
        }
    }

    console.log ('Insurance Parse');

};

//Отображаем блок с деталями полиса
const showDetails = (cardId) => {

    var tempForm = document.forms.form_details;
    tempForm.company_id.value = cardId;
    tempForm.submit();
};

// Вносим в страховку данные, введенные в форму на главной странице
const setDetailsDefaultData = (defaultData, csrf) => {

    defaultData = JSON.parse(defaultData);

    //сначала выделим страны, выбранные в начальной форме
    countryParseWithSelect('details', defaultData['countries'], csrf);

    //потом даты поездки
    var myDatepicker = $('#dateFrom').datepicker().data('datepicker');
    if (defaultData['dateFrom'] == null || defaultData['dateFrom'] == '') document.querySelector('#dateFrom').setAttribute('placeholder', 'Туда')
    else myDatepicker.selectDate(new Date(defaultData['dateFrom']));
    myDatepicker = $('#dateTill').datepicker().data('datepicker');
    if (defaultData['dateTill'] == null || defaultData['dateTill'] == '') document.querySelector('#dateTill').setAttribute('placeholder', 'Обратно')
    else myDatepicker.selectDate(new Date(defaultData['dateTill']));

    //потом количество путешественников (и их дату рождения)
    for (var i = 0; i < 5; i++) {
        var tempVar = defaultData['travelers'][i]['accept'];
        if (tempVar) {
            //tempObj = ;
            $('#traveler' + i).css('display', 'block');
            $('#trAccept' + i).prop('value', 'true');
            $('#trFirstName' + i).prop('disabled', false);
            $('#trLastName' + i).prop('disabled', false);
            $('#trBirthDate' + i).prop('disabled', false);
        }
    }

    //укажем цену выбранного полиса, если она есть в данных
    if (defaultData['prem'] != null) document.querySelector('#prem b').innerHTML = defaultData['prem'];

    //и подготовим окно выбора даты рождения
    $('#insurederDateBirth').datepicker({
        view: 'years',
        autoClose: 'true',
        /*onSelect: function (fd, date, inst) {

            if (document.querySelector('#dateFrom').value != '') {
                $('#dateFrom').datepicker().data('datepicker').hide();
                if (document.querySelector('#dateFrom').value > document.querySelector('#dateTill').value)  $('#dateTill').datepicker().data('datepicker').clear();
                $('#dateTill').datepicker().data('datepicker').update('minDate', new Date(document.querySelector('#dateFrom').value));
                $('#dateTill').datepicker().data('datepicker').show();
            }
        },
        onHide: function (dp, animationCompleted) {
            if (document.querySelector('#dateFrom').value == '' && document.querySelectorAll('#dateFrom.auto-correct').length > 0) {
                $('#dateFrom').datepicker().data('datepicker').selectDate(new Date());

            }
        }*/
    });
}

//Отправка на рассчет деталей полиса
const chDetails = (url, csrf) => {

    let currency = document.getElementsByName('radio_currency')[0].checked ? document.getElementsByName('radio_currency')[0].value : document.getElementsByName('radio_currency')[1].value;
    let medical_amount = 30000;
    for( let i = 0; i < document.getElementsByName('medical_amount').length; i++) {
        if(document.getElementsByName('medical_amount')[i].checked) {
            medical_amount = document.getElementsByName('medical_amount')[i].value;
            break;
        }
    }

    let public_amount = 10000;
    for( let i = 0; i < document.getElementsByName('civil_responsibility').length; i++) {
        if(document.getElementsByName('civil_responsibility')[i].checked) {
            public_amount = document.getElementsByName('civil_responsibility')[i].value;
            break;
        }
    }


    let cancel_amount = 500;
    for( let i = 0; i < document.getElementsByName('flight_time_2').length; i++) {
        if(document.getElementsByName('flight_time_2')[i].checked) {
            cancel_amount = document.getElementsByName('flight_time_2')[i].value;
            break;
        }
    }

    let accident_amount = 1000;
    for( let i = 0; i < document.getElementsByName('accident').length; i++) {
        if(document.getElementsByName('accident')[i].checked) {
            accident_amount = document.getElementsByName('accident')[i].value;
            break;
        }
    }

    let laggage_amount = 1000;
    for( let i = 0; i < document.getElementsByName('flight_time').length; i++) {
        if(document.getElementsByName('flight_time')[i].checked) {
            laggage_amount = document.getElementsByName('flight_time')[i].value;
            break;
        }
    }

    let items = $('#ms').magicSuggest().getSelection();
    let args = 'countries[0]=';
    if (items.length > 0)  args += items[0].countryName
    if (items.length > 1) {
        for (let i = 1; i < items.length; i++) {
            args += '&countries[' + i + ']=' + items[i].countryName;
        }
    }

    args += '&dateFrom=' + document.querySelector('#dateFrom').value +
        '&dateTill=' + document.querySelector('#dateTill').value +
        '&travelers[0][accept]=' + document.querySelectorAll('.checkbox-one')[0].checked +
        '&travelers[0][age]=' + document.querySelectorAll('.age-human')[0].selectedOptions[0].value +
        '&travelers[1][accept]=' + document.querySelectorAll('.checkbox-one')[1].checked +
        '&travelers[1][age]=' + document.querySelectorAll('.age-human')[1].selectedOptions[0].value +
        '&travelers[2][accept]=' + document.querySelectorAll('.checkbox-one')[2].checked +
        '&travelers[2][age]=' + document.querySelectorAll('.age-human')[2].selectedOptions[0].value +
        '&travelers[3][accept]=' + document.querySelectorAll('.checkbox-one')[3].checked +
        '&travelers[3][age]=' + document.querySelectorAll('.age-human')[3].selectedOptions[0].value +
        '&travelers[4][accept]=' + document.querySelectorAll('.checkbox-one')[4].checked +
        '&travelers[4][age]=' + document.querySelectorAll('.age-human')[4].selectedOptions[0].value +
        '&risks[0][name]=medical&risks[0][amountCurrency]=' + currency +
        '&risks[0][check]=true&risks[0][amountAtRisk]=' + medical_amount +
        '&risks[1][name]=public&risks[1][amountCurrency]=' + currency +
        '&risks[1][check]=' + document.querySelector('#additional2_7').checked + '&risks[1][amountAtRisk]=' + public_amount +
        '&risks[2][name]=cancel&risks[2][amountCurrency]=' + currency +
        '&risks[2][check]=' + document.querySelector('#additional2_6').checked + '&risks[2][amountAtRisk]=' + cancel_amount +
        '&risks[3][name]=accident&risks[3][amountCurrency]=' + currency +
        '&risks[3][check]=' + document.querySelector('#additional2_1').checked + '&risks[3][amountAtRisk]=' + accident_amount +
        //'&risks[4][name]=property&risks[4][amountCurrency]=' + currency +
        //'&risks[4][check]=' + document.querySelector('#additional2_1').checked + '&risks[4][amountAtRisk]=' + property_amount +
        '&risks[4][name]=laggage&risks[4][amountCurrency]=' + currency +
        '&risks[4][check]=' + document.querySelector('#additional2_2').checked + '&risks[4][amountAtRisk]=' + laggage_amount;

    console.log(args);

    let func = viewDetails;

    ajaxRequest(url, csrf, args, func, 'post');

    console.log('Данные деталей отправлены')
};

// Обновляем блок с деталями полиса (ценой)
const viewDetails = response => {
    response = JSON.parse(response);

    if (response.hasOwnProperty('alpha') && response['alpha'].hasOwnProperty('prem')) {
        document.querySelector('.prem b').innerHTML = response['alpha']['prem'];
    } else {
        document.querySelector('.prem b').textContent = 'Нет в наличии';
    }

    /*if (response.hasOwnProperty('vsk') && response['vsk'].hasOwnProperty('prem')) {
        document.querySelector('.prem b').innerHTML = response['vsk']['prem'];
    } else {
        document.querySelector('.prem b').textContent = 'Нет в наличии';
    }*/

    console.log ('Details Parse');
    //console.log(response);

};



// Отображаем блок с деталями купленного полиса полиса (ссылка на готовый полис в pdf)
const viewDone = response => {
    response = JSON.parse(response);

    document.querySelector('.police_link a').innerHTML = response['alpha']['common']['policyLink'];
    document.querySelector('.police_link a').href = response['alpha']['common']['policyLink'];

    console.log ('Done Parse');
    //console.log(response);

};

//переключатель "годовой полис"
function chYearPolice() {
    var tempDate;
    if (document.querySelector('#policy_for_year').checked) {
        console.log ('On');
        if (document.querySelector('#dateFrom').value != '') {
            tempDate = new Date(document.querySelector('#dateFrom').value);
        } else {
            tempDate = new Date();
            $('#dateFrom').datepicker().data('datepicker').selectDate(new Date());
        }
        tempDate.setFullYear(tempDate.getFullYear() + 1);
        $('#dateTill').datepicker().data('datepicker').clear();
        $('#dateTill').datepicker().data('datepicker').selectDate(tempDate);
    } else {
        console.log ('Off');
        if (document.querySelector('#dateFrom').value != '') {
            tempDate = new Date(document.querySelector('#dateFrom').value);
        } else {
            tempDate = new Date();

        }
        tempDate.setMonth(tempDate.getMonth() + 1);
        $('#dateTill').datepicker().data('datepicker').clear();
        $('#dateTill').datepicker().data('datepicker').selectDate(tempDate);
    }
}

//Оплётка для смены путешественников в калькуляторе
const travelersChange = (boxId, url, csrf) => {
    conditions(boxId);
    setTimeout(2000);
    chRequest(url, csrf);
}

//Оплётка для смены путешественников в деталях полиса
const travelersDetailsChange = (boxId, url, csrf) => {
    conditions(boxId);
    setTimeout(2000);
    chDetails(url, csrf);
}

// переключение количества путешественников
function conditions(boxId) {
    var tempObj = $('#tr_check_' + boxId)[0];
    if (tempObj.checked) {
        $('#tr' + boxId).show();
        //console.log ('Блок показан');
    } else {
        $('#tr' + boxId).hide();
        //console.log ('Блок спрятан');
    }

}

//Аджакс запрос
const ajaxRequest = (url, csrf, args, func, method) => {
    let Request = new XMLHttpRequest();

    if(!Request)
        return;
    Request.onreadystatechange = () => {
        if(Request.readyState === 4) {
            func(Request.responseText);
        }
    };

    Request.open(method, url);

    Request.setRequestHeader("X-CSRF-TOKEN", csrf);
    Request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    console.log(args);
    
    Request.send(args);
};

//Получить список различных данных
function getInsurData(url, csrf) {
    console.log ('Get Insur Data');

    args = '';

    var func = viewData;

    ajaxRequest(url, csrf, args, func, 'post');
}

function viewData(response) {

    //response = JSON.parse(response);



    console.log ('Answer Data' + response);
}

