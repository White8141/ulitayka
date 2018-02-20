
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

var i, tempObj;

//обработка массива country.json и внесение результатов в выпадающий список в упрощенной форме для страховки
function welcomeCountryParse() {

    $.getJSON('/js/json/country.json', function (data) {
        $.each(data, function (key, val) {
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

    //console.log('Country parse');
}

//обработка массива country.json и выбор заданных стран
function countryParseWithSelect(view, country, csrfToken) {

    var tempArr = [];

    $.getJSON('/js/json/country.json', function (data) {
        $.each(data, function(key, val) {
            tempArr.push({countryName: key,
                    countryViewName: val
            });
        });

        var myMs = $('#msCountries').magicSuggest({
            data: tempArr,
            placeholder: 'Выберите страну',
            valueField: 'countryName',
            displayField: 'countryViewName',
            maxSelection: 10,
            expandOnFocus: true,
            hideTrigger: true
        });

        tempArr = [];
        for (i = 0; i < country.length; i++) {
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

    $.getJSON('/js/json/sportActiveMain.json', function (data) {
        tempArr = [];
        $.each(data, function(key, val) {
            tempArr.push({sportName: key,
                sportViewName: val
            });
        });

        myMs = $('#msActiveMain').magicSuggest({
            data: tempArr,
            placeholder: 'Распространенные виды спорта',
            valueField: 'sportName',
            displayField: 'sportViewName',
            maxSelection: 10,
            expandOnFocus: true,
            hideTrigger: true,
            disabled: true
        });

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

    $.getJSON('/js/json/sportActiveOther.json', function (data) {
        tempArr = [];
        $.each(data, function(key, val) {
            tempArr.push({sportName: key,
                sportViewName: val
            });
        });

        myMs = $('#msActiveOther').magicSuggest({
            data: tempArr,
            placeholder: 'Другие виды спорта',
            valueField: 'sportName',
            displayField: 'sportViewName',
            maxSelection: 10,
            expandOnFocus: true,
            hideTrigger: true,
            disabled: true
        });

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

    $.getJSON('/js/json/sportActiveMain.json', function (data) {
        tempArr = [];
        $.each(data, function(key, val) {
            tempArr.push({sportName: key,
                sportViewName: val
            });
        });

        myMs = $('#msProfiMain').magicSuggest({
            data: tempArr,
            placeholder: 'Распространенные виды спорта',
            valueField: 'sportName',
            displayField: 'sportViewName',
            maxSelection: 10,
            expandOnFocus: true,
            hideTrigger: true,
            disabled: true
        });

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

    $.getJSON('/js/json/sportActiveOther.json', function (data) {
        tempArr = [];
        $.each(data, function(key, val) {
            tempArr.push({sportName: key,
                sportViewName: val
            });
        });

        myMs = $('#msProfiOther').magicSuggest({
            data: tempArr,
            placeholder: 'Другие виды спорта',
            valueField: 'sportName',
            displayField: 'sportViewName',
            maxSelection: 10,
            expandOnFocus: true,
            hideTrigger: true,
            disabled: true
        });

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

    //сначала выделим страну, выбранную в начальной форме
    if ('countries' in defaultData) {countryParseWithSelect('calc', defaultData['countries'], csrf);}
    else {countryParseWithSelect('calc', ['SCHENGEN'], csrf);}

    //потом даты поездки
    var myDatepicker = $('#dateFrom').datepicker().data('datepicker');
    if (defaultData['dateFrom'] == null || defaultData['dateFrom'] == '') {
        myDatepicker.selectDate(new Date());    //document.querySelector('#dateFrom').setAttribute('placeholder', 'Туда')
        //myDatepicker.value =
    } else {
        myDatepicker.selectDate(new Date(defaultData['dateFrom']));
    }

    myDatepicker = $('#dateTill').datepicker().data('datepicker');
    if (defaultData['dateTill'] == null || defaultData['dateTill'] == '') {
        tempDate = new Date(myDatepicker.date);
        tempDate.setMonth(tempDate.getMonth() + 1);
        myDatepicker.selectDate(tempDate);  //document.querySelector('#dateTill').setAttribute('placeholder', 'Обратно')
    } else {
        myDatepicker.selectDate(new Date(defaultData['dateTill']));
    }

    //потом количество путешественников (и возраст)
    var html;
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
    if ('prem' in defaultData) document.querySelector('#prem b').innerHTML = defaultData['prem'];
}

//Отправка запроса на расчёт страховок
const chRequest = (url, csrf) => {
    ajaxRequest(url, csrf, collectData(), updCalc, 'post');
};

// Обновляем блок со страховкой
const updCalc = response => {
    response = JSON.parse(response);
    let cards = document.getElementsByClassName('insCard');
    for ( let i = 0; i < cards.length; i++) {
        let id = cards[i].getAttribute('id');
        if(response[id] && response[id]['prem'] != '0.00') {
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

//Послать форму что бы получить блок с деталями полиса
const sendCalc = (cardId) => {

    var tempForm = document.forms.form_calc;
    tempForm.companyId.value = cardId;
    tempForm.companyURL.value = 'img/logo-' + cardId + '.png';
    tempForm.policeAmount.value = document.querySelector('#' + cardId + ' p.amount.prem').innerText;
    tempForm.submit();
};

// Вносим в страховку данные, введенные в форму на главной странице
const setDetailsDefaultData = (defaultData, csrf) => {

    defaultData = JSON.parse(defaultData);
    var tempVar;

    //сначала выделим страны, выбранные в начальной форме
    countryParseWithSelect('details', defaultData['countries'], csrf);

    //потом даты поездки
    var myDatepicker = $('#dateFrom').datepicker().data('datepicker');
    if (defaultData['dateFrom'] == null || defaultData['dateFrom'] == '') document.querySelector('#dateFrom').setAttribute('placeholder', 'Туда')
    else myDatepicker.selectDate(new Date(defaultData['dateFrom']));

    myDatepicker = $('#dateTill').datepicker().data('datepicker');
    if (defaultData['dateTill'] == null || defaultData['dateTill'] == '') document.querySelector('#dateTill').setAttribute('placeholder', 'Обратно')
    else myDatepicker.selectDate(new Date(defaultData['dateTill']));

    //подготовим окно выбора даты рождения страхователя
    tempVar = new Date();
    tempVar.setFullYear(tempVar.getFullYear() - 30);
    $('#insurederBirthDate').datepicker({
        view: 'years',
        autoClose: 'true',
        dateFormat: 'yyyy-mm-dd',
        startDate: tempVar
    });

    //потом количество путешественников (и их дату рождения)
    for (i = 0; i < defaultData['travelers'].length; i++) {
        if (defaultData['travelers'][i]['accept']) {
            $('#traveler' + i).css('display', 'block');
            $('#trAccept' + i).prop('value', 'true');
            $('#trAccept' + i).prop('checked', 'true');
            $('#trFirstName' + i).prop('disabled', false);
            $('#trLastName' + i).prop('disabled', false);
            $('#trBirthDate' + i).prop('disabled', false);
            document.querySelector('#trAge' + i).value = defaultData['travelers'][i]['age'];
            //подготовим окно выбора даты рождения
            tempVar = new Date();
            tempVar.setFullYear(tempVar.getFullYear() - defaultData['travelers'][i]['age']);
            $('#trBirthDate' + i).datepicker({
                view: 'years',
                autoClose: 'true',
                dateFormat: 'yyyy-mm-dd',
                startDate: tempVar
            });
        }
    }

    //укажем цену выбранного полиса, если она есть в данных
    if (defaultData['policeAmount'] != null) document.querySelector('#prem b').innerHTML = defaultData['policeAmount'];

    //указать выбранную валюту
    if (defaultData['radio_currency'] == 'EUR') {
        document.querySelector('#radio_euro').checked = true;
        document.querySelector('#radio_dollar').checked = false;
    } else {
        document.querySelector('#radio_euro').checked = false;
        document.querySelector('#radio_dollar').checked = true;
    }

    //показать выделенные на предыдущей странице риски
    //сумма медицинской страховки
    document.querySelector('#radio_medical_amount_' + defaultData['medical_amount']).checked = true;
    //сумма страховки гражданской отвественности
    if (defaultData['additional_public']) {
        document.querySelector('#additional_public').checked = true;
        tempObj = document.getElementsByName('civil_responsibility');
        tempObj.forEach(function (item) {
            item.disabled = false;
        });
        document.querySelector('#radio_civil_responsibility_' + defaultData['civil_responsibility']).checked = true;
    }
    //сумма страховки отмены поездки
    if (defaultData['additional_cancel']) {
        document.querySelector('#additional_cancel').checked = true;
        tempObj = document.getElementsByName('cancel');
        tempObj.forEach(function (item) {
            item.disabled = false;
        });
        document.querySelector('#radio_cancel_' + defaultData['cancel']).checked = true;
    }
    //сумма страховки от несчастных случаев
    if (defaultData['additional_accident']) {
        document.querySelector('#additional_accident').checked = true;
        tempObj = document.getElementsByName('accident');
        tempObj.forEach(function (item) {
            item.disabled = false;
        });
        document.querySelector('#radio_accident_' + defaultData['accident']).checked = true;
    }
    //сумма страховки багажа
    if (defaultData['additional_laggage']) {
        document.querySelector('#additional_laggage').checked = true;
        tempObj = document.getElementsByName('laggage');
        tempObj.forEach(function (item) {
            item.disabled = false;
        });
        document.querySelector('#radio_laggage_' + defaultData['laggage']).checked = true;
    }

    //показать выделенные на предыдущей странице виды спорта
    if (defaultData['sport_active'] && defaultData['sport_active'] == 'on') {
        document.querySelector('#sport_active').checked = true;
        //$('#msActiveMain').magicSuggest().enable();
        //$('#msActiveOther').magicSuggest().enable();
        //if ('activeMain' in defaultData) $('#msActiveMain').magicSuggest().setValue(defaultData['activeMain']);
        //if ('activeOther' in defaultData) $('#msActiveOther').magicSuggest().setValue(defaultData['activeOther']);
    }
    if (defaultData['sport_proffesional'] && defaultData['sport_proffesional'] == 'on') {
        document.querySelector('#sport_proffesional').checked = true;
        //$('#msProfiMain').magicSuggest().enable();
        //$('#msProfiOther').magicSuggest().enable();
        //if ('profiMain' in defaultData) $('#msProfiMain').magicSuggest().setValue(defaultData['profiMain']);
        //if ('profiOther' in defaultData) $('#msProfiOther').magicSuggest().setValue(defaultData['profiOther']);
    }
    if (defaultData['sport_extreme'] && defaultData['sport_extreme'] == 'on') {
        document.querySelector('#sport_extreme').checked = true;
    }




}

//Отправка на рассчет деталей полиса
const chDetails = (url, csrf) => {
    ajaxRequest(url, csrf, collectData(), updDetails, 'post');
    //console.log('Данные деталей отправлены')
};

// Обновляем блок с деталями полиса (ценой)
const updDetails = response => {
    response = JSON.parse(response);

    var companyId = document.querySelector('#companyId').value;
    if (response.hasOwnProperty(companyId) && response[companyId].hasOwnProperty('prem')) {
        document.querySelector('.prem b').innerHTML = response[companyId]['prem'];
        document.querySelector('.fa').style.display = 'inline';
        document.querySelector('#submitBtn').disabled = false;
    } else {
        document.querySelector('.prem b').textContent = 'Нет в наличии';
        document.querySelector('.fa').style.display = 'none';
        document.querySelector('#submitBtn').disabled = true;
    }

    /*if (response.hasOwnProperty('vsk') && response['vsk'].hasOwnProperty('prem')) {
        document.querySelector('.prem b').innerHTML = response['vsk']['prem'];
    } else {
        document.querySelector('.prem b').textContent = 'Нет в наличии';
    }*/

    console.log ('Details Parse');
    //console.log(response);

};

//Послать форму что бы получить блок результатом покупки
const sendDetails = () => {

    var tempForm = document.forms.form_details;
    var checked = false;
    if (tempForm.insurederFirstName.value != '' && tempForm.insurederLastName.value != '') {
        if (tempForm.insurederBirthDate.value != '') {
            checked = true;
        }
    }
    if (checked) {
        tempForm.submit();
    } else {
        console.log ('Form error');
    }
    console.log ('Form submit');
};

// Отображаем блок с деталями купленного полиса полиса (ссылка на готовый полис в pdf)
const viewDone = response => {
    response = JSON.parse(response);

    if ('alpha' in response) {
        document.querySelector('#succesfull').style.display = 'block';
        document.querySelector('#wrong').style.display = 'none';
        document.querySelector('.police_link a').innerHTML = response['alpha']['common']['policyLink'];
        document.querySelector('.police_link a').href = response['alpha']['common']['policyLink'];
    } else {
        document.querySelector('#succesfull').style.display = 'none';
        document.querySelector('#wrong').style.display = 'block';
    }


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
        tempDate.setDate(tempDate.getDate() - 1);
        $('#dateTill').datepicker().data('datepicker').clear();
        $('#dateTill').datepicker().data('datepicker').selectDate(tempDate);
        //$('#dateTill').datepicker().data('datepicker').update(['value', tempDate]);
    } else {
        console.log ('Off');
        if (document.querySelector('#dateFrom').value != '') {
            tempDate = new Date(document.querySelector('#dateFrom').value);
        } else {
            tempDate = new Date();

        }
        tempDate.setMonth(tempDate.getMonth() + 1);
        $('#dateTill').datepicker().data('datepicker').clear();
        //$('#dateTill').datepicker().data('datepicker').update(['value', tempDate]);
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
    tempObj = $('#tr_check_' + boxId)[0];
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

/**
 * Собрать данные со страницы и создать из них строку типа form-urlencoded
 */
function collectData () {
    let currency = document.getElementsByName('radio_currency')[0].checked ? document.getElementsByName('radio_currency')[0].value : document.getElementsByName('radio_currency')[1].value;

    if (document.querySelector('#sport_active').checked) {
        $('#msActiveMain').magicSuggest().enable();
        $('#msActiveOther').magicSuggest().enable();
    } else {
        $('#msActiveMain').magicSuggest().disable();
        $('#msActiveOther').magicSuggest().disable();
    }

    if (document.querySelector('#sport_proffesional').checked) {
        $('#msProfiMain').magicSuggest().enable();
        $('#msProfiOther').magicSuggest().enable();
    } else {
        $('#msProfiMain').magicSuggest().disable();
        $('#msProfiOther').magicSuggest().disable();
    }

    let medical_amount = 30000;
    for( i = 0; i < document.getElementsByName('medical_amount').length; i++) {
        if(document.getElementsByName('medical_amount')[i].checked) {
            medical_amount = document.getElementsByName('medical_amount')[i].value;
            break;
        }
    }

    let public_amount = 10000;
    for( i = 0; i < document.getElementsByName('civil_responsibility').length; i++) {
        document.getElementsByName('civil_responsibility')[i].disabled = !document.querySelector('#additional_public').checked;
        if(document.getElementsByName('civil_responsibility')[i].checked) {
            public_amount = document.getElementsByName('civil_responsibility')[i].value;
            //break;
        }
    }

    let cancel_amount = 500;
    document.getElementsByName('cancel_visa')[0].disabled = !document.querySelector('#additional_cancel').checked;
    for( i = 0; i < document.getElementsByName('cancel').length; i++) {
        document.getElementsByName('cancel')[i].disabled = !document.querySelector('#additional_cancel').checked;
        if(document.getElementsByName('cancel')[i].checked) {
            cancel_amount = document.getElementsByName('cancel')[i].value;
            //break;
        }
    }

    let accident_amount = 1000;
    document.getElementsByName('accident_flight')[0].disabled = !document.querySelector('#additional_accident').checked;
    for (i = 0; i < document.getElementsByName('accident').length; i++) {
        document.getElementsByName('accident')[i].disabled = !document.querySelector('#additional_accident').checked;
        if (document.getElementsByName('accident')[i].checked) {
            accident_amount = document.getElementsByName('accident')[i].value;
        }
    }

    let laggage_amount = 1000;
    let tempArr = document.getElementsByName('laggage');
    document.getElementsByName('laggage_time')[0].disabled = !document.querySelector('#additional_laggage').checked;
    for( i = 0; i < tempArr.length; i++) {
        tempArr[i].disabled = !document.querySelector('#additional_laggage').checked;
        if(tempArr[i].checked) {
            laggage_amount = tempArr[i].value;
        }
    }

    tempArr = document.getElementsByName('pregnancy');
    for( i = 0; i < tempArr.length; i++) {
        tempArr[i].disabled = !document.querySelector('#additional_pregnancy').checked;
    }

    let args = 'countries[0]=';
    
    //собираем массив стран путешествия
    let items = $('#msCountries').magicSuggest().getSelection();
    if (items.length > 0) {
        if (items[0].countryName != '') {
            args += items[0].countryName;
        } else {
            args += 'SCHENGEN';
        }
    }
    if (items.length > 1) {
        for (i = 1; i < items.length; i++) {
            args += '&countries[' + i + ']=' + items[i].countryName;
        }
    }

    //даты начала и конца страхования
    args += '&dateFrom=' + document.querySelector('#dateFrom').value + '&dateTill=' + document.querySelector('#dateTill').value;

    tempVar = document.querySelectorAll('.checkbox-one');
    //данные о застрахованных
    args += '&travelers[0][accept]=' + document.querySelectorAll('.checkbox-one')[0].checked +
            '&travelers[0][age]=' + document.querySelectorAll('.age-human')[0].value +
            '&travelers[1][accept]=' + document.querySelectorAll('.checkbox-one')[1].checked +
            '&travelers[1][age]=' + document.querySelectorAll('.age-human')[1].value +
            '&travelers[2][accept]=' + document.querySelectorAll('.checkbox-one')[2].checked +
            '&travelers[2][age]=' + document.querySelectorAll('.age-human')[2].value +
            '&travelers[3][accept]=' + document.querySelectorAll('.checkbox-one')[3].checked +
            '&travelers[3][age]=' + document.querySelectorAll('.age-human')[3].value +
            '&travelers[4][accept]=' + document.querySelectorAll('.checkbox-one')[4].checked +
            '&travelers[4][age]=' + document.querySelectorAll('.age-human')[4].value;

    //данные о рисках
    args += '&risks[0][name]=medical&risks[0][amountCurrency]=' + currency +
            '&risks[0][check]=true&risks[0][amountAtRisk]=' + medical_amount +
            '&risks[1][name]=public&risks[1][amountCurrency]=' + currency +
            '&risks[1][check]=' + document.querySelector('#additional_public').checked + '&risks[1][amountAtRisk]=' + public_amount +
            '&risks[2][name]=cancel&risks[2][amountCurrency]=' + currency +
            '&risks[2][check]=' + document.querySelector('#additional_cancel').checked + '&risks[2][amountAtRisk]=' + cancel_amount +
            '&risks[3][name]=accident&risks[3][amountCurrency]=' + currency +
            '&risks[3][check]=' + document.querySelector('#additional_accident').checked + '&risks[3][amountAtRisk]=' + accident_amount +
            '&risks[4][name]=laggage&risks[4][amountCurrency]=' + currency +
            '&risks[4][check]=' + document.querySelector('#additional_laggage').checked + '&risks[4][amountAtRisk]=' + laggage_amount;
    //дополнительные условия страхования
    args += '&additionalConditions[0][name]=leisure&additionalConditions[0][check]=' + document.querySelector('#sport_active').checked +
            '&additionalConditions[1][name]=competition&additionalConditions[1][check]=' + document.querySelector('#sport_proffesional').checked +
            '&additionalConditions[2][name]=extreme&additionalConditions[2][check]=' + document.querySelector('#sport_extreme').checked;

    //данные о видах спорта
    items = $('#msActiveMain').magicSuggest().getSelection();
    if (items.length > 0) {
        items.forEach (function (item, i) {
            args += '&sportActiveMain[' + i + ']=' + item.sportName;
        })
    }
    items = $('#msActiveOther').magicSuggest().getSelection();
    if (items.length > 0) {
        items.forEach (function (item, i) {
            args += '&sportActiveOther[' + i + ']=' + item.sportName;
        })
    }

    items = $('#msProfiMain').magicSuggest().getSelection();
    if (items.length > 0) {
        items.forEach (function (item, i) {
            args += '&sportProfiMain[' + i + ']=' + item.sportName;
        })
    }
    items = $('#msProfiOther').magicSuggest().getSelection();
    if (items.length > 0) {
        items.forEach (function (item, i) {
            args += '&sportProfiOther[' + i + ']=' + item.sportName;
        })
    }

    return args;
}

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

