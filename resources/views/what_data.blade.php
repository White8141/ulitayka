@extends('app')

@section('meta')
    <title>Улитайка - страхование для туристов</title>
@stop

@section('content')
    <div class="container">

        <div class="content-flex">

            <div class="block-flex-hh">
                <h1>
                    Какие данные нужны для покупки полиса?
                </h1>
                <hr class="hr-bottom">
            </div>


            <div class="block-flex-2 ">
                <div class="block-flex-2-img">
                    <img src="{{asset('/img/kakue_dannue.jpg')}}" alt="">
                </div>
                <div class="block-flex-2-text">
                    <p>Казалось бы, чтобы оформить такой серьезный документ потребуется куча различных документов.Совершенно нет.</p>
                    <ul>
                        <li>Имя</li>
                        <li>Фамилия</li>
                        <li>Дата рождения</li>
                    </ul>
                    <p>Указав настоящие данные из личного паспорта, можно оформить страховой полис на Улитайке.</p>
                    <p>Помимо стандартного оформления полиса для себя,у Вас есть возможность сделать страховку для своих близких.Главный критерий—возраст.</p>
                    <p>Вам должно быть больше 18 лет.</p>
                </div>
            </div>
            <p class="content-list">Указав имя,фамилию и возраст, нажимайте на значок поиска и выбирайте страховку, которая будет отвечать всем Вашим потребностям.В правой колонке отмечайте мышкой нужные дополнительные опции и знакомьтесь с информацией по страховому случаю.
            </p>

        </div>

    </div>

@stop