<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--styleSlider-->
    <link rel="stylesheet" href="{{ asset('js/libs/animate/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('js/libs/font-awesome-4.6.3/css/font-awesome.min.css') }}">
    <!--end-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!--script src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


    <link rel="stylesheet" href="{{ asset('css/libs/owl.carousel.css') }}">
    <script src="{{ asset('js/libs/owl.carousel.min.js') }}"></script>

    <!--плагин air date-->
    <link rel="stylesheet" href="{{ asset('js/libs/air-datepicker/dist/css/datepicker.min.css') }}" type="text/css">
    <script src="{{ asset('js/libs/air-datepicker/dist/js/datepicker.min.js') }}"></script>

    <!--плагин magic suggest-->
    <link rel="stylesheet" href="{{ asset('js/libs/magicsuggest/magicsuggest-min.css') }}" type="text/css">
    <script src="{{ asset('js/libs/magicsuggest/magicsuggest-min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">

    @yield('meta')

</head>
<body>

<header>
    <div class="container">
        <div class="header">
            <div class="top_info fz16">
                <div class="">
                    <a href="/">
                        <img src="{{ asset('img/ulitayka-logo.png' )}}" alt="Улитайка" class="logo">
                    </a>
                </div>
                <div class="out">
                    <div class="parallelogramBanner">
                        <p id="top-banner">ТИШЕ ЕДЕШЬ - ДАЛЬШЕ БУДЕШЬ</p>
                    </div>
                </div>
                <div class=" call_style">
                    {{--<a class="callback_us" id="myLnk">--}}
                        {{--<img src="{{ asset('img/top-tel.png') }}" alt="Заказать звонок"><span--}}
                                {{--class="top_call"> Заказать звонок</span>--}}
                    {{--</a>--}}

                    <div id="myModal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>

                            <div class="call_us-block3">
                                <form id="form_validation_call_us">

                                    <ul class="form-style-1 footer-form">
                                        <li>
                                            <input type="text" name="contact_name" id="contact_name" placeholder="Имя"
                                                   class="field-long footer_name">
                                        </li>
                                        <li>
                                            <input type="text" name="contact_tel" id="contact_tel" placeholder="Телефон"
                                                   class="field-long footer_tel">
                                        </li>
                                        <button id="contact_button" type="submit" class="but_type but_sal">Заказать
                                        звонок
                                        </button>
                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div>

                    <a href="tel:88009002010"><p class="top_number">8 (800) 900-20-10</p></a>
                </div>
            </div>

            <nav>
                <ul class="topmenu">
                    <li><a>Электронный полис <span class="glyphicon glyphicon-chevron-down"></span></a>
                        <ul class="submenu">
                            <li><a href="{{route('how_it_works')}}">Как это работает</a>
                            </li>
                            <li><a href="{{route('included_my_insurance')}}">Что входит в мою страховку</a>
                            </li>
                            <li><a href="{{route('what_your_insurance')}}">С какими страховыми компаниями Вы
                                    работаете</a>
                            </li>
                            <li><a href="{{route('what_e_policy')}}">Что такое электронный полис</a>
                            </li>
                            <li><a href="{{route('what_data')}}">Какие данные нужны для покупки полиса</a>
                            </li>
                            <li><a href="{{route('how_get_policy')}}">Как получить полис</a>
                            </li>
                            <li><a href="{{route('whether_print_policy')}}">Распечатывать ли полис</a>
                            </li>
                        </ul>
                    </li>
                    <li><a>Страховой случай <span class="glyphicon glyphicon-chevron-down"></span></a>
                        <ul class="submenu">
                            <li><a href="{{route('insertion_insurance')}}">Что делать при наступлении страхового
                                    случая</a>
                            </li>
                            <li><a href="{{route('how_get_paid')}}">Как получить выплату</a>
                            </li>
                            <li><a href="{{route('how_to_avoid')}}">Как избежать отказа в выплате</a>
                            </li>
                        </ul>
                    </li>
                    <li><a>Путешественникам <span class="glyphicon glyphicon-chevron-down"></span></a>
                        <ul class="submenu">
                            <li><a href="{{route('ins_need')}}">Нужна ли страховка</a>
                            </li>
                            <li><a href="{{route('ins_for_visa')}}">Страховка для визы</a>
                            </li>
                            <li><a href="{{route('shengen')}}">Зона шенген</a>
                            </li>
                            <li><a href="{{route('ins_info')}}"">Информация о страховых компаниях</a>
                            </li>
                            {{--<li><a href="#">Правила страхования</a>--}}
                            {{--</li>--}}
                            <li><a class="submenu-link">Виды тур-страховок <span
                                            class="glyphicon glyphicon-chevron-right"></span></a>
                                <ul class="submenu">
                                    <li><a href="{{route('single_ins')}}">Индивидуальная</a>
                                    </li>
                                    <li><a href="{{route('group_ins')}}">Групповая</a>
                                    </li>
                                    <li><a href="{{route('med_ins')}}">Медицинская</a>
                                    </li>
                                    <li><a href="{{route('comp_ins')}}">Компенсационная</a>
                                    </li>
                                    <li><a href="{{route('abort')}}">От невыезда</a>
                                    </li>
                                    <li><a href="{{route('fransh_ins')}}">Страховка с франшизой</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    {{--<li><a>Способы оплаты <span class="glyphicon glyphicon-chevron-down"></span></a>--}}
                    {{--<ul class="submenu">--}}
                    {{--<li><a href="#">Как оплатить полис</a>--}}
                    {{--</li>--}}
                    {{--<li><a href="#">Берете ли Вы комиссию за оплату</a>--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li><a href="{{route('legend')}}">Легенда</a>--}}
                    {{--</li>--}}
                    <li><a href="{{route('contacts')}}">Контакты</a>
                    </li>
                    {{--<li>--}}
                    {{--<a href="#" class="lk"><img src="{{ asset('img/lk.png') }}" alt="Личный кабинет"> Личный кабинет</a>--}}
                    {{--</li>--}}
                </ul>
            </nav>
            {{--<hr class="orange1">--}}
        </div>
    </div>
