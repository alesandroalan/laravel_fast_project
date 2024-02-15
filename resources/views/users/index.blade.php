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
                    <div class="d-flex justify-content-start mb-3 mt-3 ml-3">
                    <a href="{{ route('users.create') }}" class="btn btn-info">
                        {{__('adminlte::main.Create')}}
                        </a>
                    </div>
                    <div class="d-flex justify-content-end mb-3 mt-3">
                        {!! Form::open(['method' => 'GET' ,'route' => ['users.index']]) !!}
                        {{ Form::text('filter', $_GET['filter'] ?? '', array('class' => 'form-control','placeholder' => __('adminlte::main.filter'), "autofocus" => "true")) }}
                        {!! Form::close() !!}
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered table-sm table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                				<th>{{__('adminlte::main.name')}}</th>
				<th>{{__('adminlte::main.email')}}</th>
				<th>{{__('adminlte::main.group')}}</th>
				<th>{{__('adminlte::main.created_at')}}</th>

                                <th>{{__('adminlte::main.Edit')}}</th>
                                <th>{{__('adminlte::main.Delete')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)

                                <tr>
                                    <td>{{ $user->id }}</td>
                					<td>{{ $user->name }}</td>
					                <td>{{ $user->email }}</td>
                                    <td>{{ $user->roles()->first()->name ?? '-' }}</td>
                                    <td>{{ $user->created_at->format('d/m/Y H:i:s') }}</td>

                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('users.edit', [$user->id]) }}" class="btn btn-primary btn-xs">{{__('adminlte::main.Edit')}}</a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            {!! Form::open(['method' => 'DELETE', 'name' => 'delete' ,'route' => ['users.destroy', $user->id]]) !!}
                                                {!! Form::submit(__('adminlte::main.Delete'), ['class' => 'btn btn-danger btn-xs']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                    <small>{{__('adminlte::main.Showing')}} {{$users->firstItem() ?? "0"}} {{__('adminlte::main.to')}} {{$users->lastItem() ?? "0"}} {{__('adminlte::main.of')}} {{$users->total() ?? "0"}} {{__('adminlte::main.items')}}</small>
                    </div>
                    {{$users->links()}}
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
