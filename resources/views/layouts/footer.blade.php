<!--footer class="navbar-fixed-bottom"-->
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
                        <a href="{{route('ins_moment_full')}}">Страховой случай</a>
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
                </ul>
            </div>
            <div class="footer-block2 footer-link footer-text">
                <ul>
                    <li style="color: #fff; list-style-type: none;">
                        <a href="{{ route('contacts') }}">КОНТАКТЫ</a>
                    </li>
                    <br>
                    <li>
                        <a href="tel:79657801000">+7 (965) 780-10-00</a>
                    </li>
                    <li>
                        <a href="tel:79659833534">+7 (965) 983-35-34</a>
                    </li>
                    <li>
                        <p>Email: info@ulitayka.ru</p>
                    </li>
                    <br>
                    <li>
                        <p>Санкт-Петербург</p>
                    </li>
                    <li>
                        <p>Коломяжский пр.20</p>
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
                    <img src="{{asset('assets/img/seosky.png')}}" alt="Разработка и продвижение сайта - SEOSKY">
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