<template>
    <div class="container_filters">
        <form action="/getData" method="post" class="jClever" id="form_calc" name="form_calc">

            <input name="companyName"   v-model="companyName"   type="hidden"/>
            <input name="policeAmount"  v-model="policeAmount"  type="hidden"/>
            <input name="policeId"      v-model="policeId"      type="hidden"/>
            <input name="_token"        v-model="csrfToken"     type="hidden"/>

            <p class="filter_h3">Страны</p>
            <input name="countries[][countryName]"              id="countries"  class="form-control"/>

            <input type="checkbox"      v-model="alrdTrvll"     id="alrdTrvll"  class="check-and-radio">
            <label for="alrdTrvll"      class="filter-checkbox">Я уже путешествую</label><br>

            <input name="dateFrom"      v-model="dateFrom"      id="dateFrom"   type="text" placeholder="Туда"
                   class="datepicker-here calendar blue_input_text textbox_49_percent auto-correct"
                   pattern="[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{4}"   title="ДД.ММ.ГГГГ"/>

            <input name="dateTill"      v-model="dateTill"      id="dateTill"   type="text" placeholder="Обратно"
                   class="datepicker-here calendar blue_input_text textbox_49_percent auto-correct"
                   pattern="[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{4}" title="ДД.ММ.ГГГГ"/>

            <input type="checkbox"      v-model="yearPolicy"    id="yearPolicy" class="check-and-radio">
            <label for="yearPolicy"     class="filter-checkbox">Годовой полис</label><br>

            <p class="filter_h3">Сколько человек, возраст</p>
            <div class="sel-text">
                <div v-for="(traveler, index) in travelers" :key="index">
                    <input :name="'travelers[' + index + '][accept]'"   v-model="traveler.accept"       @change="checkTrvl" :id="'trAccept' + index" class="checkbox-one" type="checkbox">
                    <label :for="'trAccept' + index">{{ 1 + index }} путешественник</label>
                    <select :name="'travelers[' + index + '][age]'"     v-model.number="traveler.age"   @change="checkTrvl" v-if="traveler.accept">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            <option>11</option>
                            <option>13</option>
                            <option>14</option>
                            <option>15</option>
                            <option>16</option>
                            <option>17</option>
                            <option>18</option>
                            <option>19</option>
                            <option>20</option>
                            <option>21</option>
                            <option>22</option>
                            <option>23</option>
                            <option>24</option>
                            <option>25</option>
                            <option>26</option>
                            <option>27</option>
                            <option>28</option>
                            <option>29</option>
                            <option>30</option>
                            <option>31</option>
                            <option>32</option>
                            <option>33</option>
                            <option>34</option>
                            <option>35</option>
                            <option>36</option>
                            <option>37</option>
                            <option>38</option>
                            <option>39</option>
                            <option>40</option>
                            <option>41</option>
                            <option>42</option>
                            <option>43</option>
                            <option>44</option>
                            <option>45</option>
                            <option>46</option>
                            <option>47</option>
                            <option>48</option>
                            <option>49</option>
                            <option>50</option>
                            <option>51</option>
                            <option>52</option>
                            <option>53</option>
                            <option>54</option>
                            <option>55</option>
                            <option>56</option>
                            <option>57</option>
                            <option>58</option>
                            <option>59</option>
                            <option>60</option>
                            <option>61</option>
                            <option>62</option>
                            <option>63</option>
                            <option>64</option>
                            <option>65</option>
                            <option>66</option>
                            <option>67</option>
                            <option>68</option>
                            <option>69</option>
                            <option>70</option>
                            <option>71</option>
                            <option>72</option>
                            <option>73</option>
                            <option>74</option>
                            <option>75</option>
                            <option>76</option>
                            <option>77</option>
                            <option>78</option>
                            <option>79</option>
                            <option>80</option>
                            <option>81</option>
                            <option>82</option>
                            <option>83</option>
                            <option>84</option>
                            <option>85</option>
                            <option>86</option>
                            <option>87</option>
                            <option>88</option>
                            <option>89</option>
                            <option>90</option>
                        </select>
                </div>
            </div>

            <p class="filter_h3">Выбор курса</p>
            <input  name="policyСurrency"   v-model="policyСurrency"    value="EUR" id="radioEuro"  @change="updateCost"  class="check-and-radio" type="radio">
            <label  for="radioEuro">Евро</label>
            <input  name="policyСurrency"   v-model="policyСurrency"    value="USD" id="radioUsd"   @change="updateCost"  class="check-and-radio" type="radio">
            <label  for="radioUsd">Доллар</label>

            <p class="filter_h3">Медицинское страхование</p>
            <div class="medical-amount">
                <input  name="risks[0][accept]" value="true"    hidden/>
                <input  name="risks[0][name]"   value="medical" hidden/>
                <input  name="risks[0][riskAmount]" v-model.number="risks[0]['riskAmount']" value="30000" id="medical30000" @change="updateCost"    class="check-and-radio" type="radio">
                <label  for="medical30000">30&nbsp;000 <span v-html="currencySymbol"></span></label>
                <input  name="risks[0][riskAmount]" v-model.number="risks[0]['riskAmount']" value="35000" id="medical35000" @change="updateCost"    class="check-and-radio" type="radio">
                <label  for="medical35000">35&nbsp;000 <span v-html="currencySymbol"></span></label>
                <input  name="risks[0][riskAmount]" v-model.number="risks[0]['riskAmount']" value="40000" id="medical40000" @change="updateCost"    class="check-and-radio" type="radio">
                <label  for="medical40000">40&nbsp;000 <span v-html="currencySymbol"></span></label><br>
                <input  name="risks[0][riskAmount]" v-model.number="risks[0]['riskAmount']" value="50000" id="medical50000" @change="updateCost"    class="check-and-radio" type="radio">
                <label  for="medical50000">50&nbsp;000 <span v-html="currencySymbol"></span></label>
                <input  name="risks[0][riskAmount]" v-model.number="risks[0]['riskAmount']" value="100000" id="medical100000" @change="updateCost"  class="check-and-radio" type="radio">
                <label  for="medical100000">100&nbsp;000 <span v-html="currencySymbol"></span></label>
            </div>

            <a id="toggle_insurance"><p class="filter_h3 blue inlined">Входит в страховку </p><span
                    class="blue glyphicon glyphicon-chevron-down"
                    style="margin-bottom: 20px !important;"></span></a>
            <div id="toggle_insurance_list">
                <img src="assets/img/checked_green.png">
                <p class="inlined padded"> Вызов врача по медицинским показаниям</p><br>
                <img src="assets/img/checked_green.png">
                <p class="inlined padded"> Амбулаторное лечение</p><br>
                <img src="assets/img/checked_green.png">
                <p class="inlined padded"> Пребывание и лечение в больнице</p><br>
                <img src="assets/img/checked_green.png">
                <p class="inlined padded"> Транспортировка к врачу или в больницу</p><br>
                <img src="assets/img/checked_green.png">
                <p class="inlined padded"> Медицинская транспортировка из-за границы</p><br>
                <img src="assets/img/checked_green.png">
                <p class="inlined padded"> Возмещение расходов за лекарства по рецепту</p><br>
                <img src="assets/img/checked_green.png">
                <p class="inlined padded"> Возмещение расходов за телефонные переговоры с сервисным
                    центром</p><br>
                <img src="assets/img/checked_green.png">
                <p class="inlined padded"> Репатриация в случае смерти</p><br>
            </div>
            <br>

            <a id="toggle_additional"><p class="filter_h3 blue inlined">Дополнительно </p><span
                    class="blue glyphicon glyphicon-chevron-down"
                    style="margin-bottom: 20px !important;"></span></a>
            <div id="toggle_additional_list">
                <input type="checkbox" name="additional_options" id="additional_1"
                       class="check-and-radio"><label for="additional_1" class="inlined padded">Экстренная
                стоматология</label>
                <br>
                <input type="checkbox" name="additional_options" id="additional_2"
                       class="check-and-radio"><label for="additional_2" class="inlined padded">Оплата
                проезда до места жительства после лечения в больнице Застрахованного</label>
                <br>
                <input type="checkbox" name="additional_options" id="additional_3"
                       class="check-and-radio"><label for="additional_3" class="inlined padded">Оплата
                проезда до места жительства после лечения в больнице сопровождающего лица
                Застрахованного</label>
                <br>
                <input type="checkbox" name="additional_options" id="additional_4"
                       class="check-and-radio"><label for="additional_4" class="inlined padded">Оплата
                проживания Застрахованного до отъезда после лечения в больнице</label>
                <br>
                <input type="checkbox" name="additional_options" id="additional_5"
                       class="check-and-radio"><label for="additional_5" class="inlined padded">Оплата
                проживания третьего лица в случае чрезвычайной ситуации с Застрахованным</label>
                <br>
                <input type="checkbox" name="additional_options" id="additional_6"
                       class="check-and-radio"><label for="additional_6" class="inlined padded">Оплата
                проезда домой несовершеннолетних детей Застрахованного</label>
                <br>
                <input type="checkbox" name="additional_options" id="additional_7"
                       class="check-and-radio"><label for="additional_7" class="inlined padded">Оплата
                проезда домой в случае внзапной болезни/смерти родственника</label>
                <br>
                <input type="checkbox" name="additional_options" id="additional_8"
                       class="check-and-radio"><label for="additional_8" class="inlined padded">Временное
                возвращение Застрахованного домой</label>
                <br>
                <input type="checkbox" name="additional_options" id="additional_9"
                       class="check-and-radio"><label for="additional_9" class="inlined padded">Помощь в
                результате терактов</label>
                <br>
                <input type="checkbox" name="additional_options" id="additional_10" class="check-and-radio"><label
                    for="additional_10" class="inlined padded">Помощь в результате стихийных действий
                (наводнения, цунами, торнадо и др.)</label>
                <br>
                <input type="checkbox" name="additional_options" id="additional_11" class="check-and-radio"><label
                    for="additional_11" class="inlined padded" style="line-height: 1.5 !important;">Купирование
                обострения хронических заболеваний</label>
                <br>
                <input type="checkbox" name="additional_options" id="additional_12" class="check-and-radio"><label
                    for="additional_12" class="inlined padded">Помощь при солнечных ожогах</label>
                <br>
                <input type="checkbox" name="additional_options" id="additional_13" class="check-and-radio"><label
                    for="additional_13" class="inlined padded" style="margin-top: 5px !important;">Первая
                помощь при онкозаболеваниях</label>
                <br>
                <input type="checkbox" name="additional_options" id="additional_14" class="check-and-radio"><label
                    for="additional_14" class="inlined padded">Купирование аллергических реакций</label>
                <br>
                <input type="checkbox" name="additional_options" id="additional_15" class="check-and-radio"><label
                    for="additional_15" class="inlined padded">Помощь при наличии алкогольного
                опьянения</label>
            </div>

            <p class="filter_h3">Занятия спортом и активный отдых</p>

            <input name="additionalConditions[0][name]"  value="leisure" hidden/>
            <input type="checkbox" onchange="chRequest('/calcajax', 'csrfToken')" name="additionalConditions[0][accept]" id="additionalConditions0"
                   class="check-and-radio" value="false"><label for="additionalConditions[0][accept]" class="inlined padded">Занятие спортом и активный отдых</label>

            <input id="msActiveMain" class="form-control" name="activeMain[]"/>
            <input id="msActiveOther" class="form-control" name="activeOther[]"/>
            <br>

            <input name="additionalConditions[1][name]"  value="competition" hidden/>
            <input type="checkbox" onchange="chRequest('/calcajax', 'csrfToken')" name="additionalConditions[1][accept]" id="additionalConditions1"
                   class="check-and-radio" value="false"><label for="additionalConditions[1][accept]" class="inlined padded">Занятие проф. спортом и участие в соревнованиях</label>

            <input id="msProfiMain" class="form-control" name="profiMain[]"/>
            <input id="msProfiOther" class="form-control" name="profiOther[]"/>
            <br>

            <input name="additionalConditions[2][name]"  value="extreme" hidden/>
            <input type="checkbox" onchange="chRequest('/calcajax', 'csrfToken')" name="additionalConditions[2][accept]" id="additionalConditions2"
                   class="check-and-radio" value="false"><label for="additionalConditions[2][accept]" class="inlined padded">Экстримальные виды спорта</label>
            <br>
            <br>

            <a id="toggle_options"><p class="filter_h3 blue inlined">Дополнительные опции </p><span class="blue glyphicon glyphicon-chevron-down" style="margin-bottom: 20px !important;"></span></a>
            <div id="toggle_options_list">

                <input type="checkbox" name="risks[3][accept]" id="additional_accident" onchange="chRequest('/calcajax', 'csrfToken')"
                       class="check-and-radio"><label for="additional_accident">Страхование от несчастных
                случаев</label>
                <br>
                <div class="margined">
                    <input name="risks[3][name]"  value="accidient" hidden/>
                    <p class="margin_bottom5">На все время путешествия</p>
                    <input type="radio" checked value="1000" name="risks[3][risk_amount]" id="radio_accident_1000" onchange="chRequest('/calcajax', 'csrfToken')"
                           class="check-and-radio" disabled><label for="radio_accident_1000" class="margined_text"
                                                                   style="margin-right: 20px;">1&nbsp;000<p class="currency_symbol">€</p></label>
                    <input type="radio" value="3000" name="risks[3][risk_amount]" id="radio_accident_3000" onchange="chRequest('/calcajax', 'csrfToken')"
                           class="check-and-radio" disabled><label for="radio_accident_3000" class="margined_text"
                                                                   style="margin-right: 20px;">3&nbsp;000<p class="currency_symbol">€</p></label>
                    <input type="radio" value="5000" name="risks[3][risk_amount]" id="radio_accident_5000" onchange="chRequest('/calcajax', 'csrfToken')"
                           class="check-and-radio" disabled><label for="radio_accident_5000" class="margined_text"
                                                                   style="margin-right: 20px;">5&nbsp;000<p class="currency_symbol">€</p></label>
                    <input type="radio" value="10000" name="risks[3][risk_amount]" id="radio_accident_10000"  onchange="chRequest('/calcajax', 'csrfToken')"
                           class="check-and-radio" disabled><label
                        for="radio_accident_10000" class="margined_text" style="margin-right: 20px;">10&nbsp;000<p class="currency_symbol">€</p></label>
                    <br>
                    <input type="checkbox" name="accident_flight" id="accident_flight"
                           class="check-and-radio" disabled><label for="accident_flight" class="margined_text">На время
                    авиаперелета</label>
                </div>
                <input type="checkbox" name="risks[4][accept]" id="additional_laggage"  onchange="chRequest('/calcajax', 'csrfToken')"
                       class="check-and-radio"><label for="additional_laggage">Страховка багажа</label>
                <div class="margined">
                    <p class="margin_bottom5">На время перелета</p>
                    <input name="risks[4][name]"  value="laggage" hidden/>
                    <input type="radio" value ="500" checked name="risks[4][risk_amount]" id="radio_laggage_500" onchange="chRequest('/calcajax', 'csrfToken')"
                           class="check-and-radio" disabled><label for="radio_laggage_500" class="margined_text"
                                                                   style="margin-right: 20px;">500<p class="currency_symbol">€</p></label>
                    <input type="radio" value ="1000" name="risks[4][risk_amount]" id="radio_laggage_1000" onchange="chRequest('/calcajax', 'csrfToken')"
                           class="check-and-radio" disabled><label for="radio_laggage_1000" class="margined_text"
                                                                   style="margin-right: 20px;">1&nbsp;000<p class="currency_symbol">€</p></label>
                    <input type="radio" value ="1500" name="risks[4][risk_amount]" id="radio_laggage_1500" onchange="chRequest('/calcajax', 'csrfToken')"
                           class="check-and-radio" disabled><label for="radio_laggage_1500" class="margined_text"
                                                                   style="margin-right: 20px;">1&nbsp;500<p class="currency_symbol">€</p></label>
                    <input type="radio" value ="2000" name="risks[4][risk_amount]" id="radio_laggage_2000" onchange="chRequest('/calcajax', 'csrfToken')"
                           class="check-and-radio" disabled><label for="radio_laggage_2000" class="margined_text"
                                                                   style="margin-right: 20px;">2&nbsp;000<p class="currency_symbol">€</p></label>
                    <br>
                    <input type="checkbox" name="laggage_time" id="laggage_time"
                           class="check-and-radio" disabled><label for="laggage_time" class="margined_text">Страхование
                    задержки багажа</label>
                    <br>
                </div>
                <input type="checkbox" name="additional_options2" id="additional2_3"
                       class="check-and-radio"><label for="additional2_3">Страхование авиаперелета</label>
                <br>
                <div class="margined">
                    <input type="checkbox" name="flights" id="flights_regular" class="check-and-radio"><label
                        for="flights_regular" class="margined_text">Страхование задержки регулярного
                    рейса</label>
                    <br>
                    <input type="checkbox" name="flights" id="flights_charter" class="check-and-radio"><label
                        for="flights_charter" class="margined_text">Страхование задержки чартерного
                    рейса</label>
                    <br>
                </div>
                <input type="checkbox" name="additional_options2" id="additional2_4"
                       class="check-and-radio"><label for="additional2_4">Страхование потери документов</label>
                <br>
                <input type="checkbox" name="additional_options2" id="additional2_5"
                       class="check-and-radio"><label for="additional2_5">Юридическая помощь</label>
                <br>
                <input type="checkbox" name="risks[2][accept]" id="additional_cancel" onchange="chRequest('/calcajax', 'csrfToken')"
                       class="check-and-radio"><label for="additional_cancel">Страхование отмены поездки</label>
                <br>
                <div class="margined">
                    <p class="margin_bottom5">На время перелета</p>
                    <input name="risks[2][name]"  value="cancel" hidden/>
                    <input type="radio" checked value="500" name="risks[2][risk_amount]" id="radio_cancel_500" onchange="chRequest('/calcajax', 'csrfToken')"
                           class="check-and-radio" disabled><label for="radio_cancel_500" class="margined_text"
                                                                   style="margin-right: 10px;">&nbsp;&nbsp;&nbsp;500<p class="currency_symbol">€</p></label>
                    <input type="radio" value="1000" name="risks[2][risk_amount]" id="radio_cancel_1000" onchange="chRequest('/calcajax', 'csrfToken')"
                           class="check-and-radio" disabled><label for="radio_cancel_1000" class="margined_text"
                                                                   style="margin-right: 10px;">1&nbsp;000<p class="currency_symbol">€</p></label>
                    <input type="radio" value="1500" name="risks[2][risk_amount]" id="radio_cancel_1500" onchange="chRequest('/calcajax', 'csrfToken')"
                           class="check-and-radio" disabled><label for="radio_cancel_1500" class="margined_text"
                                                                   style="margin-right: 10px;">1&nbsp;500<p class="currency_symbol">€</p></label>
                    <input type="radio" value="2000" name="risks[2][risk_amount]" id="radio_cancel_2000" onchange="chRequest('/calcajax', 'csrfToken')"
                           class="check-and-radio" disabled><label for="radio_cancel_2000" class="margined_text"
                                                                   style="margin-right: 10px;">2&nbsp;000<p class="currency_symbol">€</p></label>
                    <input type="radio" value="2500" name="risks[2][risk_amount]" id="radio_cancel_2500" onchange="chRequest('/calcajax', 'csrfToken')"
                           class="check-and-radio" disabled><label for="radio_cancel_2500" class="margined_text"
                                                                   style="margin-right: 10px;">2&nbsp;500<p class="currency_symbol">€</p></label>
                    <br>
                    <input type="radio" value="3000" name="risks[2][risk_amount]" id="radio_cancel_3000" onchange="chRequest('/calcajax', 'csrfToken')"
                           class="check-and-radio" disabled><label for="radio_cancel_3000" class="margined_text"
                                                                   style="margin-right: 10px;">3&nbsp;000<p class="currency_symbol">€</p></label>
                    <input type="radio" value="3500" name="risks[2][risk_amount]" id="radio_cancel_3500" onchange="chRequest('/calcajax', 'csrfToken')"
                           class="check-and-radio" disabled><label for="radio_cancel_3500" class="margined_text"
                                                                   style="margin-right: 10px;">3&nbsp;500<p class="currency_symbol">€</p></label>
                    <input type="radio" value="4000" name="risks[2][risk_amount]" id="radio_cancel_4000" onchange="chRequest('/calcajax', 'csrfToken')"
                           class="check-and-radio" disabled><label for="radio_cancel_4000" class="margined_text"
                                                                   style="margin-right: 10px;">4&nbsp;000<p class="currency_symbol">€</p></label>
                    <input type="radio" value="4500" name="risks[2][risk_amount]" id="radio_cancel_4500" onchange="chRequest('/calcajax', 'csrfToken')"
                           class="check-and-radio" disabled><label for="radio_cancel_4500" class="margined_text"
                                                                   style="margin-right: 10px;">4&nbsp;500<p class="currency_symbol">€</p></label>
                    <input type="radio" value="5000" name="risks[2][risk_amount]" id="radio_cancel_5000" onchange="chRequest('/calcajax', 'csrfToken')"
                           class="check-and-radio" disabled><label for="radio_cancel_5000" class="margined_text"
                                                                   style="margin-right: 10px;">5&nbsp;000<p class="currency_symbol">€</p></label>
                    <br>
                    <input type="checkbox" name="cancel_visa" id="cancel_visa" class="check-and-radio" disabled><label
                        for="cancel_visa" class="margined_text">Страхование риска отказа в
                    визе</label>
                    <br>
                </div>
                <input type="checkbox" name="risks[1][accept]" id="additional_public" onchange="chRequest('/calcajax', 'csrfToken')"
                       class="check-and-radio"><label for="additional2_7">Страхование гражданской
                ответственности</label>
                <br>
                <div class="margined">
                    <input name="risks[1][name]"  value="public" hidden/>
                    <input type="radio" name="risks[1][risk_amount]" value="10000" id="radio_civil_responsibility_10000" onclick="chRequest('/calcajax', 'csrfToken')"
                           class="check-and-radio" disabled><label for="radio_civil_responsibility_10000"
                                                                   class="margined_text" style="margin-right: 20px;">10&nbsp;000<p class="currency_symbol">€</p></label>
                    <input type="radio" name="risks[1][risk_amount]" value="30000" id="radio_civil_responsibility_30000" onclick="chRequest('/calcajax', 'csrfToken')"
                           class="check-and-radio" disabled><label for="radio_civil_responsibility_30000"
                                                                   class="margined_text" style="margin-right: 20px;">30&nbsp;000<p class="currency_symbol">€</p></label>
                    <input type="radio" name="risks[1][risk_amount]" value="50000" id="radio_civil_responsibility_50000" onclick="chRequest('/calcajax', 'csrfToken')" checked
                           class="check-and-radio" disabled><label for="radio_civil_responsibility_50000"
                                                                   class="margined_text" style="margin-right: 20px;">50&nbsp;000<p class="currency_symbol">€</p></label>
                    <br>
                </div>
                <input type="checkbox" name="additional_pregnancy" id="additional_pregnancy" onchange="chRequest('/calcajax', 'csrfToken')"
                       class="check-and-radio"><label for="additional_pregnancy">Страхование на случай осложнения
                беременности</label>
                <br>
                <div class="margined">
                    <input type="radio" name="pregnancy" id="radio_pregnancy_12" class="check-and-radio" disabled checked><label
                        for="radio_pregnancy_12" class="margined_text" style="margin-right: 20px;">до 12
                    недель</label>
                    <input type="radio" name="pregnancy" id="radio_pregnancy_24" class="check-and-radio" disabled><label
                        for="radio_pregnancy_24" class="margined_text" style="margin-right: 20px;">до 24
                    недель</label>
                    <input type="radio" name="pregnancy" id="radio_pregnancy_31" class="check-and-radio" disabled><label
                        for="radio_pregnancy_31" class="margined_text">до 31 недели</label>
                    <br>
                </div>
                <input type="checkbox" name="additional_options2" id="additional2_9"
                       class="check-and-radio"><label for="additional2_9">Поездки на личном автомобиле</label>
                <br>
                <input type="checkbox" name="additional_options2" id="additional2_10"
                       class="check-and-radio"><label for="additional2_10">Работа с повышенным риском</label>
            </div>
        </form>
    </div>
