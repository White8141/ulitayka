@extends('app')

@section('meta')
    <title>Улитайка - страхование для туристов</title>
@stop

@section('content')

<div class="container">

    <div class="text-center block-flex-hh">
        <h1>
            Детали полиса:
        </h1>
    </div>

    <div class="container">

            <div class="police_details">
                <form action="{{ route('police_buy') }}" method="post" class="" id="form_done" name="form_done">
                    {{ csrf_field() }}

                    <input name="companyId"  id="companyId"  type="hidden" value="{{ $companyId }}"/>
                    <input name="companyURL" id="companyURL" type="hidden" value="{{ $companyURL }}"/>

                    <!--p class="filter_h3">Страховая компания</p-->
                    <img src="{{ asset($companyURL) }}" alt="" class="center-block">

                    <!--select onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')" id="page-country" class="form-control blue_input_text textbox_100_percent"
                            name="countries[0]" style="cursor: pointer">
                    </select><label for="page-country"></label-->
                    <div>
                        <label>Страны</label>
                        <input id="msCountries" class="form-control" name="countries[]"/>
                    </div>

                    <input type="checkbox" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')" name="i_am_travelling" id="i_am_travelling"
                           class="check_and_radio"><label for="i_am_travelling" class="filter_checkbox">Я уже
                        путешествую</label>
                    <!--a href="#" onclick="addCountry()"><label class="add_country">Добавить страну</label><span
                                class="blue add_country glyphicon glyphicon-plus" id="icon_plus"></span></a-->
                    <br>


                        <input name="dateFrom" onblur="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')" id="dateFrom" type="text" placeholder="Туда"
                               class="datepicker-here calendar blue_input_text textbox_49_percent auto-correct"
                               data-multiple-dates="1" data-date-format="yyyy-mm-dd" data-multiple-dates-separator=", "
                               style="cursor: pointer" readonly/>

                        <input name="dateTill" onblur="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')" id="dateTill" type="text" placeholder="Обратно"
                               class="datepicker-here calendar blue_input_text textbox_49_percent auto-correct"
                               data-multiple-dates="1" data-date-format="yyyy-mm-dd" data-multiple-dates-separator=", "
                               style="cursor: pointer" readonly/>



                    <!--span class="fa fa-calendar"></span-->

                    <input type="checkbox" onchange="chYearPolice('{{route('calcajax')}}', '{{csrf_token()}}')" name="policy_for_year" id="policy_for_year"
                           class="check_and_radio"><label for="policy_for_year" class="filter_checkbox">Годовой
                        полис</label>
                    <br>

                        <div class="text-center block-flex-hh"><h1>Данные о страхователе</h1></div>
                        <div id="insureder">
                            <div>Страхователь</div>
                            <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                <input class="form-control" id="insurederFirstName" name="insureder[firstName]" required/>
                                <label>Имя (латинскими)</label>
                            </div>
                            <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                <input class="form-control" id="insurederLastName" name="insureder[lastName]" required/>
                                <label>Фамилия (латинскими)</label>
                            </div>
                            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <!--input class="form-control" name="insureder[birthDate]" placeholder="ГГГГ-ММ-ДД" required/-->
                                <input name="insureder[birthDate]" type="text" id="insurederBirthDate"
                                       class="form-control datepicker-here"
                                       data-date-format="yyyy-mm-dd" style="cursor: pointer"/>
                                <label>Дата рождения</label>
                            </div>
                            <hr>
                        </div>


                        <div class="text-center block-flex-hh"><h1>Данные о застрахованных</h1></div>

                    <div id="traveler0">
                        <div>Путешественник 1</div>
                        <input id="trAccept0" name="travelers[0][accept]" value="true" type="hidden"/>
                        <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-5">
                            <input class="form-control" name="travelers[0][firstName]" required/>
                            <label>Имя (латинскими)</label>
                        </div>
                        <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-5">
                            <input class="form-control" name="travelers[0][lastName]" required/>
                            <label>Фамилия (латинскими)</label>
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <!--input class="form-control" name="travelers[0][birthDate]" placeholder="ГГГГ-ММ-ДД" required/-->
                            <input id="trBirthDate0" name="travelers[0][birthDate]" class="form-control"
                                    data-date-format="yyyy-mm-dd" style="cursor: pointer"/>
                            <label>Дата рождения</label>
                        </div>
                        <input name="travelers[0][age]" id="trAge0" type="hidden"/>
                        <hr>
                    </div>

                    <div id="traveler1" style="display:none">
                        <div>Путешественник 2</div>
                        <input     id="trAccept1"    name="travelers[1][accept]"    value="false" type="hidden"/>
                        <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-5">
                            <input id="trFirstName1" name="travelers[1][firstName]" class="form-control" required disabled/>
                            <label>Имя (латинскими)</label>
                        </div>
                        <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-5">
                            <input id="trLastName1"  name="travelers[1][lastName]"  class="form-control" required disabled/>
                            <label>Фамилия (латинскими)</label>
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <input id="trBirthDate1" name="travelers[1][birthDate]" class="form-control"
                                   data-date-format="yyyy-mm-dd" style="cursor: pointer"/>
                            <label>Дата рождения</label>
                        </div>
                        <input name="travelers[1][age]" id="trAge1" type="hidden"/>
                        <hr>
                    </div>

                    <div id="traveler2" style="display:none">
                        <div>Путешественник 3</div>
                        <input     id="trAccept2"    name="travelers[2][accept]"    value="false" type="hidden"/>
                        <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-5">
                            <input id="trFirstName2" name="travelers[2][firstName]" class="form-control" required disabled/>
                            <label>Имя (латинскими)</label>
                        </div>
                        <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-5">
                            <input id="trLastName2"  name="travelers[2][lastName]"  class="form-control" required disabled/>
                            <label>Фамилия (латинскими)</label>
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <input id="trBirthDate2" name="travelers[2][birthDate]" class="form-control"
                                   data-date-format="yyyy-mm-dd" style="cursor: pointer"/>
                            <label>Дата рождения</label>
                        </div>
                        <input name="travelers[2][age]" id="trAge2" type="hidden"/>
                        <hr>
                    </div>

                    <div id="traveler3" style="display:none">
                        <div>Путешественник 4</div>
                        <input     id="trAccept3"    name="travelers[3][accept]"    value="false" type="hidden"/>
                        <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-5">
                            <input id="trFirstName3" name="travelers[3][firstName]" class="form-control" required disabled/>
                            <label>Имя (латинскими)</label>
                        </div>
                        <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-5">
                            <input id="trLastName3"  name="travelers[3][lastName]"  class="form-control" required disabled/>
                            <label>Фамилия (латинскими)</label>
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <input id="trBirthDate3" name="travelers[3][birthDate]" class="form-control"
                                   data-date-format="yyyy-mm-dd" style="cursor: pointer"/>
                            <label>Дата рождения</label>
                        </div>
                        <input name="travelers[3][age]" id="trAge3" type="hidden"/>
                        <hr>
                    </div>

                    <div id="traveler4" style="display:none">
                            <div>Путешественник 5</div>
                            <input     id="trAccept4"    name="travelers[4][accept]"    value="false" type="hidden"/>
                            <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                <input id="trFirstName4" name="travelers[4][firstName]" class="form-control" required disabled/>
                                <label>Имя (латинскими)</label>
                            </div>
                            <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                <input id="trLastName4"  name="travelers[4][lastName]"  class="form-control" required disabled/>
                                <label>Фамилия (латинскими)</label>
                            </div>
                            <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <input id="trBirthDate4" name="travelers[4][birthDate]" class="form-control"
                                       data-date-format="yyyy-mm-dd" style="cursor: pointer"/>
                                <label>Дата рождения</label>
                            </div>
                            <input name="travelers[4][age]" id="trAge4" type="hidden"/>
                            <hr>
                        </div>

                    <div class="details-form footer">
                        
                        <span id="prem" class="prem">Стоимость <b></b>  <span class="fa fa-rub"></span></span>

                        <button id="submitBtn" class="btn btn-danger" type="submit">Купить</button>
                        <!--a id="submitBtn" class="btn btn-danger" onclick="showDone()">Купить</a-->

                    </div>
                </form>

                <div class="text-center block-flex-hh"><h1>Дополнительные данные</h1></div>

                <p class="filter_h3 radio_currency">Выбор курса</p>
                <input type="radio" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')" name="radio_currency" value="EUR" id="radio_euro" class="check_and_radio" checked onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')">
                <label for="radio_euro" style="margin-right: 20px;">Евро</label>
                <input type="radio" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')" name="radio_currency" value="USD" id="radio_dollar" class="check_and_radio" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')">
                <label for="radio_dollar" style="margin-right: 20px;">Доллар</label>

                <p class="filter_h3" style="margin-top: 10px;">Медицинское страхование</p>
                <div class="medical_amount">
                    <input type="radio" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')" name="medical_amount" value="30000" id="radio_medical_amount_30000" class="check_and_radio" ><label for="radio_medical_amount_30000" style="margin-right: 20px;">30&nbsp;000&nbsp;<p class="currency_symbol">&#8364;</p></label>
                    <input type="radio" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')" name="medical_amount" value="35000" id="radio_medical_amount_35000" class="check_and_radio" ><label for="radio_medical_amount_35000" style="margin-right: 20px;">35&nbsp;000&nbsp;<p class="currency_symbol">&#8364;</p></label>
                    <input type="radio" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')" name="medical_amount" value="40000" id="radio_medical_amount_40000" class="check_and_radio" ><label for="radio_medical_amount_40000" style="margin-right: 20px;">40&nbsp;000&nbsp;<p class="currency_symbol">&#8364;</p></label><br>
                    <input type="radio" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')" name="medical_amount" value="50000" id="radio_medical_amount_50000" class="check_and_radio" checked><label for="radio_medical_amount_50000" style="margin-right: 20px;">50&nbsp;000&nbsp;<p class="currency_symbol">&#8364;</p></label>
                    <input type="radio" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')" name="medical_amount" value="100000" id="radio_medical_amount_100000" class="check_and_radio" ><label for="radio_medical_amount_100000">100&nbsp;000&nbsp;<p class="currency_symbol">&#8364;</p></label><br>
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

                <input type="checkbox" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')" name="sport_active" id="sport_active"
                       class="check_and_radio"><label for="additional_6" class="inlined padded">Занятие спортом и активный отдых</label>

                <input id="msActiveMain" class="form-control" name="activeMain[]"/>
                <input id="msActiveOther" class="form-control" name="activeOther[]"/>

                <br>
                <input type="checkbox" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')" name="sport_proffesional" id="sport_proffesional"
                       class="check_and_radio"><label for="additional_6" class="inlined padded">Занятие проф. спортом и участие в соревнованиях</label>
                <input id="msProfiMain" class="form-control" name="profiMain[]"/>
                <input id="msProfiOther" class="form-control" name="profiOther[]"/>

                <br>
                <input type="checkbox" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')" name="sport_extreme" id="sport_extreme"
                       class="check_and_radio"><label for="additional_6" class="inlined padded">Экстримальные виды спорта</label>
                <br>
                <br>

                <a href="" id="toggle_options"><p class="filter_h3 blue inlined">Дополнительные опции </p><span class="blue glyphicon glyphicon-chevron-down" style="margin-bottom: 20px !important;"></span></a>
                <div id="toggle_options_list">

                    <input type="checkbox" name="additional_accident" id="additional_accident" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')"
                           class="check_and_radio"><label for="additional_accident">Страхование от несчастных
                        случаев</label>
                    <br>
                    <div class="margined">
                        <p class="margin_bottom5">На все время путешествия</p>
                        <input type="radio" checked value="1000" name="accident" id="radio_accident_1000" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')"
                               class="check_and_radio" disabled><label for="radio_accident_1000" class="margined_text"
                                                                       style="margin-right: 20px;">1&nbsp;000<p class="currency_symbol">€</p></label>
                        <input type="radio" value="3000" name="accident" id="radio_accident_3000" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')"
                               class="check_and_radio" disabled><label for="radio_accident_3000" class="margined_text"
                                                                       style="margin-right: 20px;">3&nbsp;000<p class="currency_symbol">€</p></label>
                        <input type="radio" value="5000" name="accident" id="radio_accident_5000" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')"
                               class="check_and_radio" disabled><label for="radio_accident_5000" class="margined_text"
                                                                       style="margin-right: 20px;">5&nbsp;000<p class="currency_symbol">€</p></label>
                        <input type="radio" value="10000" name="accident" id="radio_accident_10000"  onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')"
                               class="check_and_radio" disabled><label
                                for="radio_accident_10000" class="margined_text" style="margin-right: 20px;">10&nbsp;000<p class="currency_symbol">€</p></label>
                        <br>
                        <input type="checkbox" name="accident_flight" id="accident_flight"
                               class="check_and_radio" disabled><label for="accident_flight" class="margined_text">На время
                            авиаперелета</label>
                    </div>
                    <input type="checkbox" name="additional_laggage" id="additional_laggage"  onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')"
                           class="check_and_radio"><label for="additional_laggage">Страховка багажа</label>
                    <div class="margined">
                        <p class="margin_bottom5">На время перелета</p>
                        <input type="radio" value ="500" checked name="laggage" id="radio_laggage_500" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')"
                               class="check_and_radio" disabled><label for="radio_laggage_500" class="margined_text"
                                                                       style="margin-right: 20px;">500<p class="currency_symbol">€</p></label>
                        <input type="radio" value ="1000" name="laggage" id="radio_laggage_1000" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')"
                               class="check_and_radio" disabled><label for="radio_laggage_1000" class="margined_text"
                                                                       style="margin-right: 20px;">1&nbsp;000<p class="currency_symbol">€</p></label>
                        <input type="radio" value ="1500" name="laggage" id="radio_laggage_1500" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')"
                               class="check_and_radio" disabled><label for="radio_laggage_1500" class="margined_text"
                                                                       style="margin-right: 20px;">1&nbsp;500<p class="currency_symbol">€</p></label>
                        <input type="radio" value ="2000" name="laggage" id="radio_laggage_2000" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')"
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
                    <input type="checkbox" name="additional_cancel" id="additional_cancel" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')"
                           class="check_and_radio"><label for="additional_cancel">Страхование отмены поездки</label>
                    <br>
                    <div class="margined">
                        <p class="margin_bottom5">На время перелета</p>
                        <input type="radio" checked value="500" name="cancel" id="radio_cancel_500" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')"
                               class="check_and_radio" disabled><label for="radio_cancel_500" class="margined_text"
                                                                       style="margin-right: 20px;">&nbsp;500<p class="currency_symbol">€</p></label>
                        <input type="radio" value="1000" name="cancel" id="radio_cancel_1000" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')"
                               class="check_and_radio" disabled><label for="radio_cancel_1000" class="margined_text"
                                                                       style="margin-right: 20px;">1&nbsp;000<p class="currency_symbol">€</p></label>
                        <input type="radio" value="1500" name="cancel" id="radio_cancel_1500" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')"
                               class="check_and_radio" disabled><label for="radio_cancel_1500" class="margined_text"
                                                                       style="margin-right: 20px;">1&nbsp;500<p class="currency_symbol">€</p></label>
                        <input type="radio" value="2000" name="cancel" id="radio_cancel_2000" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')"
                               class="check_and_radio" disabled><label for="radio_cancel_2000" class="margined_text"
                                                                       style="margin-right: 20px;">2&nbsp;000<p class="currency_symbol">€</p></label>
                        <input type="radio" value="2500" name="cancel" id="radio_cancel_2500" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')"
                               class="check_and_radio" disabled><label for="radio_cancel_2500" class="margined_text">2&nbsp;500</label>
                        <br>
                        <input type="radio" value="3000" name="cancel" id="radio_cancel_3000" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')"
                               class="check_and_radio" disabled><label for="radio_cancel_3000" class="margined_text"
                                                                       style="margin-right: 20px;">3&nbsp;000<p class="currency_symbol">€</p></label>
                        <input type="radio" value="3500" name="cancel" id="radio_cancel_3500" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')"
                               class="check_and_radio" disabled><label for="radio_cancel_3500" class="margined_text"
                                                                       style="margin-right: 20px;">3&nbsp;500<p class="currency_symbol">€</p></label>
                        <input type="radio" value="4000" name="cancel" id="radio_cancel_4000" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')"
                               class="check_and_radio" disabled><label for="radio_cancel_4000" class="margined_text"
                                                                       style="margin-right: 20px;">4&nbsp;000<p class="currency_symbol">€</p></label>
                        <input type="radio" value="4500" name="cancel" id="radio_cancel_4500" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')"
                               class="check_and_radio" disabled><label for="radio_cancel_4500" class="margined_text"
                                                                       style="margin-right: 20px;">4&nbsp;500<p class="currency_symbol">€</p></label>
                        <input type="radio" value="5000" name="cancel" id="radio_cancel_5000" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')"
                               class="check_and_radio" disabled><label for="radio_cancel_5000" class="margined_text">5&nbsp;000<p class="currency_symbol">€</p></label>
                        <br>
                        <input type="checkbox" name="cancel_visa" id="cancel_visa" class="check_and_radio" disabled><label
                                for="cancel_visa" class="margined_text">Страхование риска отказа в
                            визе</label>
                        <br>
                    </div>
                    <input type="checkbox" value="true" name="additional_public" id="additional_public" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')"
                           class="check_and_radio"><label for="additional2_7">Страхование гражданской
                        ответственности</label>
                    <br>
                    <div class="margined">
                        <input type="radio" checked name="civil_responsibility" value="10000" id="radio_civil_responsibility_10000" onclick="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')"
                               class="check_and_radio" disabled><label for="radio_civil_responsibility_10000"
                                                                       class="margined_text" style="margin-right: 20px;">10&nbsp;000<p class="currency_symbol">€</p></label>
                        <input type="radio" name="civil_responsibility" value="30000" id="radio_civil_responsibility_30000" onclick="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')"
                               class="check_and_radio" disabled><label for="radio_civil_responsibility_30000"
                                                                       class="margined_text" style="margin-right: 20px;">30&nbsp;000<p class="currency_symbol">€</p></label>
                        <input type="radio" name="civil_responsibility" value="50000" id="radio_civil_responsibility_50000" onclick="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')"
                               class="check_and_radio" disabled><label for="radio_civil_responsibility_50000"
                                                                       class="margined_text" style="margin-right: 20px;">50&nbsp;000<p class="currency_symbol">€</p></label>
                        <br>
                    </div>
                    <input type="checkbox" name="additional_pregnancy" id="additional_pregnancy" onchange="chDetails('{{route('calcajax')}}', '{{csrf_token()}}')"
                           class="check_and_radio"><label for="additional_pregnancy">Страхование на случай осложнения
                        беременности</label>
                    <br>
                    <div class="margined">
                        <input type="radio" name="pregnancy" id="radio_pregnancy_12" class="check_and_radio"  disabled><label
                                for="radio_pregnancy_12" class="margined_text" style="margin-right: 20px;">до 12
                            недель</label>
                        <input type="radio" name="pregnancy" id="radio_pregnancy_24" class="check_and_radio"  disabled><label
                                for="radio_pregnancy_24" class="margined_text" style="margin-right: 20px;">до 24
                            недель</label>
                        <input type="radio" name="pregnancy" id="radio_pregnancy_31" class="check_and_radio"  disabled><label
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
            </div>

    </div>
