@extends('layouts/app')

@section('meta')
    <title>Улитайка - страхование для туристов</title>
@stop

@section('content')
    <div class="container">

        <div class="content-flex">

            <div class="block-flex-hh">
                <h1> Нужна ли страховка?</h1>
                <hr class="hr-bottom">
            </div>


            <div class="block-flex-2 ">
                <div class="block-flex-2-img">
                    <img src="{{asset('assets/img/insurance_1.jpg')}}" alt="">
                </div>
                <div class="block-flex-2-text">
                    <p>Пакуя чемоданы и мечтая о долгожданном отдыхе, путешественники думают, что оформление визы будет самым сложным этапом.</p>
                    <p>Однако существует предшествующий ему шаг—покупка страховки.</p>
                    <p><b>Все страны, имеющие визовый режим, обязательно прописывают пункт страхования.Вы попросту не сможете получить визу без медицинского полиса путешественника.</b></p>
                    <p>Причем каждая страна оговаривает свою сумму покрытия.Например, США от 50 тысяч евро, а Норвегия от 30 тысяч евро и т.д.</p>
                    <p>Второй, но немаловажный фактор—безопасность.Страны, не имеющие визовый режим, не требуют обязательного страхования.Ни коем случае не задумывайтесь о покупке полиса. В случае возникновения даже самой простой зубной боли, страховка покроет как лечение, так и лекарства.</p>
                </div>
            </div>
            <p ><b>Что покрывает страховой медицинский полис:</b></p>
            <ul class="content-list-pad">
                <li>Вызов врача по медицинским показаниям</li>
                <li>Амбулаторное лечение</li>
                <li>Пребывание и лечение в больнице</li>
                <li>Транспортировка к врачу или в больницу</li>
                <li>Медицинская транспортировка из-за границы</li>
                <li>Возмещение расходов за лекарства по рецепту</li>
                <li>Репатриация в случае смерти</li>
            </ul>

            <p>
                Ориентируясь на вид отдыха, выбирайте индивидуальную страховку.Обязательно указывайте в дополнительных опциях “Занятие спортом и активный отдых”, если собираетесь проводить отдых активно.
            </p>

        </div>

    </div>

@stop