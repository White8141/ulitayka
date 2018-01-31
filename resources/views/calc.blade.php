@extends('app')

@section('meta')
    <title>Улитайка - страхование для туристов</title>
@stop

@section('content')

    <div class="container">

        <div class="row">





                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" id="cards">
                    <div class="card insCard" id="alpha">
                        <img src="{{ asset('img/logo-alpha.png') }}" alt="" class="img_logo">
                        <p class="amount prem"><b></b> <span class="fa fa-rub"></span></p>
                        <input type="checkbox" name="card_checkbox1" id="card_checkbox1" class="checkbox_form">
                        <label for="card_checkbox1"></label>
                        <a href="#"><img src="{{ asset('img/button_blue.png') }}" alt="" class="blue_button">
                        </a>
                        <a href="#"><img src="{{ asset('img/button_orange.png') }}" alt="" class="orange_button">
                        </a>
                        <a href="#" onclick=showDetails('alpha')>
                            <p class="blue_button_text">Купить</p>
                        </a>
                        <a href="#">
                            <p class="orange_button_text">Сравнить</p>
                        </a>
                        <div class="call_style">
                            <a href="#" class="callback_us">
                                <span class="polis_example">Образец полиса</span>
                                {{--<hr class="orange_dashed2">--}}
                            </a>
                        </div>

                        <div class="container_new">
                            <div class="tabs">
                                <input id="tab1" type="radio" name="tabs">
                                <label for="tab1" title="Ассистанс">Ассистанс</label>

                                <input id="tab2" type="radio" name="tabs">
                                <label for="tab2" title="Франшиза">Франшиза</label>

                                <input id="tab3" type="radio" name="tabs">
                                <label for="tab3" title="Правила страхования">Правила страхования</label>
                                {{--<hr class="orange2">--}}
                                <section id="content-tab1" class="assistance">
                                    <p style="text-align: justify;" >

                                    </p>
                                </section>
                                <section id="content-tab2">
                                    <p style="text-align: justify;">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                        irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                                        nulla
                                        pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                        officia
                                        deserunt mollit anim id est laborum.
                                    </p>
                                </section>
                                <section id="content-tab3">
                                    <p style="text-align: justify;">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                        irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                                        nulla
                                        pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                        officia
                                        deserunt mollit anim id est laborum.
                                    </p>
                                </section>
                            </div>
                        </div>
                    </div>

                    <p id="disparity_orange_text">Не соответствует Вашему запросу</p>
                    <div class="disparity_grey" id="dis_alpha">
                        <div class="card disparity_card">
                            <p class="disparity_text">Страховка не соответствует Вашему запросу</p>
                            <img src="{{ asset('img/logo-alpha.png') }} " alt="Альфа страхование"
                                 class="img_logo img_logo_disparity">
                        </div>
                    </div>
                    <br>
                    <div class="disparity_grey" id="dis_ing">
                        <div class="card disparity_card">
                            <p class="disparity_text">Страховка не соответствует Вашему запросу</p>
                            <img src="{{ asset('img/logo-ingosstrah.png') }} " alt="Ингосстрах жизнь"
                                 class="img_logo img_logo_disparity">
                        </div>
                    </div>
                    <br>
                    <div class="disparity_grey" id="dis_vtb">
                        <div class="card disparity_card">
                            <p class="disparity_text">Страховка не соответствует Вашему запросу</p>
                            <img src="{{ asset('img/logo-vtb.png') }} " alt="ВТБ страхование"
                                 class="img_logo img_logo_disparity">
                        </div>
                    </div>
                    <br>
                    <div class="disparity_grey" id="dis_reso">
                        <div class="card disparity_card">
                            <p class="disparity_text">Страховка не соответствует Вашему запросу</p>
                            <img src="{{ asset('img/logo-reso.png') }} " alt="Ресо гарантия"
                                 class="img_logo img_logo_disparity">
                        </div>
                    </div>
                    <br>
                    <div class="disparity_grey" id="dis_ren">
                        <div class="card disparity_card">
                            <p class="disparity_text">Страховка не соответствует Вашему запросу</p>
                            <img src="{{ asset('img/logo-renessans.png') }} " alt="Ренессанс страхование"
                                 class="img_logo img_logo_disparity">
                        </div>
                    </div>
                    <br>

                    <div class="card">
                        <img src="{{ asset('img/logo-alpha.png') }} " alt="Альфа страхование" class="img_logo_compare">
                        <img src="{{ asset('img/logo-ergo.png') }} " alt="Ergo" class="img_logo_compare">
                        <img src="{{ asset('img/logo-advant.png') }} " alt="Адвант страхование" class="img_logo_compare">
                        <img src="{{ asset('img/logo-renessans.png') }} " alt="Ренессанс страхование"
                             class="img_logo_compare">
                        <a href="#"><img src="{{ asset('img/button_orange.png') }} " alt="" class="orange_button2">
                        </a>
                        <a href="#">
                            <p class="orange_button_text2">Сравнить</p>
                        </a>
                        {{--<hr class="orange3">--}}
                    </div>

                </div>






                    <div class="filter_wimdow col-lg-5 col-md-5 col-sm-12 col-xs-12" id="filters">
                    <div class="card card_right">
                        <div class="container_filters">

                            <p class="filter_h3">Страны</p>
                        <!--select onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" id="page-country" class="form-control blue_input_text textbox_100_percent"
                                name="countries[0]" style="cursor: pointer">
                        </select><label for="page-country"></label-->
                            <div>
                                <input id="ms" class="form-control" name="countries[]"/>
                                <label></label>
                            </div>

                            <input type="checkbox" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" name="i_am_travelling" id="i_am_travelling"
                                   class="check_and_radio"><label for="i_am_travelling" class="filter_checkbox">Я уже
                                путешествую</label>
                            <!--a href="#" onclick="addCountry()"><label class="add_country">Добавить страну</label><span
                                        class="blue add_country glyphicon glyphicon-plus" id="icon_plus"></span></a-->
                            <br>

                            <input name="dateFrom" onblur="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" id="dateFrom" type="text" placeholder="Туда"
                                   class="datepicker-here calendar blue_input_text textbox_49_percent auto-correct"
                                   data-multiple-dates="1" data-date-format="yyyy-mm-dd" data-multiple-dates-separator=", "
                                   style="cursor: pointer" readonly/>

                            <input name="dateTill" onblur="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" id="dateTill" type="text" placeholder="Обратно"
                                   class="datepicker-here calendar blue_input_text textbox_49_percent auto-correct"
                                   data-multiple-dates="1" data-date-format="yyyy-mm-dd" data-multiple-dates-separator=", "
                                   style="cursor: pointer" readonly/>
                            <!--span class="fa fa-calendar"></span-->

                            <input type="checkbox" onchange="chYearPolice('{{route('calcajax')}}', '{{csrf_token()}}')" name="policy_for_year" id="policy_for_year"
                                   class="check_and_radio"><label for="policy_for_year" class="filter_checkbox">Годовой
                                полис</label>
                            <br>


                            <div class="box-pos123">
                                <!--div class="box-2 blue_input_text textbox_100_percent font-size14"
                                     placeholder="Сколько человек, возраст" style="cursor: pointer"></div-->
                                <p class="filter_h3">Сколько человек, возраст</p>
                                <div class="human-123drop sel-text">
                                    <div>
                                        <input name="travelers[0][accept]" type="checkbox" value="true" id="tr_check_0" class="checkbox-one" checked
                                               onclick="travelersChange(0, '{{route('calcajax')}}', '{{csrf_token()}}')"><label for="tr_check_0">1 путешественник</label>
                                   <span>
                                   <select name="travelers[0][age]" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" class="age-human"
                                           id="tr0"></select>
                           </span>
                                    </div>
                                    <div>
                                        <input name="travelers[1][accept]" type="checkbox" value="true" id="tr_check_1" class="checkbox-one"
                                               onclick="travelersChange(1, '{{route('calcajax')}}', '{{csrf_token()}}')"><label for="tr_check_1">2 путешественник</label>
                                   <span>
                                   <select name="travelers[1][age]" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" class="age-human"
                                           id="tr1"></select>
                            </span>
                                    </div>
                                    <div>
                                        <input name="travelers[2][accept]" type="checkbox" value="true" id="tr_check_2" class="checkbox-one"
                                               onclick="travelersChange(2, '{{route('calcajax')}}', '{{csrf_token()}}')"><label for="tr_check_2">3 путешественник</label>
                                   <span>
                                   <select name="travelers[2][age]" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" class="age-human"
                                           id="tr2"></select>
                            </span>
                                    </div>
                                    <div>
                                        <input name="travelers[3][accept]" type="checkbox" value="true" id="tr_check_3" class="checkbox-one"
                                               onclick="travelersChange(3, '{{route('calcajax')}}', '{{csrf_token()}}')"><label for="tr_check_3">4 путешественник</label>
                                   <span>
                                   <select name="travelers[3][age]" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" class="age-human"
                                           id="tr3"></select>
                            </span>
                                    </div>
                                    <div>
                                        <input name="travelers[4][accept]" type="checkbox" value="true" id="tr_check_4" class="checkbox-one"
                                               onclick="travelersChange(4, '{{route('calcajax')}}', '{{csrf_token()}}')"><label for="tr_check_4">5 путешественник</label>
                                   <span>
                                   <select name="travelers[4][age]" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" class="age-human"
                                           id="tr4"></select>
                            </span>
                                    </div>
                                </div>
                            </div>

                            {{--<input type="text" placeholder="Количество путешественников"--}}
                            {{--class="blue_input_text textbox_70_percent">--}}
                            {{--<a href="#" style="margin-left: 10px; width: 80px !important;"><img--}}
                            {{--src="{{ asset('img/button_blue.png') }}" alt="" class="blue_button2">--}}
                            {{--</a>--}}
                            {{--<img src="{{ asset('img/people.png') }} " alt="" class="textbox_70_percent_pic_1">--}}

                            {{--<a href="#">--}}
                            {{--<p class="blue_button_text2">Найти</p>--}}
                            {{--</a>--}}


                            <p class="filter_h3 radio_currency">Выбор курса</p>
                            <input type="radio" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" name="radio_currency" value="EUR" id="radio_euro" class="check_and_radio" checked onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')">
                            <label for="radio_euro" style="margin-right: 20px;">Евро</label>
                            <input type="radio" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" name="radio_currency" value="USD" id="radio_dollar" class="check_and_radio" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')">
                            <label for="radio_dollar" style="margin-right: 20px;">Доллар</label>

                            <p class="filter_h3" style="margin-top: 10px;">Медицинское страхование</p>
                            <div class="medical_amount">
                                <input type="radio" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" name="medical_amount" value="30000" id="radio_medical_amount_30000" class="check_and_radio" checked><label for="radio_medical_amount_30000" style="margin-right: 20px;">30&nbsp;000&nbsp;<p class="currency_symbol">&#8364;</p></label>
                                <input type="radio" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" name="medical_amount" value="35000" id="radio_medical_amount_35000" class="check_and_radio" ><label for="radio_medical_amount_35000" style="margin-right: 20px;">35&nbsp;000&nbsp;<p class="currency_symbol">&#8364;</p></label>
                                <input type="radio" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" name="medical_amount" value="40000" id="radio_medical_amount_40000" class="check_and_radio" ><label for="radio_medical_amount_40000" style="margin-right: 20px;">40&nbsp;000&nbsp;<p class="currency_symbol">&#8364;</p></label><br>
                                <input type="radio" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" name="medical_amount" value="50000" id="radio_medical_amount_50000" class="check_and_radio" ><label for="radio_medical_amount_50000" style="margin-right: 20px;">50&nbsp;000&nbsp;<p class="currency_symbol">&#8364;</p></label>
                                <input type="radio" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" name="medical_amount" value="100000" id="radio_medical_amount_100000" class="check_and_radio" ><label for="radio_medical_amount_100000">100&nbsp;000&nbsp;<p class="currency_symbol">&#8364;</p></label><br>
                            </div>
                            <a href="" id="toggle_insurance"><p class="filter_h3 blue inlined">Входит в страховку </p><span
                                        class="blue glyphicon glyphicon-chevron-down"
                                        style="margin-bottom: 20px !important;"></span></a>
                            <div id="toggle_insurance_list">
                                <img src="{{ asset('img/checked_green.png') }} ">
                                <p class="inlined padded"> Вызов врача по медицинским показаниям</p><br>
                                <img src="{{ asset('img/checked_green.png') }} ">
                                <p class="inlined padded"> Амбулаторное лечение</p><br>
                                <img src="{{ asset('img/checked_green.png') }} ">
                                <p class="inlined padded"> Пребывание и лечение в больнице</p><br>
                                <img src="{{ asset('img/checked_green.png') }} ">
                                <p class="inlined padded"> Транспортировка к врачу или в больницу</p><br>
                                <img src="{{ asset('img/checked_green.png') }} ">
                                <p class="inlined padded"> Медицинская транспортировка из-за границы</p><br>
                                <img src="{{ asset('img/checked_green.png') }} ">
                                <p class="inlined padded"> Возмещение расходов за лекарства по рецепту</p><br>
                                <img src="{{ asset('img/checked_green.png') }} ">
                                <p class="inlined padded"> Возмещение расходов за телефонные переговоры с сервисным
                                    центром</p><br>
                                <img src="{{ asset('img/checked_green.png') }} ">
                                <p class="inlined padded"> Репатриация в случае смерти</p><br>
                            </div>
                            <br>
                            <a href="" id="toggle_additional"><p class="filter_h3 blue inlined">Дополнительно </p><span
                                        class="blue glyphicon glyphicon-chevron-down"
                                        style="margin-bottom: 20px !important;"></span></a>
                            <div id="toggle_additional_list">
                                <input type="checkbox" name="additional_options" id="additional_1"
                                       class="check_and_radio"><label for="additional_1" class="inlined padded">Экстренная
                                    стоматология</label>
                                <br>
                                <input type="checkbox" name="additional_options" id="additional_2"
                                       class="check_and_radio"><label for="additional_2" class="inlined padded">Оплата
                                    проезда до места жительства после лечения в больнице Застрахованного</label>
                                <br>
                                <input type="checkbox" name="additional_options" id="additional_3"
                                       class="check_and_radio"><label for="additional_3" class="inlined padded">Оплата
                                    проезда до места жительства после лечения в больнице сопровождающего лица
                                    Застрахованного</label>
                                <br>
                                <input type="checkbox" name="additional_options" id="additional_4"
                                       class="check_and_radio"><label for="additional_4" class="inlined padded">Оплата
                                    проживания Застрахованного до отъезда после лечения в больнице</label>
                                <br>
                                <input type="checkbox" name="additional_options" id="additional_5"
                                       class="check_and_radio"><label for="additional_5" class="inlined padded">Оплата
                                    проживания третьего лица в случае чрезвычайной ситуации с Застрахованным</label>
                                <br>
                                <input type="checkbox" name="additional_options" id="additional_6"
                                       class="check_and_radio"><label for="additional_6" class="inlined padded">Оплата
                                    проезда домой несовершеннолетних детей Застрахованного</label>
                                <br>
                                <input type="checkbox" name="additional_options" id="additional_7"
                                       class="check_and_radio"><label for="additional_7" class="inlined padded">Оплата
                                    проезда домой в случае внзапной болезни/смерти родственника</label>
                                <br>
                                <input type="checkbox" name="additional_options" id="additional_8"
                                       class="check_and_radio"><label for="additional_8" class="inlined padded">Временное
                                    возвращение Застрахованного домой</label>
                                <br>
                                <input type="checkbox" name="additional_options" id="additional_9"
                                       class="check_and_radio"><label for="additional_9" class="inlined padded">Помощь в
                                    результате терактов</label>
                                <br>
                                <input type="checkbox" name="additional_options" id="additional_10" class="check_and_radio"><label
                                        for="additional_10" class="inlined padded">Помощь в результате стихийных действий
                                    (наводнения, цунами, торнадо и др.)</label>
                                <br>
                                <input type="checkbox" name="additional_options" id="additional_11" class="check_and_radio"><label
                                        for="additional_11" class="inlined padded" style="line-height: 1.5 !important;">Купирование
                                    обострения хронических заболеваний</label>
                                <br>
                                <input type="checkbox" name="additional_options" id="additional_12" class="check_and_radio"><label
                                        for="additional_12" class="inlined padded">Помощь при солнечных ожогах</label>
                                <br>
                                <input type="checkbox" name="additional_options" id="additional_13" class="check_and_radio"><label
                                        for="additional_13" class="inlined padded" style="margin-top: 5px !important;">Первая
                                    помощь при онкозаболеваниях</label>
                                <br>
                                <input type="checkbox" name="additional_options" id="additional_14" class="check_and_radio"><label
                                        for="additional_14" class="inlined padded">Купирование аллергических реакций</label>
                                <br>
                                <input type="checkbox" name="additional_options" id="additional_15" class="check_and_radio"><label
                                        for="additional_15" class="inlined padded">Помощь при наличии алкогольного
                                    опьянения</label>
                            </div>
                            <p class="filter_h3">Занятия спортом и активный отдых</p>

                            <select id="sports1_select" class="blue_input_text textbox_100_percent" name="sports1[0]" style="cursor: pointer">
                                <option selected value="randomword1">Распространенные виды спорта</option>
                            </select><label for="sports1_select"></label>
                            <select id="sports2_select" class="blue_input_text textbox_100_percent" name="sports2[0]" style="cursor: pointer">
                                <option selected value="randomword2">Другие виды спорта</option>
                            </select><label for="sports2_select"></label>

                            <br>
                            <input type="checkbox" name="pro_sport" id="pro_sport_1" class="check_and_radio"><label for="pro_sport_1">Передвижение на
                                мотоцикле/мопеде</label>
                            <br>
                            <input type="checkbox" name="pro_sport" id="pro_sport_2" class="check_and_radio"><label
                                    for="pro_sport_2">Поисково-спасательные мероприятия</label>
                            <br>
                            <input type="checkbox" name="pro_sport" id="pro_sport_3" class="check_and_radio"><label
                                    for="pro_sport_3">Эвакуация вертолетом</label>
                            <br>
                            <a href="" onclick="getRisks('{{route('getData')}}', '{{csrf_token()}}')" id="toggle_options"><p class="filter_h3 blue inlined">Дополнительные опции </p><span class="blue glyphicon glyphicon-chevron-down" style="margin-bottom: 20px !important;"></span></a>
                            <div id="toggle_options_list">

                                <input type="checkbox" name="additional_options2" id="additional2_1" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                       class="check_and_radio"><label for="additional2_1">Страхование от несчастных
                                    случаев</label>
                                <br>
                                <div class="margined">
                                    <p class="margin_bottom5">На все время путешествия</p>
                                    <input type="radio" checked value="1000" name="travel_time" id="radio_travel_time_1000" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                           class="check_and_radio"><label for="radio_travel_time_1000" class="margined_text"
                                                                          style="margin-right: 20px;">1&nbsp;000<p class="currency_symbol">€</p></label>
                                    <input type="radio" value="3000" name="travel_time" id="radio_travel_time_3000" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                           class="check_and_radio"><label for="radio_travel_time_3000" class="margined_text"
                                                                          style="margin-right: 20px;">3&nbsp;000<p class="currency_symbol">€</p></label>
                                    <input type="radio" value="5000" name="travel_time" id="radio_travel_time_5000" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                           class="check_and_radio"><label for="radio_travel_time_5000" class="margined_text"
                                                                          style="margin-right: 20px;">5&nbsp;000<p class="currency_symbol">€</p></label>
                                    <input type="radio" value="10000" name="travel_time" id="radio_travel_time_10000"  onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                           class="check_and_radio"><label
                                            for="radio_travel_time_10000" class="margined_text" style="margin-right: 20px;">10&nbsp;000<p class="currency_symbol">€</p></label>
                                    <br>
                                    <input type="checkbox" name="travel_time" id="travel_time_text"
                                           class="check_and_radio"><label for="travel_time_text" class="margined_text">На время
                                        авиаперелета</label>
                                </div>
                                <input type="checkbox" name="additional_options2" id="additional2_2"  onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                       class="check_and_radio"><label for="additional2_2">Страховка багажа</label>
                                <div class="margined">
                                    <p class="margin_bottom5">На время перелета</p>
                                    <input type="radio" checked name="flight_time" id="radio_flight_time_500" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                           class="check_and_radio"><label for="radio_flight_time_500" class="margined_text"
                                                                          style="margin-right: 20px;">500<p class="currency_symbol">€</p></label>
                                    <input type="radio" name="flight_time" id="radio_flight_time_1000" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                           class="check_and_radio"><label for="radio_flight_time_1000" class="margined_text"
                                                                          style="margin-right: 20px;">1&nbsp;000<p class="currency_symbol">€</p></label>
                                    <input type="radio" name="flight_time" id="radio_flight_time_1500" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                           class="check_and_radio"><label for="radio_flight_time_1500" class="margined_text"
                                                                          style="margin-right: 20px;">1&nbsp;500<p class="currency_symbol">€</p></label>
                                    <input type="radio" name="flight_time" id="radio_flight_time_2000" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                           class="check_and_radio"><label for="radio_flight_time_2000" class="margined_text"
                                                                          style="margin-right: 20px;">2&nbsp;000<p class="currency_symbol">€</p></label>
                                    <br>
                                    <input type="checkbox" name="flight_time" id="flight_time_text"
                                           class="check_and_radio"><label for="flight_time_text" class="margined_text">Страхование
                                        задержки багажа</label>
                                    <br>
                                </div>
                                <input type="checkbox" name="additional_options2" id="additional2_3"
                                       class="check_and_radio"><label for="additional2_3">Страхование авиаперелета</label>
                                <br>
                                <div class="margined">
                                    <input type="checkbox" name="flights" id="flights_regular" class="check_and_radio"><label
                                            for="flights_regular" class="margined_text">Страхование задержки регулярного
                                        рейса</label>
                                    <br>
                                    <input type="checkbox" name="flights" id="flights_charter" class="check_and_radio"><label
                                            for="flights_charter" class="margined_text">Страхование задержки чартерного
                                        рейса</label>
                                    <br>
                                </div>
                                <input type="checkbox" name="additional_options2" id="additional2_4"
                                       class="check_and_radio"><label for="additional2_4">Страхование потери документов</label>
                                <br>
                                <input type="checkbox" name="additional_options2" id="additional2_5"
                                       class="check_and_radio"><label for="additional2_5">Юридическая помощь</label>
                                <br>
                                <input type="checkbox" name="additional_options2" id="additional2_6" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                       class="check_and_radio"><label for="additional2_6">Страхование отмены поездки</label>
                                <br>
                                <div class="margined">
                                    <p class="margin_bottom5">На время перелета</p>
                                    <input type="radio" checked value="500" name="flight_time_2" id="radio_flight_time_2_500" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                           class="check_and_radio"><label for="radio_flight_time_2_500" class="margined_text"
                                                                          style="margin-right: 20px;">
                                        &nbsp;&nbsp;&nbsp;500<p class="currency_symbol">€</p></label>
                                    <input type="radio" value="1000" name="flight_time_2" id="radio_flight_time_2_1000" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                           class="check_and_radio"><label for="radio_flight_time_2_1000" class="margined_text"
                                                                          style="margin-right: 20px;">1&nbsp;000<p class="currency_symbol">€</p></label>
                                    <input type="radio" value="1500" name="flight_time_2" id="radio_flight_time_2_1500" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                           class="check_and_radio"><label for="radio_flight_time_2_1500" class="margined_text"
                                                                          style="margin-right: 20px;">1&nbsp;500<p class="currency_symbol">€</p></label>
                                    <input type="radio" value="2000" name="flight_time_2" id="radio_flight_time_2_2000" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                           class="check_and_radio"><label for="radio_flight_time_2_2000" class="margined_text"
                                                                          style="margin-right: 20px;">2&nbsp;000<p class="currency_symbol">€</p></label>
                                    <input type="radio" value="2500" name="flight_time_2" id="radio_flight_time_2_2500" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                           class="check_and_radio"><label for="radio_flight_time_2_2500" class="margined_text">2&nbsp;500</label>
                                    <br>
                                    <input type="radio" value="3000" name="flight_time_2" id="radio_flight_time_2_3000" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                           class="check_and_radio"><label for="radio_flight_time_2_3000" class="margined_text"
                                                                          style="margin-right: 20px;">3&nbsp;000<p class="currency_symbol">€</p></label>
                                    <input type="radio" value="3500" name="flight_time_2" id="radio_flight_time_2_3500" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                           class="check_and_radio"><label for="radio_flight_time_2_3500" class="margined_text"
                                                                          style="margin-right: 20px;">3&nbsp;500<p class="currency_symbol">€</p></label>
                                    <input type="radio" value="4000" name="flight_time_2" id="radio_flight_time_2_4000" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                           class="check_and_radio"><label for="radio_flight_time_2_4000" class="margined_text"
                                                                          style="margin-right: 20px;">4&nbsp;000<p class="currency_symbol">€</p></label>
                                    <input type="radio" value="4500" name="flight_time_2" id="radio_flight_time_2_4500" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                           class="check_and_radio"><label for="radio_flight_time_2_4500" class="margined_text"
                                                                          style="margin-right: 20px;">4&nbsp;500<p class="currency_symbol">€</p></label>
                                    <input type="radio" value="5000" name="flight_time_2" id="radio_flight_time_2_5000" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                           class="check_and_radio"><label for="radio_flight_time_2_5000" class="margined_text">5&nbsp;000<p class="currency_symbol">€</p></label>
                                    <br>
                                    <input type="checkbox" name="flight_time_2" id="flight_time_2_text" class="check_and_radio"><label
                                            for="flight_time_2_text" class="margined_text">Страхование риска отказа в
                                        визе</label>
                                    <br>
                                </div>
                                <input type="checkbox" value="true" name="additional_options2" id="additional2_7" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                       class="check_and_radio"><label for="additional2_7">Страхование гражданской
                                    ответственности</label>
                                <br>
                                <div class="margined">
                                    <input type="radio" checked name="civil_responsibility" value="10000" id="radio_civil_responsibility_10000" onclick="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                           class="check_and_radio"><label for="radio_civil_responsibility_10000"
                                                                          class="margined_text" style="margin-right: 20px;">10&nbsp;000<p class="currency_symbol">€</p></label>
                                    <input type="radio" name="civil_responsibility" value="30000" id="radio_civil_responsibility_30000" onclick="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                           class="check_and_radio"><label for="radio_civil_responsibility_30000"
                                                                          class="margined_text" style="margin-right: 20px;">30&nbsp;000<p class="currency_symbol">€</p></label>
                                    <input type="radio" name="civil_responsibility" value="50000" id="radio_civil_responsibility_50000" onclick="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                           class="check_and_radio"><label for="radio_civil_responsibility_50000"
                                                                          class="margined_text" style="margin-right: 20px;">50&nbsp;000<p class="currency_symbol">€</p></label>
                                    <br>
                                </div>
                                <input type="checkbox" name="additional_options2" id="additional2_8"
                                       class="check_and_radio"><label for="additional2_8">Страхование на случай осложнения
                                    беременности</label>
                                <br>
                                <div class="margined">
                                    <input type="radio" name="pregnancy" id="radio_pregnancy_12" class="check_and_radio"><label
                                            for="radio_pregnancy_12" class="margined_text" style="margin-right: 20px;">до 12
                                        недель</label>
                                    <input type="radio" name="pregnancy" id="radio_pregnancy_24" class="check_and_radio"><label
                                            for="radio_pregnancy_24" class="margined_text" style="margin-right: 20px;">до 24
                                        недель</label>
                                    <input type="radio" name="pregnancy" id="radio_pregnancy_31" class="check_and_radio"><label
                                            for="radio_pregnancy_31" class="margined_text">до 31 недели</label>
                                    <br>
                                </div>
                                <input type="checkbox" name="additional_options2" id="additional2_9"
                                       class="check_and_radio"><label for="additional2_9">Поездки на личном автомобиле</label>
                                <br>
                                <input type="checkbox" name="additional_options2" id="additional2_10"
                                       class="check_and_radio"><label for="additional2_10">Работа с повышенным риском</label>
                                <br>
                                <input type="checkbox" name="additional_options2" id="additional2_11"
                                       class="check_and_radio"><label for="additional2_11">Выбор по сервисной компании
                                    (ассистансу)</label>
                                <br>
                                <div class="margined">
                                    <input type="radio" name="radio_assist" id="radio_assist_alpha"
                                           class="check_and_radio"><label for="radio_assist_alpha" class="margined_text"
                                                                          style="margin-right: 20px;">Альфа</label>
                                    <input type="radio" name="radio_assist" id="radio_assist_ergo"
                                           class="check_and_radio"><label for="radio_assist_ergo"
                                                                          class="margined_text">Эрго</label>
                                    <br><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>












        </div>
    </div>

    <style type="text/css">#hellopreloader>p{display:none;}#hellopreloader_preload{display: block;position: fixed;z-index: 99999;top: 0;left: 0;width: 100%;height: 100%;min-width: 1000px;background: #6BB9F0 url(http://hello-site.ru//main/images/preloads/oval.svg) center center no-repeat;background-size:165px;}</style>
    <div id="hellopreloader"><div id="hellopreloader_preload"></div><p><a href="http://hello-site.ru">Hello-Site.ru. Бесплатный конструктор сайтов.</a></p></div>
    <script type="text/javascript">var hellopreloader = document.getElementById("hellopreloader_preload");function fadeOutnojquery(el){el.style.opacity = 1;var interhellopreloader = setInterval(function(){el.style.opacity = el.style.opacity - 0.05;if (el.style.opacity <=0.05){ clearInterval(interhellopreloader);hellopreloader.style.display = "none";}},16);}window.onload = function(){setTimeout(function(){fadeOutnojquery(hellopreloader);},1000);};</script>

@stop

@section('script')

<script>

    setCalcDefaultData ('{!! $defaultData !!}', '{{ csrf_token() }}');
    viewCalc ('{!! $calculation !!}');

</script>

@stop