@extends('adminlte::page')

@section('title', __('adminlte::main.permissions'))

@section('content_header')
    <h1 class="m-0 text-dark">{{__('adminlte::main.permissions')}}</h1>
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

                    {!! Form::open(['route' => 'permissions.store']) !!}

                		<div class="mb-3">
			{{ Form::label('name', __('adminlte::main.Name'), ['class'=>'form-label']) }}
			{{ Form::text('name', null, array('class' => 'form-control')) }}
		</div>
		<div class="mb-3">
			{{ Form::label('description', __('adminlte::main.Description'), ['class'=>'form-label']) }}
			{{ Form::text('description', null, array('class' => 'form-control')) }}
		</div>


                        {{ Form::submit(__('adminlte::main.Create'), array('class' => 'btn btn-primary')) }}
                        <a href="{{ route('permissions.index') }}" class="btn btn-default">{{__('adminlte::main.Back')}}</a>

                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
@stop
