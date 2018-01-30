@extends('app')

@section('meta')
    <title>Улитайка - страхование для туристов</title>
@stop

@section('content')
    <div class="container">

        <div class="content-flex">

            <div class="block-flex-hh">
                <h1>Компенсационная</h1>
                <hr class="hr-bottom">
            </div>


            <div class="block-flex-2 ">
                <div class="block-flex-2-img">
                    <img src="{{asset('img/copm_1.jpg')}}" alt="">
                </div>
                <div class="block-flex-2-text">
                    <p>Компенсационный вид страховки предполагает, что  после наступления страхового случая турист самостоятельно оплачивает все расходы</p>
                    <p>(на лечение,транспортировку,лекарства,связь и пр), а по возвращению на родину, страховая компания возвращает все потраченные финансы, но только после предъявления чеков,документов и актов.</p>
                    <p>Такой вид страховки оформляется не так часто, как его противоположный—сервисный.</p>
                    <p>Это обусловлено тем, что не всегда под рукой есть нужное количество средств, чтобы оплатить все расходы.</p>
                    <p>А также не всегда можно быть уверенным в том, что страховая выплатит всю потраченную сумму.</p>
                </div>
            </div>

            <p class="content-list content-text-start ">В свою очередь сервисный вид полиса оказывает следующие услуги:</p>
            <ul class="content-text-start ">
                <li>медицинскую эвакуацию</li>
                <li>репатриация</li>
                <li>репатриация останков в случае смерти</li>
                <li>сопровождение несовершеннолетних</li>
                <li>помощь при потере багажа или документов</li>
                <li>оплату стоматологической помощи по мере серьезности проблемы</li>
            </ul>

        </div>

    </div>

@stop