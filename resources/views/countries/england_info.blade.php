@extends('layouts/app')

@section('meta')
    <title>Улитайка - страхование для туристов</title>
@stop

@section('content')
    <div class="container">

        <div class="content-flex">
            <div class="block-flex-hh">
                <h1>Англия</h1>
                <hr class="hr-bottom">
            </div>
            <br>
            <div class="block-flex-1">
                <div class="block-flex-1-text">

                    <p>Хмурая Англия не всегда встречает своих гостей туманом и дождем. Она подобна волшебному месту из сказки, где угощают горячим какао и кексами. По закону Великобритания обладает собственным визовым режимом. Поэтому помимо стандартной шенгенской визы, также необходимо получить английскую. Наличие страхового полиса обязательно для въезда на территорию Англии.</p>
                    <h3>Зачем нужна страховка в Англию?</h3>
                    <p>Чтобы застраховать себя от любых рисков, связанных с травмами от спорта, выберете опцию “Активный отдых и занятие спортом”.  Помимо классических вариантов: прогулки на яхте, катание на роликах, скейтборде, в такой медицинский полис войдет защита от травм во время катания на велосипеде, занятий серфингом и даже пеших прогулок.</p>


                </div>
                <div class="block-flex-1-img">
                    <div class="block-img" style="padding-top: 0 !important;"><img src="{{asset('assets/img/england_1.jpg')}}" alt=""></div>

                </div>
            </div>
            <div class="block-flex-3" style="padding-top: 0 !important;">
                <div class="block-flex-3-text">
                    <p>Минимальная сумма покрытия 30 тысяч евро. Важно помнить, что покрытие страховкой хронических заболеваний, предусмотрено дополнительной опцией. Заблаговременно позаботьтесь о каждом пункте Вашего будущего медицинского полиса.</p>
                </div>
            </div>
            <div class="block-flex-2">
                <div class="block-flex-2-img">
                    <div class="block-img2">
                        <img src="{{asset('assets/img/england_2.jpg')}}" alt="">
                    </div>
                </div>
                <div class="block-flex-2-text">
                    <p><b>Интересные факты об Англии:</b></p>
                    <ul>
                        <li>Вход в большинство музеев является бесплатным. Посетитель сам должен решить, сколько готов пожертвовать.</li>
                        <li>Все продуктовые магазины закрываются после 22 часов.</li>
                        <li>В ресторанах Великобритании принято рассчитываться только наличными.</li>
                        <li>Купить даже самые простые лекарства без рецепта не получится.</li>
                    </ul>

                </div>
            </div>

        </div>

    </div>
@stop