</header>

@yield('content')

<footer>
    <div class="container" style="padding: 30px 10px">
        <div class="footer-flex">
            <div class="footer-block1 col-ex footer-link">
                <ul>
                    <li style="color: #fff; list-style-type: none;">
                        МЕНЮ
                    </li>
                    <br>
                    <li>
                        <a href="{{route('what_e_policy')}}">Электронный полис</a>
                    </li>
                    <li>
                        <a href="{{route('insertion_insurance')}}">Страховой случай</a>
                    </li>
                    {{--<li>--}}
                    {{--<a href="#">Путешественникам</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="#">Способы оплаты</a>--}}
                    {{--</li>--}}
                    <li>
                        <a href="{{ route('legend') }}">Легенда</a>
                    </li>
                    <li>
                        <a href="#">Контакты</a>
                    </li>
                </ul>
            </div>
            <div class="footer-block2 footer-link footer-text">
                <ul>
                    <li style="color: #fff; list-style-type: none;">
                        КОНТАКТЫ
                    </li>
                    <br>
                    <li>
                        <a href="tel:88009002010">8 (800) 900-20-10</a>
                    </li>
                    <li>
                        <a href="mailto:example@yandex.ru">example@yandex.ru</a>
                    </li>
                    <li>
                        <p>Санкт-Петербург</p>
                    </li>
                    <li>
                        <p>Комендантский пр. 4а</p>
                    </li>
                    <li>
                        <p>офис 409</p>
                    </li>
                </ul>
            </div>
            <div class="footer-block3">
                {{--<form id="form_validation_footer">--}}
                    {{--<p style="color: #fff; list-style-type: none;">--}}
                        {{--СВЯЗАТЬСЯ С НАМИ--}}
                    {{--</p>--}}
                    {{--<ul class="form-style-1 ">--}}
                        {{--<li>--}}
                            {{--<input type="text" name="contact_name" id="contact_name" placeholder="Имя"--}}
                                   {{--class="field-long footer_name">--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<input type="text" name="contact_tel" id="contact_tel" placeholder="Телефон"--}}
                                   {{--class="field-long footer_tel">--}}
                        {{--</li>--}}
                        {{--<button id="contact_button" type="submit" class="but_type but_sal">Заказать звон�</button>--}}
                    {{--</ul>--}}
                {{--</form>--}}
            </div>
            <div class="footer-block4">
                <p style="font-size: 14px; color: #f0f1f3">Разработка и продвижение</p>
                <a href="https://seosky.su" target="_blank" class="seoskyLogo">
                    <img src="{{asset('img/seosky.png')}}" alt="Разработка и продвижение сайта - SEOSKY">
                </a>
                <div class="social-btns">
                    <a href="http://vk.com/seosky">
                        <div class="vk"><i class="fa fa-vk" aria-hidden="true"></i></div>
                    </a>
                    <a href="http://plus.google.com/+SeoskySu">
                        <div class="google-plus"><i class="fa fa-google-plus" aria-hidden="true"></i></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="{{ asset('js/script.js') }}"></script>

@yield('script')

</body>
</html>