@extends('layouts/app')

@section('content')
<div class="container">
    <div class="row form-container">

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="user-data-contaner">
            <div class="user-data-fill">
                <div class="text-center block-flex-hh"><h1>Данные о клиенте</h1></div>
                <div id="insureder">
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <h4>{{$user->user_first_name_en}}</h4>
                        <label>Имя (латинскими)</label>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <h4>{{$user->user_last_name_en}}</h4>
                        <label>Фамилия (латинскими)</label>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <h4>{{$user->user_first_name_ru}}</h4>
                        <label>Имя (русскими)</label>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <h4>{{$user->user_last_name_ru}}</h4>
                        <label>Фамилия (русскими)</label>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h4>{{$user->user_birthdate}}</h4>
                        <label>Дата рождения</label>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h4>{{$user->user_phone}}</h4>
                        <label>Телефон</label>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h4>Email: {{ $user->email }}</h4>
                        <label>Электронная почта</label>
                    </div>
                </div>
                <div class="row">
                    <button class="btn btn-primary" onclick="editProfile()">Редактировать</button>
                </div>
                <a href="{{ route('policies_list') }}" class="btn btn-primary policies-button">Мои полисы</a>
            </div>

            <div class="user-data-empty">
                <form action="{{ route('user_save') }}" method="post" class="" id="form_details" name="form_details">
                    {{ csrf_field() }}

                    <div class="text-center block-flex-hh"><h1>Данные о клиенте</h1></div>
                    <div id="insureder">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <input class="form-control" id="userFirstNameEn" name="userFirstNameEn"
                                   @if($user->user_first_name_en != null)
                                   value="{{$user->user_first_name_en}}"
                                   @endif
                                   required/>
                            <label>Имя (латинскими)</label>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <input class="form-control" id="userLastNameEn" name="userLastNameEn"
                                   @if($user->user_last_name_en != null)
                                   value="{{$user->user_last_name_en}}"
                                   @endif
                                   required/>
                            <label>Фамилия (латинскими)</label>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <input class="form-control" id="userFirstNameRu" name="userFirstNameRu"
                                   @if($user->user_first_name_ru != null)
                                   value="{{$user->user_first_name_ru}}"
                                   @endif
                                   required/>
                            <label>Имя (русскими)</label>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <input class="form-control" id="userLastNameRu" name="userLastNameRu"
                                   @if($user->user_last_name_ru != null)
                                   value="{{$user->user_last_name_ru}}"
                                   @endif
                                   required/>
                            <label>Фамилия (русскими)</label>
                        </div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <input class="form-control" id="userBirthdate" name="userBirthdate" type="text" style="cursor: pointer"/>
                            <label>Дата рождения</label>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <input class="form-control" id="userPassport" name="userPassport"
                                   @if($user->user_passport != null)
                                   value="{{$user->user_passport}}"
                                    @endif
                            />
                            <label>Данные загран паспорта</label>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <input class="form-control" id="userPhone" name="userPhone" type="text" style="cursor: pointer"
                                   @if($user->user_phone != null)
                                   value="{{$user->user_phone}}"
                                   @endif
                                   required/>
                            <label>Телефон</label>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h4>Email: {{ $user->email }}</h4>
                            <label>Электронная почта</label>
                        </div>

                    </div>
                    <div class="row">
                        <button class="btn btn-danger" type="submit">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>

</div>
@endsection

@section('script')

    <script src="{{ asset('js/home.js') }}"></script>
    <script>

        preparePage('{{$user->user_profile_filled}}', '{{$user->user_birthdate}}');

        printToolbar('{{ $toolbar }}');

    </script>

@stop
