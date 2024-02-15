@extends('adminlte::page')

@section('title', __('adminlte::main.users'))

@section('content_header')
    <h1 class="m-0 text-dark">{{__('adminlte::main.users')}}</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }} <br>
                            @endforeach
                        </div>
                    @endif

                    {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT','autocomplete' => 'off')) }}

                    <div class="mb-3">
                        {{ Form::label('name', __('adminlte::main.Name'), ['class'=>'form-label']) }}
                        {{ Form::text('name', null, array('class' => 'form-control')) }}
                    </div>
                    <div class="mb-3">
                        {{ Form::label('email', __('adminlte::main.Email'), ['class'=>'form-label']) }}
                        {{ Form::text('email', null, array('class' => 'form-control')) }}
                    </div>
                    <div class="mb-3">
                        {{ Form::label('password', __('adminlte::main.Password'), ['class'=>'form-label ']) }}
                        {{ Form::password('password', array('class' => 'form-control','autocomplete' => 'off')) }}
                    </div>
                    <div class="form-group row col-md-6">
                        <label for="roles">Grupo</label>
                        <select name="roles" id="roles" class="form-control js-multiple" style="overflow: auto;">
                            @if(isset($roles) && !empty($roles))
                                @foreach($roles as $r)
                                    <option value="{{$r->id}}" @if($r->id == $selected_role) selected @endif>{{$r->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    {{ Form::submit(__('adminlte::main.Save'), array('class' => 'btn btn-primary')) }}
                    <a href="{{ route('users.index') }}" class="btn btn-default">{{__('adminlte::main.Back')}}</a>

                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        $(document).ready(function () {
            $('.js-multiple').select2();
            $("#all_roles").on('click', function () {
                if($("#all_roles").prop('checked')){
                    $("#roles > option").prop("selected", true);
                }else {
                    $("#roles > option").prop("selected", false);
                }
                $("#roles").trigger("change");
            });
        });

    </script>
@endsection
