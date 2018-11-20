@extends('layouts/app')

@section('meta')
    <title>Улитайка - страхование для туристов</title>
@stop

@section('content')
    <div class="container">

        <div class="content-flex">

            <div class="block-flex-hh">
                <h1>
                    Что такое электронный полис?
                </h1>
                <hr class="hr-bottom">
            </div>


            <div class="block-flex-2 ">
                <div class="block-flex-2-img">
                    <img src="{{asset('assets/img/polis.jpg')}}" alt="">
                </div>
                <div class="block-flex-2-text">
                    <p>Вы можете не сомневаться в подлинности электронного страхового полиса.</p>
                    <p>Он имеет юридическую силу, подтвержденную печатью, что и бумажный полис.</p>
                    <p>Благодаря услуге полиса онлайн теперь можно не стоять в очередях душных офисов, тратить время на поездки в страховые фирмы.</p>
                    <p>Достаточно заполнить форму на сайте, выбрать полис и скачать его здесь
                    </p>
                    <p>Электронный вид полиса стал неотъемлемой частью жизни любого туриста.</p>
                    <p>Отправляясь в путешествие, не забудьте распечатать его.</p>
                    <p>Также Вы будете иметь образец электронного полиса у себя в личном кабинете и на почте.</p>
                    <p>В современном мире так важно быть на одной волне с прогрессом.</p>
                </div>
            </div>

        </div>

    </div>
@stop