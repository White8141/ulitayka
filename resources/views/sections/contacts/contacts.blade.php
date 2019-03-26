@extends('layouts/app')

@section('meta')
    <title>Улитайка - страхование для туристов</title>
@stop

@section('content')
    <div class="content" style="position: relative; ">
        <div class="container">
            <section class="content">
                {{--<div class="contacts_title out"></div>--}}
                <div class="title1">
                    <h1 class="hh-title">Контакты</h1>
                    <hr>
                </div>
            </section>
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <form action="{{ route('order_create') }}" id="form_validation" method="post">
                        {{ csrf_field() }}

                        <p class="contact_us">Свяжитесь с нами</p>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-box-elem">
                                <input type="text" name="main_name" id="main_name" class="form-control field-long" placeholder="Имя" pattern="[a-zA-Zа-яА-ЯёЁ\s0-9-]{1,20}" title="Любые буквы, цифры, тире. До 20 знаков" required/>
                            </div>

                            <div class="form-box-elem">
                                <input type="text" name="main_tel" id="main_tel" class="form-control field-long" placeholder="Телефон" pattern="[0-9]{5,15}" title="Только цифры, до 15 знаков" required/>
                            </div>

                            <div class="form-box-elem">
                                <input type="email" name="main_email" id="main_email" class="form-control field-long" placeholder="Почта" required/>
                            </div>

                            <div class="form-box-elem">
                                <textarea name="main_comment" id="main_comment" class="form-control field-long field-textarea" placeholder="Ваш комментарий"></textarea>
                            </div>

                            <!--div class="form-box-elem">
                                <div class="g-recaptcha" data-sitekey="6Lc_7ZIUAAAAAIYxvLJWNUoj9GaVf4WDYmDOHYYc"></div>
                            </div-->

                            <!--div class="form-box-elem main-capcha">
                                <input id="main_capcha" class="field-long" type="checkbox" required/>
                                <label class="form-check-label" for="main_capcha">Я не робот</label>
                            </div-->

                            <div class="form-box-elem">
                                <div class="g-recaptcha" data-sitekey="6Lc_7ZIUAAAAAIYxvLJWNUoj9GaVf4WDYmDOHYYc" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
                                <input class="form-control d-none" data-recaptcha="true" data-error="Please complete the Captcha">
                                <div class="help-block with-errors">Please complete the Captcha</div>
                            </div>

                            <div class="form-box-elem">
                                <button id="main_button" type="submit" >Заказать звонок</button>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <div class="wrap_map">
                        <iframe src="https://yandex.by/map-widget/v1/-/CBF5b-GcHB" width="560" height="400" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
@stop

@section('script')

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="{{ asset('js/contacts.js') }}"></script>
    <script>

        printToolbar ('{!! $tooltip !!}');

    </script>

@stop