@extends('adminlte::page')

@section('title', __('adminlte::main.groups'))

@section('content_header')
    <h1 class="m-0 text-dark">{{__('adminlte::main.groups')}}</h1>
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

                    {!! Form::open(['route' => 'groups.store']) !!}

                		<div class="mb-3">
			{{ Form::label('name', __('adminlte::main.Name'), ['class'=>'form-label']) }}
			{{ Form::text('name', null, array('class' => 'form-control')) }}
		</div>
                        <div class="form-group col-md-6">
                            <label for="permissions">Permissões</label>
                            <select name="permissions[]" id="permissions" class="form-control js-multiple" multiple="multiple" style="overflow: auto;">
                                @if(isset($permissions) && !empty($permissions))
                                    @foreach($permissions as $p)
                                        <option value="{{$p->id}}">{{$p->description}}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="all_permissions">
                                <label class="form-check-label" for="all_permissions">Todos</label>
                            </div>
                        </div>

                        {{ Form::submit(__('adminlte::main.Create'), array('class' => 'btn btn-primary')) }}
                        <a href="{{ route('groups.index') }}" class="btn btn-default">{{__('adminlte::main.Back')}}</a>

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
            $("#all_permissions").on('click', function () {
                if($("#all_permissions").prop('checked')){
                    $("#permissions > option").prop("selected", true);
                }else {
                    $("#permissions > option").prop("selected", false);
                }
                $("#permissions").trigger("change");
            });
        });

    </script>
@endsection
