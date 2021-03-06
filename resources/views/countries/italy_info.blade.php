@extends('layouts/app')

@section('meta')
    <title>Улитайка - страхование для туристов</title>
@stop

@section('content')
    <div class="container">

        <div class="content-flex">
            <div class="block-flex-hh">
                <h1>Италия</h1>
                <hr class="hr-bottom">
            </div>
            <br>
            <div class="block-flex-1">
                <div class="block-flex-1-text">

                    <p>Потрясающая Италия является мечтой многих туристов. Для оформления страхового полиса достаточно несколько кликов. Чтобы провести отпуск в комфорте, не опасаясь за свою безопасность, заранее оформите страховой медицинский полис.</p>
                    <h3>Зачем нужна страховка в Италию?</h3>
                    <p>Отдых в Италии — не только нежиться на море, любоваться древней архитектурой и пробовать вкуснейшую пиццу. Значительное количество туристов выбирают эту страну, как зону активного отдыха. Сноубординг, горные велосипеды, альпинизм, сплавы на тюбах и популярные горные лыжи — основа спортивного отпуска путешественника в Италии. В связи с этим основные травмы, возможные во время такого тура — переломы, вывихи и смещения.</p>

                </div>
                <div class="block-flex-1-img">
                    <div class="block-img" style="padding-top: 0 !important;"><img src="{{asset('assets/img/italy_1.jpg')}}" alt=""></div>

                </div>
            </div>
            <div class="block-flex-3" style="padding-top: 0 !important;">
                <div class="block-flex-3-text">
                    <p>Чтобы обезопасить себя от лишних затрат, укажите в дополнительных опциях “Занятие спортом и активный отдых”. Дополнительная опция “Страховка от невыезда” поможет возместить средства, если по определенным причинам поездку пришлось отменить.</p>
                </div>
            </div>
            <div class="block-flex-2">
                <div class="block-flex-2-img">
                    <div class="block-img2">
                        <img src="{{asset('assets/img/italy_2.jpg')}}" alt="">
                    </div>
                </div>
                <div class="block-flex-2-text">
                    <p><b>Вероятные причины отмены поездки:</b></p>
                    <ul>
                        <li>Отказ в визе или задержка при ее оформлении</li>
                        <li>Серьезные проблемы со здоровьем</li>
                        <li>Любые события,связанные со смертью родственников</li>
                        <li>Призыв на военную службу</li>
                        <li>Ряд других факторов, которые оговариваются отдельно</li>
                    </ul>

                </div>
            </div>
            <div class="block-flex-3">
                <div class="block-flex-3-text">
                    <p><b>Интересные факты об Италии</b></p>
                    <ul>
                        <li>Угоститься кофе туристу в баре стоит дороже,чем для местного жителя.</li>
                        <li>При совершении покупки в магазине, обязательно сохраните чек. Вас запросто могут остановить охранники и финансовые полицейские, а также влепить штраф.</li>
                        <li>В Италии запрещается находиться на пляже в ночное время. Штраф за это может достигать 1 тысячу евро.</li>
                        <li>Итальянцы невероятно общительны и очень любят туристов.С радостью помогут найти дорогу и расскажут интересные истории.</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
@stop