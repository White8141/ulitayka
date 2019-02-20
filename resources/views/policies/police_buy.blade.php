@extends('layouts/app')

@section('meta')
    <title>Улитайка - страхование для туристов</title>
@stop

@section('content')

    <div class="container">

        <div class="text-center block-flex-hh">
            <h1>
                Оплата полиса:
            </h1>
        </div>

        <div class="container">

            <div class="police_details">
                <p>Сумма к оплате: {{ $policy->policy_cost }}р.</p>
                <form class="buy-form" method="POST" action="{{ url('/policy/transaction/'.$policy->id) }}">
                    {{ csrf_field() }}
                    <div class="row no-margin-row">
                        <label class="col-4">
                            <input type="radio" name="paymentType" value="PC">
                            <img src="{{asset('/assets/img/payment/e-money.jpg')}}">
                        </label>
                        <label class="col-4">
                            <input type="radio" name="paymentType" value="AC" checked>
                            <img src="{{asset('/assets/img/payment/cards.jpg')}}">
                        </label>
                        <label class="col-4">
                            <input type="radio" name="paymentType" value="MC">
                            <img src="{{asset('/assets/img/payment/mobile.jpg')}}">
                        </label>
                    </div>

                    <!--div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-5">
                        <input class="form-control" id="receiver" name="receiver"
                               pattern="[0-9 ]{3,40}" title="Только  цифры" required
                        />
                        <label>Получатель</label>
                    </div-->
                    <input type="hidden" name="receiver" value="410011166391246">
                    <input type="hidden" name="successURL" value="http://ulitayka/policy/done/{{ $policy->id }}">
                    <input type="hidden" name="quickpay-form" value="donate">
                    <input type="hidden" name="formcomment" value="Оплата стахового полиса">
                    <input type="hidden" name="short-dest" value="Оплата стахового полиса">
                    <input type="hidden" name="label" value="Покупка стахового полиса">
                    <input type="hidden" name="targets" value="Покупка стахового полиса">
                    <input type="hidden" name="sum" value="2.00" data-type="number">
                    <input type="hidden" name="need-fio" value="false">
                    <input type="hidden" name="need-email" value="false">
                    <input type="hidden" name="need-phone" value="false">
                    <input type="hidden" name="need-address" value="false">
                    <div class="row-footer">
                        <input class="btn btn-blue" type="submit" value="Оплатить"></form>
                    </div>
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

    <script src="{{ asset('js/buy.js') }}"></script>
    <script>

    </script>

@stop