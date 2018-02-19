@extends('app')

@section('meta')
    <title>Улитайка - страхование для туристов</title>
@stop

@section('content')

<div class="container">
    <div class="main">

        <div class="banner">
            <div class="bannerTextBox">
                <span class="slogan bordered_slogan">Время</span>
                <span class="slogan bordered_slogan slogan-marginMin">максимального</span>
                <span class="slogan bordered_slogan slogan-marginMax">страхования</span>
                {{--<p class="bordered_slogan"></p>--}}
            </div>
        </div>

        <div class="formForAirplane">

            <button class="aircraftBox"></button>
            <form action="{{ route('calculate') }}" method="post" class="jClever chooseYourCountry" id="form-1">
                {{ csrf_field() }}
                <div class="form-box">
                    <div class="box-4yo">
                        <select id="page-country" class="sel-text" name="countries[0]" style="cursor: pointer">
                            <option selected value="SCHENGEN" disabled>Страна поездки</option>
                        </select>
                    </div>

                    <div class="box-1">
                        <input name="dateFrom" type="text" placeholder="Туда" id="dateFrom"
                               class="datepicker-here calendar sel-text"
                               data-multiple-dates="1" data-date-format="yyyy-mm-dd"
                               data-multiple-dates-separator=", " style="cursor: pointer" readonly/>
                    </div>
                    <div class="box-1">
                        <input name="dateTill" type="text" placeholder="Обратно" id="dateTill"
                               class="datepicker-here calendar sel-text"
                               data-multiple-dates="1" data-date-format="yyyy-mm-dd"
                               data-multiple-dates-separator=", " style="cursor: pointer" readonly/>
                    </div>

                    <div class="box-3">
                        <div class="box-2" placeholder="Сколько человек, возраст" style="cursor: pointer"></div>
                        <div class="human-drop sel-text">
                            <i class="datepicker--pointer"></i>
                            <div>
                                <input name="travelers[0][accept]" type="checkbox" value="true" id="tr_check_0" checked
                                       class="checkbox-one" onchange="conditions(0);">
                                <label class="label_check-radio" for="tr_check_0">1<sup>й</sup> путешественник</label>
                           <span>
                               <select name="travelers[0][age]" class="age-human" id="tr0"></select>
                       </span>
                            </div>
                            <div>
                                <input name="travelers[1][accept]" type="checkbox" value="true" id="tr_check_1"
                                       class="checkbox-one" onchange="conditions(1)">
                                <label class="label_check-radio" for="tr_check_1">2<sup>й</sup> путешественник</label>
                           <span>
                               <select name="travelers[1][age]" class="age-human" id="tr1" style="display:none"></select>
                        </span>
                            </div>
                            <div>
                                <input name="travelers[2][accept]" type="checkbox" value="true" id="tr_check_2"
                                       class="checkbox-one" onchange="conditions(2)">
                                <label class="label_check-radio" for="tr_check_2">3<sup>й</sup> путешественник</label>
                           <span>
                               <select name="travelers[2][age]" class="age-human" id="tr2" style="display:none"></select>
                        </span>
                            </div>
                            <div>
                                <input name="travelers[3][accept]" type="checkbox" value="true" id="tr_check_3"
                                       class="checkbox-one" onchange="conditions(3)">
                                <label class="label_check-radio" for="tr_check_3">4<sup>й</sup> путешественник</label>
                           <span>
                               <select name="travelers[3][age]" class="age-human" id="tr3" style="display:none"></select>
                        </span>
                            </div>
                            <div>
                                <input name="travelers[4][accept]" type="checkbox" value="true" id="tr_check_4"
                                       class="checkbox-one" onchange="conditions(4)">
                                <label class="label_check-radio" for="tr_check_4">5<sup>й</sup> путешественник</label>
                           <span>
                               <select name="travelers[4][age]" class="age-human" id="tr4" style="display:none"></select>
                        </span>
                            </div>
                        </div>
                    </div>


                </div>
                <button class="magicZoomYo" type="submit"></button>
            </form>

        </div>

        <section class="content">
            <div class="insurance out"></div>
            <div class="title">
                <h1>страховка для выезда за границу</h1>
                <hr>
            </div>

            <div class="boxForContent boxForContentOne">
                <div class="textRow textRowLeft">
                    <div class="textBox">
                        <h3>Улитайка за безопасный отдых</h3>
                        <p>Чтобы рационально спланировать свой отпуск, важно позаботиться обо всех мелочах. В первую
                            очередь необходимо продумать варианты, которые максимально снизят риск вашей
                            безопасности. Страхование от Улитайки станет частью комфортабельного отпуска независимо
                            от вашего направления: визовые или безвизовые страны. Страховой полис — это не просто
                            гарант получения визы. С ним вы можете быть уверены, что из любой экстремальной ситуации
                            вы выйдете здоровым и без максимальных денежных потерь.
                        </p>
                    </div>

                    <div class="textBox">
                        <h3>Улитайка — удобно и практично</h3>
                        <p>На нашем сайте возможно легко подобрать страховой полис, который будет соответствовать
                            индивидуальным параметрам. Благодаря онлайн калькулятору, вам достаточно выбрать страну
                            поездки, дату и количество путешественников. В свою очередь мы подберем оптимальные
                            варианты страховок для вашего отдыха.</p>
                    </div>
                </div>

                <div class="boxForCountries">

                    <div class="viewCountry">
                        <div class="img Norway">
                            <div class="mask">
                                <a href="{{route('norway')}}" class="info">
                                    <h3>Норвегия</h3>
                                    <span>Подробнее</span>
                                    <span> о страховании</span>
                                </a>
                            </div>
                            <div class="nameStickForCountry">
                                <h3>Норвегия</h3>
                            </div>
                        </div>
                    </div>

                    <div class="viewCountry">
                        <div class="img Finland">
                            <div class="mask">
                                <a href="{{route('finland')}}" class="info">
                                    <h3>Финляндия</h3>
                                    <span>Подробнее</span>
                                    <span> о страховании</span>
                                </a>
                            </div>
                            <div class="nameStickForCountry">
                                <h3>Финляндия</h3>
                            </div>
                        </div>
                    </div>
                    <div class="viewCountry">
                        <div class="img Egypt">
                            <div class="mask">
                                <a href="{{route('egypt')}}" class="info">
                                    <h3>египет</h3>
                                    <span>Подробнее</span>
                                    <span> о страховании</span>
                                </a>
                            </div>
                            <div class="nameStickForCountry">
                                <h3>Eгипет</h3>
                            </div>
                        </div>
                    </div>
                    <div class="viewCountry">
                        <div class="img Australia">
                            <div class="mask">
                                <a href="{{route('australia')}}" class="info">
                                    <h3>австралия</h3>
                                    <span>Подробнее</span>
                                    <span> о страховании</span>
                                </a>
                            </div>
                            <div class="nameStickForCountry">
                                <h3>австралия</h3>
                            </div>
                        </div>
                    </div>
                    <div class="viewCountry">
                        <div class="img Italy">
                            <div class="mask">
                                <a href="{{route('italy')}}" class="info">
                                    <h3>Италия</h3>
                                    <span>Подробнее</span>
                                    <span> о страховании</span>
                                </a>
                            </div>
                            <div class="nameStickForCountry">
                                <h3>Италия</h3>
                            </div>
                        </div>
                    </div>
                    <div class="viewCountry">
                        <div class="img England">
                            <div class="mask">
                                <a href="{{route('england')}}" class="info">
                                    <h3>англия</h3>
                                    <span>Подробнее</span>
                                    <span> о страховании</span>
                                </a>
                            </div>
                            <div class="nameStickForCountry">
                                <h3>англия</h3>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>

        <section class="reviews">
            <div class="reviewsBack out"></div>
            <div class="title">
                <h1>Отзывы</h1>
                <hr>
            </div>

            <div class="reviewsSlide">
                <div class="owl-carousel owl-theme">
                    <div class="item">
                        <div class="foto-1">
                            <img src="{{asset('img/user.png')}}" alt="">
                        </div>
                        <h2 class="hd-slider">Настя</h2>
                        <p class="text-slider">
                            До конца не верила, что страховка понадобится, но потом ни разу не пожалела.Во время
                            отпуска подхватила воспаление легких, понадобилось куча лекарств и осмотров врачей, к
                            счастью обошлось без больницы.Страховка покрыла все мои потраченные деньги.
                            ИМХО: не рискуйте своим здоровьем, если не обладаете бессмертием.
                        </p>

                    </div>
                    <div class="item">
                        <div class="foto-1">
                            <img src="{{asset('img/user.png')}}" alt="">
                        </div>
                        <h2 class="hd-slider">Наталья</h2>
                        <p class="text-slider">
                            Считаю, что оформление страховки это личное дело каждого. Если собираетесь ехать с детьми, не экономьте на них уж точно. Дети всегда
                            активны и получить травму для них дело не трудное.А за границей лечение обычной
                            шишки будет дорого (покаталась по миру, испытала это на себе). Последнее путешествие
                            было
                            в Таиланд и оформляла страховку на Улитайке, не пожалела.Спасибо.
                        </p>

                    </div>
                    <div class="item">
                        <div class="foto-1">
                            <img src="{{asset('img/user.png')}}" alt="">
                        </div>
                        <h2 class="hd-slider">Тамара</h2>
                        <p class="text-slider">
                            Выбрали с мужем Улитайку, основываясь чисто на сайт. Приятно смотрелся, много полезной
                            информации и поиск прямо сразу есть. Решили оформить, не прогадали. Поехали кататься на
                            лыжах в Норвегию зимой и взяли страховку от Альфастрахования. Быстро оформили, по
                            деньгам уложились. Приятно, что существует что-то действительно для людей.
                        </p>

                    </div>
                </div>


            </div>
        </section>

        <section class="content">

            <div class="insurance out"></div>
            <div class="title">
                <h1>оформить страховку для выезда за границу онлайн</h1>
                <hr>
            </div>

            <div class="boxForContent boxForContentOne">
                <div class="boxForCountries">
                    <div class="viewCountry">
                        <div class="img Thailand">
                            <div class="mask">
                                <a href="{{route('thailand')}}" class="info">
                                    <h3>Таиланд</h3>
                                    <span>Подробнее</span>
                                    <span> о страховании</span>
                                </a>
                            </div>
                            <div class="nameStickForCountry">
                                <h3>Таиланд</h3>
                            </div>
                        </div>
                    </div>

                    <div class="viewCountry">
                        <div class="img Israel">
                            <div class="mask">
                                <a href="{{route('israel')}}" class="info">
                                    <h3>Израиль</h3>
                                    <span>Подробнее</span>
                                    <span> о страховании</span>
                                </a>
                            </div>
                            <div class="nameStickForCountry">
                                <h3>Израиль</h3>
                            </div>
                        </div>
                    </div>
                    <div class="viewCountry">
                        <div class="img Montenegro">
                            <div class="mask">
                                <a href="{{route('montenegro')}}" class="info">
                                    <h3>Черногория</h3>
                                    <span>Подробнее</span>
                                    <span> о страховании</span>
                                </a>
                            </div>
                            <div class="nameStickForCountry">
                                <h3>Черногория</h3>
                            </div>
                        </div>
                    </div>
                    <div class="viewCountry">
                        <div class="img Georgia">
                            <div class="mask">
                                <a href="{{route('georgia')}}" class="info">
                                    <h3>Грузия</h3>
                                    <span>Подробнее</span>
                                    <span> о страховании</span>
                                </a>
                            </div>
                            <div class="nameStickForCountry">
                                <h3>Грузия</h3>
                            </div>
                        </div>
                    </div>
                    <div class="viewCountry">
                        <div class="img Germany">
                            <div class="mask">
                                <a href="{{route('germany')}}" class="info">
                                    <h3>Германия</h3>
                                    <span>Подробнее</span>
                                    <span> о страховании</span>
                                </a>
                            </div>
                            <div class="nameStickForCountry">
                                <h3>Германия</h3>
                            </div>
                        </div>
                    </div>
                    <div class="viewCountry">
                        <div class="img USA">
                            <div class="mask">
                                <a href="{{route('usa')}}" class="info">
                                    <h3>США</h3>
                                    <span>Подробнее</span>
                                    <span> о страховании</span>
                                </a>
                            </div>
                            <div class="nameStickForCountry">
                                <h3>США</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="textRow textRowLeft">
                    <div class="textBox">
                        <h3>Крепкое сотрудничество</h3>
                        <p>Наш ресурс предоставляет возможность получить варианты полиса сразу от нескольких
                            страховых. Эрго, Альфастрахование, Адвант — проверенные партнеры Улитайки. Учитывая
                            мельчайшие детали, они предлагают только лучшие индивидуальные варианты, которые в разы
                            экономят деньги, время и нервы.
                        </p>
                    </div>

                    <div class="textBox">
                        <h3>Отдых без границ</h3>
                        <p>С полисом страхования от Улитайки вы можете быть уверены в том, что:</p>
                        <ul>
                            <li>Оформление займет несколько минут</li>
                            <li>Ваша страховка покроет траты на лечение, лекарства, транспорт</li>
                            <li>Вы не переплатите за ненужные навязанные услуги</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@stop

@section('script')

<script>

    welcomeCountryParse();

</script>

@stop