</template>
<style>
form #countries {
    margin-bottom: 10px;
}

form .sel-text label {
    cursor: pointer;
}

form .medical-amount label {
    height: 40px;
}

form .medical-amount label span {
    margin-right: 16px;
}
</style>
<script>
    export default{
        data(){
            return{
                canUpdateCost: false,
                magicSuggest: '',
                companyName: '',
                policeAmount: 0,
                policeId: 0,
                countries: [],
                alrdTrvll: false,
                yearPolicy: false,
                dateFrom: '',
                dateTill: '',
                travelers: [{accept: true, age: 30},
                            {accept: false, age: 0},
                            {accept: false, age: 0},
                            {accept: false, age: 0},
                            {accept: false, age: 0}],
                policyСurrency: 'EUR',
                risks: [{name: 'medical',   accept: true,   riskAmount: 30000},
                        {name: 'public',    accept: false,  riskAmount: 50000},
                        {name: 'cancel',    accept: false,  riskAmount: 500  },
                        {name: 'accidient', accept: false,  riskAmount: 1000 },
                        {name: 'laggage',   accept: false,  riskAmount: 500  }]
            }
        },
        props: ['csrfToken'],
        mounted () {
            // календарь  Date From
            $('#dateFrom').datepicker({
                minDate: new Date(),
                dateFormat: 'dd.mm.yyyy',
                keyboardNav: 'false',
                autoClose: 'true',
                onSelect: this.onDateFromSelect
            });

            // календарь  Date Till
            $('#dateTill').datepicker({
                minDate: new Date(),
                dateFormat: 'dd.mm.yyyy',
                keyboardNav: 'false',
                autoClose: 'true',
                onSelect: this.onDateTillSelect,
                onHide: this.onDateTillHide
            });

            //подготовить массив с странами, доступными для страхования
            $.getJSON('/js/json/country.json', this.prepareCountries);

            console.log ('Form Mounted');
        },
        computed: {
            currencySymbol: function () {
                switch (this.policyСurrency) {
                    case 'EUR':
                        return '&#8364';
                        break;
                    case 'USD':
                        return '$';
                        break;
                }
            }
        },
        methods: {
            prepareCountries: function (data) {
                var tempArray = [];
                $.each(data, function(key, val) {
                    tempArray.push({countryName: key, countryViewName: val});
                });
                //активация плагина для выпадающего списка стран
                this.magicSuggest = $('#countries').magicSuggest({
                    data: tempArray,
                    placeholder: 'Страна поездки',
                    valueField: 'countryName',
                    displayField: 'countryViewName',
                    maxSelection: 10,
                    expandOnFocus: true,
                    hideTrigger: true
                });
                //при закрытии окна обновлять список выбранных стран и слать на перерасчет цены
                $(this.magicSuggest).on('collapse', this.updateCountry);

                //если к этому моменту уже есть массив стран, занести данные в выпадающий список
                var countryArray = this.countries;
                var tempArray = countryArray.map(function(country) {
                    return country['countryName'];
                });
                this.magicSuggest.setValue(tempArray);
                console.log ('Список стран подготовлен');
            },
            //обновить список выбранных стран и отправить на перерасчет цены
            updateCountry: function () {
                var tempArray = this.magicSuggest.getValue();
                this.countries = [];
                for (var i=0; i< tempArray.length; i++) {
                    this.countries.push({countryName: tempArray[i]});
                }
                if (i > 0) {
                    this.updateCost();
                }
            },
            onDateFromSelect: function (fd, date, inst) {
                if (document.querySelector('#dateFrom').value != '') {
                    this.dateFrom = document.querySelector('#dateFrom').value;

                    //в дате окончания поездки установить ограничение (не раньше начала поездки)
                    var tempArray = document.querySelector('#dateFrom').value.split('.');
                    var tempFrom = new Date(+tempArray[2], +tempArray[1] - 1, +tempArray[0]);
                    $('#dateTill').datepicker().data('datepicker').update('minDate', tempFrom);

                    //если последняя дата установленна раньше первой, удаляем ее
                    if (document.querySelector('#dateTill').value) {
                        tempArray = document.querySelector('#dateTill').value.split('.');
                        var tempTill = new Date(+tempArray[2], +tempArray[1] - 1, +tempArray[0]);
                        if (tempFrom - tempTill > 0) {
                            this.dateTill = '';
                            $('#dateTill').datepicker().data('datepicker').clear();
                            $('#dateTill').datepicker().data('datepicker').show();
                        } else {
                            this.updateCost();
                        }
                    } else {
                        $('#dateTill').datepicker().data('datepicker').show();
                    }
                }
            },
            onDateTillSelect: function (fd, date, inst) {
                if (document.querySelector('#dateTill').value != '') {
                    this.dateTill = document.querySelector('#dateTill').value;
                    this.updateCost();
                    //$('#dateTill').datepicker().data('datepicker').hide();
                }
            },
            onDateTillHide: function (fd, date, inst) {
                //если пользователь не выбрал дату окончания, берется на неделю вперед начальой (если не выбрана, то текущей)
                if (document.querySelector('#dateTill').value == '' && document.querySelectorAll('#dateTill.auto-correct').length > 0) {
                    if (document.querySelector('#dateFrom').value != '') {
                        var tempArray = document.querySelector('#dateFrom').value.split('.');
                        var tempDate = new Date(+tempArray[2], +tempArray[1] - 1, +tempArray[0] + 7);
                    } else {
                        var tempDate = new Date();
                        tempDate.setDate(tempDate.getDate() + 7);
                    }
                    $('#dateTill').datepicker().data('datepicker').selectDate(tempDate);
                }
            },
            checkTrvl: function () {
                if (!this.travelers.some(function(traveler) {
                        return (traveler.accept == true && traveler.age == 0)
                    })) {
                        this.updateCost();
                    }
            },
            //заполнить форму данными, присланными с предыдущей страницы
            fillForm: function (insData) {
                //заполнить страны, выбранные для страхования
                var tempArray = insData['countries'];
                for (var i=0; i< tempArray.length; i++) {
                    this.countries.push(tempArray[i]);
                };

                //заполнить даты начала поездки
                var myDatepicker = $('#dateFrom').datepicker().data('datepicker');
                if (insData['dateFrom'] == null || insData['dateFrom'] == '') {
                    myDatepicker.selectDate(new Date());
                } else {
                    var tempDate = insData['dateFrom'];
                    myDatepicker.selectDate(new Date(+tempDate.substr(6, 4), +tempDate.substr(3, 2) - 1, +tempDate.substr(0, 2)));
                }
                //и конца поездки
                myDatepicker = $('#dateTill').datepicker().data('datepicker');
                if (insData['dateTill'] == null || insData['dateTill'] == '') {
                    var tempFrom = insData['dateFrom'];
                    var tempDate = new Date(new Date(+tempFrom.substr(6, 4), +tempFrom.substr(3, 2) -1, +tempFrom.substr(0, 2)));
                    tempDate.setDate(tempDate.getDate() + 7);
                    myDatepicker.selectDate(tempDate);
                } else {
                    tempDate = insData['dateTill'];
                    myDatepicker.selectDate(new Date(+tempDate.substr(6, 4), +tempDate.substr(3, 2) - 1, +tempDate.substr(0, 2)));
                }

                this.travelers = insData['travelers'];
                this.canUpdateCost = true;
                //debugger;
            },
            updateCost: function () {
                if (this.canUpdateCost) {
                    axios.post('/calcajax', {
                        countries: this.countries,
                        dateFrom: this.dateFrom,
                        dateTill: this.dateTill,
                        travelers: this.travelers,
                        policyСurrency: this.policyСurrency,
                        risks: this.risks
                    })
                    .then(this.sendNewCost)
                    .catch(function (error) {
                        console.log(error);
                    });
                    console.log ('cost update');
                } else {
                    console.log ('dont need update cost');
                }

            },
            sendNewCost: function (response) {
                this.$emit('card-update', response.data);
                //console.log(response.data);
            },
            sendForm: function() {
                document.forms.form_calc.submit();
            }
        }
    }
</script>
