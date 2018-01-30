@extends('app')

@section('meta')
    <title>Улитайка - страхование для туристов</title>
@stop

@section('content')

    <div class="container">

        <div class="text-center block-flex-hh">
            <h1>
                Покупка прошла успешно!
            </h1>
        </div>

        <p class="police_link">Ваш полис в электронном виде: <a href="www.yandex.ru"></a></p>


    </div>

    <!-- HelloPreload http://hello-site.ru/preloader/ -->
    <style type="text/css">#hellopreloader>p{display:none;}#hellopreloader_preload{display: block;position: fixed;z-index: 99999;top: 0;left: 0;width: 100%;height: 100%;min-width: 1000px;background: #6BB9F0 url(http://hello-site.ru//main/images/preloads/oval.svg) center center no-repeat;background-size:165px;}</style>
    <div id="hellopreloader"><div id="hellopreloader_preload"></div><p><a href="http://hello-site.ru">Hello-Site.ru. Бесплатный конструктор сайтов.</a></p></div>
    <script type="text/javascript">var hellopreloader = document.getElementById("hellopreloader_preload");function fadeOutnojquery(el){el.style.opacity = 1;var interhellopreloader = setInterval(function(){el.style.opacity = el.style.opacity - 0.05;if (el.style.opacity <=0.05){ clearInterval(interhellopreloader);hellopreloader.style.display = "none";}},16);}window.onload = function(){setTimeout(function(){fadeOutnojquery(hellopreloader);},1000);};</script>
    <!-- HelloPreload http://hello-site.ru/preloader/ -->

@stop

@section('script')
<script>

    viewDone('{!! $details !!}');

</script>
@stop