@extends('layouts/app')

@section('meta')
    <title>Улитайка - страхование для туристов</title>
@stop

@section('content')

    <div class="container">
        <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" id="cards">

                    <div class="card insCard" id="alpha">
                        <img src="{{ asset('assets/img/logo-alpha.png') }}" alt="" class="img_logo">
                        <p class="amount prem"><b></b> <span class="fa fa-rub"></span></p>
                        <a><img src="{{ asset('assets/img/button_blue.png') }}" alt="" class="blue_button"></a>
                        <a onclick=sendCalc('alpha')>
                            <p class="blue_button_text">Оформить</p>
                        </a>
                        <div class="call_style">
                            <a class="callback_us">
                                <span class="polis_example">Образец полиса</span>
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
                    <div class="card insCard" id="vsk">
                        <img src="{{ asset('assets/img/logo-vsk.png') }}" alt="" class="img_logo">
                        <p class="amount prem"><b></b> <span class="fa fa-rub"></span></p>
                        <a href="#"><img src="{{ asset('assets/img/button_blue.png') }}" alt="" class="blue_button"></a>
                        <a onclick=sendCalc('vsk')>
                            <p class="blue_button_text">Оформить</p>
                        </a>
                        <div class="call_style">
                            <a class="callback_us">
                                <span class="polis_example">Образец полиса</span>
                            </a>
                        </div>

                        <div class="container_new">
                            <div class="tabs">
                                <input id="tab4" type="radio" name="tabs">
                                <label for="tab4" title="Ассистанс">Ассистанс</label>

                                <input id="tab5" type="radio" name="tabs">
                                <label for="tab5" title="Франшиза">Франшиза</label>

                                <input id="tab6" type="radio" name="tabs">
                                <label for="tab6" title="Правила страхования">Правила страхования</label>

                                <section id="content-tab4" class="assistance">
                                    <p style="text-align: justify;" >

                                    </p>
                                </section>
                                <section id="content-tab5">
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
                                <section id="content-tab6">
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
                    <div class="card insCard" id="advant">
                        <img src="{{ asset('assets/img/logo-advant.png') }}" alt="" class="img_logo">
                        <p class="amount prem"><b></b> <span class="fa fa-rub"></span></p>
                        <a href="#"><img src="{{ asset('assets/img/button_blue.png') }}" alt="" class="blue_button"></a>
                        <a onclick=sendCalc('advant')>
                            <p class="blue_button_text">Оформить</p>
                        </a>
                        <div class="call_style">
                            <a class="callback_us">
                                <span class="polis_example">Образец полиса</span>
                            </a>
                        </div>

                        <div class="container_new">
                            <div class="tabs">
                                <input id="tab7" type="radio" name="tabs">
                                <label for="tab7" title="Ассистанс">Ассистанс</label>

                                <input id="tab8" type="radio" name="tabs">
                                <label for="tab8" title="Франшиза">Франшиза</label>

                                <input id="tab9" type="radio" name="tabs">
                                <label for="tab9" title="Правила страхования">Правила страхования</label>
                                {{--<hr class="orange2">--}}
                                <section id="content-tab7" class="assistance">
                                    <p style="text-align: justify;" >

                                    </p>
                                </section>
                                <section id="content-tab8">
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
                                <section id="content-tab9">
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
                            <img src="{{ asset('assets/img/logo-alpha.png') }} " alt="Альфа страхование"
                                 class="img_logo img_logo_disparity">
                        </div>
                    </div>
                    <br>
                    <div class="disparity_grey" id="dis_vsk">
                        <div class="card disparity_card">
                            <p class="disparity_text">Страховка не соответствует Вашему запросу</p>
                            <img src="{{ asset('assets/img/logo-vsk.png') }} " alt="ВСК страхование"
                                 class="img_logo img_logo_disparity">
                        </div>
                    </div>
                    <br>
                    <div class="disparity_grey" id="dis_advant">
                        <div class="card disparity_card">
                            <p class="disparity_text">Страховка не соответствует Вашему запросу</p>
                            <img src="{{ asset('assets/img/logo-advant.png') }} " alt="ВСК страхование"
                                 class="img_logo img_logo_disparity">
                        </div>
                    </div>
                    <br>
                    <div class="disparity_grey" id="dis_ing">
                        <div class="card disparity_card">
                            <p class="disparity_text">Страховка не соответствует Вашему запросу</p>
                            <img src="{{ asset('assets/img/logo-ingosstrah.png') }} " alt="Ингосстрах жизнь"
                                 class="img_logo img_logo_disparity">
                        </div>
                    </div>
                    <br>
                    <div class="disparity_grey" id="dis_vtb">
                        <div class="card disparity_card">
                            <p class="disparity_text">Страховка не соответствует Вашему запросу</p>
                            <img src="{{ asset('assets/img/logo-vtb.png') }} " alt="ВТБ страхование"
                                 class="img_logo img_logo_disparity">
                        </div>
                    </div>
                    <br>
                    <div class="disparity_grey" id="dis_reso">
                        <div class="card disparity_card">
                            <p class="disparity_text">Страховка не соответствует Вашему запросу</p>
                            <img src="{{ asset('assets/img/logo-reso.png') }} " alt="Ресо гарантия"
                                 class="img_logo img_logo_disparity">
                        </div>
                    </div>
                    <br>
                    <div class="disparity_grey" id="dis_ren">
                        <div class="card disparity_card">
                            <p class="disparity_text">Страховка не соответствует Вашему запросу</p>
                            <img src="{{ asset('assets/img/logo-renessans.png') }} " alt="Ренессанс страхование"
                                 class="img_logo img_logo_disparity">
                        </div>
                    </div>
                    <br>

                    <div class="card">
                        <img src="{{ asset('assets/img/logo-alpha.png') }} " alt="Альфа страхование" class="img_logo_compare">
                        <img src="{{ asset('assets/img/logo-ergo.png') }} " alt="Ergo" class="img_logo_compare">
                        <img src="{{ asset('assets/img/logo-advant.png') }} " alt="Адвант страхование" class="img_logo_compare">
                        <img src="{{ asset('assets/img/logo-renessans.png') }} " alt="Ренессанс страхование"
                             class="img_logo_compare">
                        <a href="#"><img src="{{ asset('assets/img/button_orange.png') }} " alt="" class="orange_button2">
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

                            <form action="{{ route('policy_create') }}" method="post" class="jClever" name="form_calc">
                                {{ csrf_field() }}

                                <input name="companyId" id="companyId" type="hidden" />
                                <input name="policeAmount" id="policeAmount" type="hidden" />
                                <input name="policeId" id="policeId" value="0" type="hidden" />

                                <p class="filter_h3">Страны</p>
                                <div>
                                    <input id="msCountries" class="form-control" name="countries[][country_name]"/>
                                    <label></label>
                                </div>

                                <input type="checkbox" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" name="i_am_travelling" id="i_am_travelling"
                                       class="check_and_radio">
                                <label for="i_am_travelling" class="filter_checkbox">Я уже путешествую</label>

                                <br>

                                <input name="dateFrom" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" id="dateFrom" type="text" placeholder="Туда"
                                       class="datepicker-here calendar blue_input_text textbox_49_percent auto-correct"
                                       style="cursor: pointer" readonly/>

                                <input name="dateTill" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" id="dateTill" type="text" placeholder="Обратно"
                                       class="datepicker-here calendar blue_input_text textbox_49_percent auto-correct"
                                       style="cursor: pointer" readonly/>
                                <!--span class="fa fa-calendar"></span-->

                                <input type="checkbox" onchange="chYearPolice('{{route('calcajax')}}', '{{csrf_token()}}')" name="policy_for_year" id="policy_for_year"
                                       class="check_and_radio"><label for="policy_for_year" class="filter_checkbox">Годовой
                                    полис</label>
                                <br>

                                <div class="box-pos123">
                                    <p class="filter_h3">Сколько человек, возраст</p>
                                    <div class="sel-text">
                                        <div>
                                            <input name="travelers[0][accept]" type="checkbox" value="true" id="tr_check_0" class="checkbox-one" checked
                                                   onclick="travelersChange(0, '{{route('calcajax')}}', '{{csrf_token()}}')"><label for="tr_check_0">1 путешественник</label>
                                       <span>
                                       <select name="travelers[0][age]" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" class="age-human"
                                               id="tr0" value=""></select>
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


                               <p class="filter_h3">Выбор курса</p>
                                <input type="radio" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" name="policy_currency" value="EUR" id="radio_euro" class="check_and_radio" checked onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')">
                                <label for="radio_euro" style="margin-right: 20px;">Евро</label>
                                <input type="radio" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" name="policy_currency" value="USD" id="radio_usd" class="check_and_radio" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')">
                                <label for="radio_usd" style="margin-right: 20px;">Доллар</label>

                                <p class="filter_h3" style="margin-top: 10px;">Медицинское страхование</p>
                                <div class="medical_amount">
                                    <input name="risks[0][accept]" value="true"   hidden/>
                                    <input name="risks[0][name]"  value="medical" hidden/>
                                    <input type="radio" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" name="risks[0][risk_amount]" value="30000" id="radio_medical_amount_30000" class="check_and_radio" ><label for="radio_medical_amount_30000" style="margin-right: 20px;">30&nbsp;000&nbsp;<p class="currency_symbol">&#8364;</p></label>
                                    <input type="radio" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" name="risks[0][risk_amount]" value="35000" id="radio_medical_amount_35000" class="check_and_radio" ><label for="radio_medical_amount_35000" style="margin-right: 20px;">35&nbsp;000&nbsp;<p class="currency_symbol">&#8364;</p></label>
                                    <input type="radio" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" name="risks[0][risk_amount]" value="40000" id="radio_medical_amount_40000" class="check_and_radio" ><label for="radio_medical_amount_40000" style="margin-right: 20px;">40&nbsp;000&nbsp;<p class="currency_symbol">&#8364;</p></label><br>
                                    <input type="radio" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" name="risks[0][risk_amount]" value="50000" id="radio_medical_amount_50000" class="check_and_radio" checked><label for="radio_medical_amount_50000" style="margin-right: 20px;">50&nbsp;000&nbsp;<p class="currency_symbol">&#8364;</p></label>
                                    <input type="radio" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" name="risks[0][risk_amount]" value="100000" id="radio_medical_amount_100000" class="check_and_radio" ><label for="radio_medical_amount_100000">100&nbsp;000&nbsp;<p class="currency_symbol">&#8364;</p></label><br>
                                </div>

                                <a id="toggle_insurance"><p class="filter_h3 blue inlined">Входит в страховку </p><span
                                            class="blue glyphicon glyphicon-chevron-down"
                                            style="margin-bottom: 20px !important;"></span></a>
                                <div id="toggle_insurance_list">
                                    <img src="{{ asset('assets/img/checked_green.png') }} ">
                                    <p class="inlined padded"> Вызов врача по медицинским показаниям</p><br>
                                    <img src="{{ asset('assets/img/checked_green.png') }} ">
                                    <p class="inlined padded"> Амбулаторное лечение</p><br>
                                    <img src="{{ asset('assets/img/checked_green.png') }} ">
                                    <p class="inlined padded"> Пребывание и лечение в больнице</p><br>
                                    <img src="{{ asset('assets/img/checked_green.png') }} ">
                                    <p class="inlined padded"> Транспортировка к врачу или в больницу</p><br>
                                    <img src="{{ asset('assets/img/checked_green.png') }} ">
                                    <p class="inlined padded"> Медицинская транспортировка из-за границы</p><br>
                                    <img src="{{ asset('assets/img/checked_green.png') }} ">
                                    <p class="inlined padded"> Возмещение расходов за лекарства по рецепту</p><br>
                                    <img src="{{ asset('assets/img/checked_green.png') }} ">
                                    <p class="inlined padded"> Возмещение расходов за телефонные переговоры с сервисным
                                        центром</p><br>
                                    <img src="{{ asset('assets/img/checked_green.png') }} ">
                                    <p class="inlined padded"> Репатриация в случае смерти</p><br>
                                </div>
                                <br>

                                <a id="toggle_additional"><p class="filter_h3 blue inlined">Дополнительно </p><span
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

                                <input name="additionalConditions[0][name]"  value="leisure" hidden/>
                                <input type="checkbox" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" name="additionalConditions[0][accept]" id="additionalConditions0"
                                       class="check_and_radio" value="false"><label for="additionalConditions[0][accept]" class="inlined padded">Занятие спортом и активный отдых</label>

                                <input id="msActiveMain" class="form-control" name="activeMain[]"/>
                                <input id="msActiveOther" class="form-control" name="activeOther[]"/>
                                <br>

                                <input name="additionalConditions[1][name]"  value="competition" hidden/>
                                <input type="checkbox" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" name="additionalConditions[1][accept]" id="additionalConditions1"
                                       class="check_and_radio" value="false"><label for="additionalConditions[1][accept]" class="inlined padded">Занятие проф. спортом и участие в соревнованиях</label>

                                <input id="msProfiMain" class="form-control" name="profiMain[]"/>
                                <input id="msProfiOther" class="form-control" name="profiOther[]"/>
                                <br>

                                <input name="additionalConditions[2][name]"  value="extreme" hidden/>
                                <input type="checkbox" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" name="additionalConditions[2][accept]" id="additionalConditions2"
                                       class="check_and_radio" value="false"><label for="additionalConditions[2][accept]" class="inlined padded">Экстримальные виды спорта</label>
                                <br>
                                <br>

                                <a id="toggle_options"><p class="filter_h3 blue inlined">Дополнительные опции </p><span class="blue glyphicon glyphicon-chevron-down" style="margin-bottom: 20px !important;"></span></a>
                                <div id="toggle_options_list">

                                    <input type="checkbox" name="risks[3][accept]" id="additional_accident" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                           class="check_and_radio"><label for="additional_accident">Страхование от несчастных
                                        случаев</label>
                                    <br>
                                    <div class="margined">
                                        <input name="risks[3][name]"  value="accidient" hidden/>
                                        <p class="margin_bottom5">На все время путешествия</p>
                                        <input type="radio" checked value="1000" name="risks[3][risk_amount]" id="radio_accident_1000" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                               class="check_and_radio" disabled><label for="radio_accident_1000" class="margined_text"
                                                                              style="margin-right: 20px;">1&nbsp;000<p class="currency_symbol">€</p></label>
                                        <input type="radio" value="3000" name="risks[3][risk_amount]" id="radio_accident_3000" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                               class="check_and_radio" disabled><label for="radio_accident_3000" class="margined_text"
                                                                              style="margin-right: 20px;">3&nbsp;000<p class="currency_symbol">€</p></label>
                                        <input type="radio" value="5000" name="risks[3][risk_amount]" id="radio_accident_5000" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                               class="check_and_radio" disabled><label for="radio_accident_5000" class="margined_text"
                                                                              style="margin-right: 20px;">5&nbsp;000<p class="currency_symbol">€</p></label>
                                        <input type="radio" value="10000" name="risks[3][risk_amount]" id="radio_accident_10000"  onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                               class="check_and_radio" disabled><label
                                                for="radio_accident_10000" class="margined_text" style="margin-right: 20px;">10&nbsp;000<p class="currency_symbol">€</p></label>
                                        <br>
                                        <input type="checkbox" name="accident_flight" id="accident_flight"
                                               class="check_and_radio" disabled><label for="accident_flight" class="margined_text">На время
                                            авиаперелета</label>
                                    </div>
                                    <input type="checkbox" name="risks[4][accept]" id="additional_laggage"  onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                           class="check_and_radio"><label for="additional_laggage">Страховка багажа</label>
                                    <div class="margined">
                                        <p class="margin_bottom5">На время перелета</p>
                                        <input name="risks[4][name]"  value="laggage" hidden/>
                                        <input type="radio" value ="500" checked name="risks[4][risk_amount]" id="radio_laggage_500" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                               class="check_and_radio" disabled><label for="radio_laggage_500" class="margined_text"
                                                                              style="margin-right: 20px;">500<p class="currency_symbol">€</p></label>
                                        <input type="radio" value ="1000" name="risks[4][risk_amount]" id="radio_laggage_1000" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                               class="check_and_radio" disabled><label for="radio_laggage_1000" class="margined_text"
                                                                              style="margin-right: 20px;">1&nbsp;000<p class="currency_symbol">€</p></label>
                                        <input type="radio" value ="1500" name="risks[4][risk_amount]" id="radio_laggage_1500" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                               class="check_and_radio" disabled><label for="radio_laggage_1500" class="margined_text"
                                                                              style="margin-right: 20px;">1&nbsp;500<p class="currency_symbol">€</p></label>
                                        <input type="radio" value ="2000" name="risks[4][risk_amount]" id="radio_laggage_2000" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                               class="check_and_radio" disabled><label for="radio_laggage_2000" class="margined_text"
                                                                              style="margin-right: 20px;">2&nbsp;000<p class="currency_symbol">€</p></label>
                                        <br>
                                        <input type="checkbox" name="laggage_time" id="laggage_time"
                                               class="check_and_radio" disabled><label for="laggage_time" class="margined_text">Страхование
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
                                    <input type="checkbox" name="risks[2][accept]" id="additional_cancel" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                           class="check_and_radio"><label for="additional_cancel">Страхование отмены поездки</label>
                                    <br>
                                    <div class="margined">
                                        <p class="margin_bottom5">На время перелета</p>
                                        <input name="risks[2][name]"  value="cancel" hidden/>
                                        <input type="radio" checked value="500" name="risks[2][risk_amount]" id="radio_cancel_500" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                               class="check_and_radio" disabled><label for="radio_cancel_500" class="margined_text"
                                                                              style="margin-right: 10px;">&nbsp;&nbsp;&nbsp;500<p class="currency_symbol">€</p></label>
                                        <input type="radio" value="1000" name="risks[2][risk_amount]" id="radio_cancel_1000" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                               class="check_and_radio" disabled><label for="radio_cancel_1000" class="margined_text"
                                                                              style="margin-right: 10px;">1&nbsp;000<p class="currency_symbol">€</p></label>
                                        <input type="radio" value="1500" name="risks[2][risk_amount]" id="radio_cancel_1500" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                               class="check_and_radio" disabled><label for="radio_cancel_1500" class="margined_text"
                                                                              style="margin-right: 10px;">1&nbsp;500<p class="currency_symbol">€</p></label>
                                        <input type="radio" value="2000" name="risks[2][risk_amount]" id="radio_cancel_2000" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                               class="check_and_radio" disabled><label for="radio_cancel_2000" class="margined_text"
                                                                              style="margin-right: 10px;">2&nbsp;000<p class="currency_symbol">€</p></label>
                                        <input type="radio" value="2500" name="risks[2][risk_amount]" id="radio_cancel_2500" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                               class="check_and_radio" disabled><label for="radio_cancel_2500" class="margined_text"
                                                                               style="margin-right: 10px;">2&nbsp;500<p class="currency_symbol">€</p></label>
                                        <br>
                                        <input type="radio" value="3000" name="risks[2][risk_amount]" id="radio_cancel_3000" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                               class="check_and_radio" disabled><label for="radio_cancel_3000" class="margined_text"
                                                                              style="margin-right: 10px;">3&nbsp;000<p class="currency_symbol">€</p></label>
                                        <input type="radio" value="3500" name="risks[2][risk_amount]" id="radio_cancel_3500" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                               class="check_and_radio" disabled><label for="radio_cancel_3500" class="margined_text"
                                                                              style="margin-right: 10px;">3&nbsp;500<p class="currency_symbol">€</p></label>
                                        <input type="radio" value="4000" name="risks[2][risk_amount]" id="radio_cancel_4000" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                               class="check_and_radio" disabled><label for="radio_cancel_4000" class="margined_text"
                                                                              style="margin-right: 10px;">4&nbsp;000<p class="currency_symbol">€</p></label>
                                        <input type="radio" value="4500" name="risks[2][risk_amount]" id="radio_cancel_4500" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                               class="check_and_radio" disabled><label for="radio_cancel_4500" class="margined_text"
                                                                              style="margin-right: 10px;">4&nbsp;500<p class="currency_symbol">€</p></label>
                                        <input type="radio" value="5000" name="risks[2][risk_amount]" id="radio_cancel_5000" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                               class="check_and_radio" disabled><label for="radio_cancel_5000" class="margined_text"
                                                                               style="margin-right: 10px;">5&nbsp;000<p class="currency_symbol">€</p></label>
                                        <br>
                                        <input type="checkbox" name="cancel_visa" id="cancel_visa" class="check_and_radio" disabled><label
                                                for="cancel_visa" class="margined_text">Страхование риска отказа в
                                            визе</label>
                                        <br>
                                    </div>
                                    <input type="checkbox" name="risks[1][accept]" id="additional_public" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                           class="check_and_radio"><label for="additional2_7">Страхование гражданской
                                        ответственности</label>
                                    <br>
                                    <div class="margined">
                                        <input name="risks[1][name]"  value="public" hidden/>
                                        <input type="radio" name="risks[1][risk_amount]" value="10000" id="radio_civil_responsibility_10000" onclick="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                               class="check_and_radio" disabled><label for="radio_civil_responsibility_10000"
                                                                              class="margined_text" style="margin-right: 20px;">10&nbsp;000<p class="currency_symbol">€</p></label>
                                        <input type="radio" name="risks[1][risk_amount]" value="30000" id="radio_civil_responsibility_30000" onclick="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                               class="check_and_radio" disabled><label for="radio_civil_responsibility_30000"
                                                                              class="margined_text" style="margin-right: 20px;">30&nbsp;000<p class="currency_symbol">€</p></label>
                                        <input type="radio" name="risks[1][risk_amount]" value="50000" id="radio_civil_responsibility_50000" onclick="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')" checked
                                               class="check_and_radio" disabled><label for="radio_civil_responsibility_50000"
                                                                              class="margined_text" style="margin-right: 20px;">50&nbsp;000<p class="currency_symbol">€</p></label>
                                        <br>
                                    </div>
                                    <input type="checkbox" name="additional_pregnancy" id="additional_pregnancy" onchange="chRequest('{{route('calcajax')}}', '{{csrf_token()}}')"
                                           class="check_and_radio"><label for="additional_pregnancy">Страхование на случай осложнения
                                        беременности</label>
                                    <br>
                                    <div class="margined">
                                        <input type="radio" name="pregnancy" id="radio_pregnancy_12" class="check_and_radio" disabled checked><label
                                                for="radio_pregnancy_12" class="margined_text" style="margin-right: 20px;">до 12
                                            недель</label>
                                        <input type="radio" name="pregnancy" id="radio_pregnancy_24" class="check_and_radio" disabled><label
                                                for="radio_pregnancy_24" class="margined_text" style="margin-right: 20px;">до 24
                                            недель</label>
                                        <input type="radio" name="pregnancy" id="radio_pregnancy_31" class="check_and_radio" disabled><label
                                                for="radio_pregnancy_31" class="margined_text">до 31 недели</label>
                                        <br>
                                    </div>
                                    <input type="checkbox" name="additional_options2" id="additional2_9"
                                           class="check_and_radio"><label for="additional2_9">Поездки на личном автомобиле</label>
                                    <br>
                                    <input type="checkbox" name="additional_options2" id="additional2_10"
                                           class="check_and_radio"><label for="additional2_10">Работа с повышенным риском</label>
                                    <!--br>
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
                                    </div-->
                                </div>
                            </form>
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

    <script src="{{ asset('js/calculate.js') }}"></script>
    <script>

        setCalcDefaultData ('{!! $defaultData !!}', '{{ csrf_token() }}');
        updCalc ('{!! $calculation !!}');

    </script>

@stop