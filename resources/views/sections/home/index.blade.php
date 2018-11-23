@extends('layouts/app')

@section('content')
<div class="container">
    <div class="row form-container">

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('user_save') }}" method="post" class="" id="form_details" name="form_details">
            {{ csrf_field() }}

            <div class="text-center block-flex-hh"><h1>Данные о клиенте</h1></div>
            <div id="insureder">
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <input class="form-control" id="userFirstNameEn" name="userFirstNameEn" required/>
                    <label>Имя (латинскими)</label>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <input class="form-control" id="userLastNameEn" name="userLastNameEn" required/>
                    <label>Фамилия (латинскими)</label>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <input class="form-control" id="userFirstNameRu" name="userFirstNameRu" required/>
                    <label>Имя (русскими)</label>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <input class="form-control" id="userLastNameRu" name="userLastNameRu" required/>
                    <label>Фамилия (русскими)</label>
                </div>
                <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <input class="form-control" id="userBirthdate" name="userBirthdate" type="text" style="cursor: pointer"/>
                    <label>Дата рождения</label>
                </div>
                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <input class="form-control" id="insurederLastName" name="userPass"/>
                    <label>Данные загран паспорта</label>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <input class="form-control" id="insurederBirthDate" name="userPhone" type="text" style="cursor: pointer" required/>
                    <label>Телефон</label>
                </div>
                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h4>Email: {{ $user->email }}</h4>
                    <label>Электронная почта</label>
                </div>

            </div>
            <div class="col-12">
                <button class="btn btn-danger" type="submit">Сохранить</button>
            </div>
        </form>
    </div>

    <a href="{{ route('policies_list') }}" class="btn btn-primary policies-button">Мои полисы</a>

</div>
@endsection

@section('script')

    <script src="{{ asset('js/calculate.js') }}"></script>
    <script>

        setCalcDefaultData ('{!! $defaultData !!}', '{{ csrf_token() }}');
        updCalc ('{!! $calculation !!}');

    </script>

@stop