</div>

<!-- HelloPreload http://hello-site.ru/preloader/ -->
<style type="text/css">#hellopreloader>p{display:none;}#hellopreloader_preload{display: block;position: fixed;z-index: 99999;top: 0;left: 0;width: 100%;height: 100%;min-width: 1000px;background: #6BB9F0 url(http://hello-site.ru//main/images/preloads/oval.svg) center center no-repeat;background-size:165px;}</style>
<div id="hellopreloader"><div id="hellopreloader_preload"></div><p><a href="http://hello-site.ru">Hello-Site.ru. Бесплатный конструктор сайтов.</a></p></div>
<script type="text/javascript">var hellopreloader = document.getElementById("hellopreloader_preload");function fadeOutnojquery(el){el.style.opacity = 1;var interhellopreloader = setInterval(function(){el.style.opacity = el.style.opacity - 0.05;if (el.style.opacity <=0.05){ clearInterval(interhellopreloader);hellopreloader.style.display = "none";}},16);}window.onload = function(){setTimeout(function(){fadeOutnojquery(hellopreloader);},1000);};</script>
<!-- HelloPreload http://hello-site.ru/preloader/ -->

@stop

@section('script')

<script>
    setDetailsDefaultData ('{!! $defaultData !!}', '{{ csrf_token() }}');
</script>

@stop