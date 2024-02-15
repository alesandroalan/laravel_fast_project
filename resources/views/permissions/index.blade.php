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
                    <div class="d-flex justify-content-start mb-3 mt-3 ml-3">
                    <a href="{{ route('permissions.create') }}" class="btn btn-info">
                        {{__('adminlte::main.Create')}}
                        </a>
                    </div>
                    <div class="d-flex justify-content-end mb-3 mt-3">
                        {!! Form::open(['method' => 'GET' ,'route' => ['permissions.index']]) !!}
                        {{ Form::text('filter', $_GET['filter'] ?? '', array('class' => 'form-control','placeholder' => __('adminlte::main.filter'), "autofocus" => "true")) }}
                        {!! Form::close() !!}
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered table-sm table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                				<th>{{__('adminlte::main.key')}}</th>
				<th>{{__('adminlte::main.description')}}</th>

                                <th>{{__('adminlte::main.Edit')}}</th>
                                <th>{{__('adminlte::main.Delete')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permissions as $permission)

                                <tr>
                                    <td>{{ $permission->id }}</td>
                					<td>{{ $permission->name }}</td>
					<td>{{ $permission->description }}</td>

                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('permissions.edit', [$permission->id]) }}" class="btn btn-primary btn-xs">{{__('adminlte::main.Edit')}}</a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            {!! Form::open(['method' => 'DELETE', 'name' => 'delete' ,'route' => ['permissions.destroy', $permission->id]]) !!}
                                                {!! Form::submit(__('adminlte::main.Delete'), ['class' => 'btn btn-danger btn-xs']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                    <small>{{__('adminlte::main.Showing')}} {{$permissions->firstItem() ?? "0"}} {{__('adminlte::main.to')}} {{$permissions->lastItem() ?? "0"}} {{__('adminlte::main.of')}} {{$permissions->total() ?? "0"}} {{__('adminlte::main.items')}}</small>
                    </div>
                    {{$permissions->links()}}
                </div>
            </div>
        </div>
    </div>

@stop
@section('js')
    <script>
        $(document).ready(function () {
            $('form[name="delete"]').on('submit',function(e) {

                var r = confirm("{{__('adminlte::main.Are you sure you want to remove this record?')}}");
                if (r == true) {
                    return true;
                } else {
                    e.preventDefault();
                    e.stopPropagation();
                    return false;
                }
            });

        });

    </script>
@endsection
