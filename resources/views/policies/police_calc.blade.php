@extends('layouts/app')

@section('meta')
    <title>Улитайка - страхование для туристов</title>
@stop

@section('content')

    <div id="calculator" class="container">
        <div class="row no-margin-row">
            <div class="col-12 col-md-6" id="cards">

                <company-card v-for="companyCard in cardArray" :key="companyCard.card" :card-data="companyCard" v-on:issue-policy="issuePolicy"></company-card>

                <p id="disparity_orange_text" v-if="disArray.length">Не соответствует Вашему запросу</p>

                <dis-card v-for="disCard in disArray" :key="disCard.card" :card-data="disCard"></dis-card>

                <br>

                <div class="card row">
                    <img src="assets/img/logo-alpha.png" alt="Альфа страхование" class="img_logo_compare">
                    <img src="assets/img/logo-vsk.png" alt="Вск страхование" class="img_logo_compare">
                    <img src="assets/img/logo-advant.png" alt="Адвант страхование" class="img_logo_compare">
                    <img src="assets/img/logo-liberty.png" alt="Ренессанс страхование" class="img_logo_compare">
                </div>

            </div>

            <div class="filter_wimdow col-12 col-md-6" id="filters">
                <div class="card card_right">
                    <ins-form csrf-token="{{ csrf_token() }}" ref="insForm" v-on:card-update="cardUpdate"></ins-form>
                </div>
            </div>
        </div>
    </div>

    <style type="text/css">#hellopreloader>p{display:none;}#hellopreloader_preload{display: block;position: fixed;z-index: 99999;top: 0;left: 0;width: 100%;height: 100%;min-width: 1000px;background: #6BB9F0 url(http://hello-site.ru//main/images/preloads/oval.svg) center center no-repeat;background-size:165px;}</style>
    <div id="hellopreloader"><div id="hellopreloader_preload"></div><p></p></div>
    <script type="text/javascript">var hellopreloader = document.getElementById("hellopreloader_preload");function fadeOutnojquery(el){el.style.opacity = 1;var interhellopreloader = setInterval(function(){el.style.opacity = el.style.opacity - 0.05;if (el.style.opacity <=0.05){ clearInterval(interhellopreloader);hellopreloader.style.display = "none";}},16);}window.onload = function(){setTimeout(function(){fadeOutnojquery(hellopreloader);},1000);};</script>

@stop

@section('script')

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue/dist/vue.js"></script>
    <script src="{{ asset('js/calculate.js') }}"></script>
    <script>
        fillForm  ('{!! $defaultData !!}');
        fillCards ('{!! $calculation !!}');
    </script>

@stop