<div class="container">
    <div class="top_info fz16">
        <div class="">
            <a href="/">
                <img src="{{ asset('assets/img/ulitayka-logo.png' )}}" alt="Улитайка" class="logo">
            </a>
        </div>
        <div class="out">
            <div class="parallelogramBanner">
                <p id="top-banner">ТИШЕ ЕДЕШЬ - ДАЛЬШЕ БУДЕШЬ</p>
            </div>
        </div>
        <div class=" call_style">
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
</div>


<header>
    <div class="container">
        <div class="header">
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
                            <li><a href="{{route('ins_moment')}}">Что делать при наступлении страхового
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
                            <li><a href="{{route('ins_info')}}">Информация о страховых компаниях</a>
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
                    <li><a href="{{route('contacts')}}">Контакты</a></li>

                    @guest
                        <li class="last-block"><a href="{{ route ('login') }}" class="lk"><img src="{{ asset('assets/img/lk.png') }}" alt="Личный кабинет"></a></li>
                    @else
                        <li class="last-block">
                            <a>{{ Auth::user()->name }}<span class="glyphicon glyphicon-chevron-down"></span></a>
                            <ul class="submenu">
                                <li><a href="{{route('home')}}">Мои полисы</a>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                                        Выход
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </nav>
        </div>
    </div>
</header>

