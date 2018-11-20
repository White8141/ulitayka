@extends('layouts/app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Мои кабинет</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (count($policies) > 0)
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h5>Мои полисы</h5>
                                <table class="table table-striped task-table policy_table">

                                    <!-- Заголовок таблицы -->
                                    <thead>
                                        <th scope="col">Создан:</th>
                                        <th scope="col">Компания:</th>
                                        <th scope="col">Стоимость:</th>
                                        <th scope="col">Период:</th>
                                        <th scope="col">&nbsp;</th>
                                    </thead>

                                    <!-- Тело таблицы -->
                                    <tbody>
                                    @foreach ($policies as $policy)
                                        <tr scope="row">
                                            <td class="table-text">
                                                <div>{{ $policy->created_at }}</div>
                                            </td>
                                            <td class="table-text">
                                                <a href="{{url('policy/'.$policy->id)}}"><img src="assets/img/logo-{{ $policy->company_id }}.png" alt="" class="center-block"></a>
                                            </td>
                                            <td class="table-text">
                                                <div>{{ $policy->policy_cost }}</div>
                                            </td>
                                            <td class="table-text">
                                                <div>{{ $policy->policy_period_from }}-<br>{{ $policy->policy_period_till }}</div>
                                            </td>
                                            <td>
                                                <form action="{{ url('policy/'.$policy->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <button type="submit" id="delete-task-{{ $policy->id }}" class="btn btn-danger">
                                                        <i class="fa fa-btn fa-trash"></i>Удалить
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('calculate') }}" method="POST">
                        {{ csrf_field() }}

                        <input name="travelers[0][accept]" type="hidden" value="true"/>
                        <input name="travelers[0][age]" type="hidden" value="30"/>
                        <input name="travelers[1][accept]" type="hidden" value="false"/>
                        <input name="travelers[2][accept]" type="hidden" value="false"/>
                        <input name="travelers[3][accept]" type="hidden" value="false"/>
                        <input name="travelers[4][accept]" type="hidden" value="false"/>

                        <button type="submit" class="btn btn-primary">
                            Оформить полис
                        </button>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
