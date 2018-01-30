
@extends('app')

@section('meta')
    <title>Улитайка - страхование для туристов</title>
@stop

@section('content')
    <div class="container">

        <div class="content-flex">

            <div class="block-flex-hh">
                <h1>
                    Распечатывать ли полис?
                </h1>
                <hr class="hr-bottom">
            </div>


            <div class="block-flex-2 ">
                <div class="block-flex-2-img">
                    <img src="{{asset('img/pechati.jpg')}}" alt="">
                </div>
                <div class="block-flex-2-text">
                    <p>Если полис необходим для получения визы, его надо распечатать на любом черно-белом или цветном принтере.</p>
                    <p> Иногда полис требуют предъявить пограничные службы. </p>
                    <p>Если у Вас нет возможности распечатать полис, можете показать его на своем мобильном телефоне.</p>
                    <p>Для обращения в сервисную службу страховой компании Вам достаточно знать номер полиса, который мы прислали на указанный мобильный телефон. </p>
                    <p>Полис также всегда хранится в Вашем личном кабинете на нашем сайте.</p>
                    <p>Будьте внимательны и не относитесь с халатность к таким вещам.Если на границе у Вас потребуют предъявить бумажную версию страхового полиса, а его не окажется под рукой, то процесс будет долгим.</p>
                </div>
            </div>
            <p class=" content-text-start">По поводу наличия страховки пограничные службы будут делать запрос, который может затянуться не на один час.</p>

        </div>

    </div>
@stop
