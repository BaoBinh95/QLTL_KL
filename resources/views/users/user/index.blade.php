@extends('layouts.app')
@section('title')
    {{ trans('label.title.list_users') }}
@stop
@section('content')
<div class="container">
    <div class="row">
    @include('errors.success')
        @if(Auth::user()->hasRole('admin'))
        <div style="float: right; margin-bottom: 10px; margin-top: 20px;">
            <a class="btn btn-primary" href="{{ route('users.create') }}"  role="button"><i class="fa fa-plus-circle"></i> {{ trans('label.users.add_user') }}
            </a>
        </div>
        @endif
        <table id="table" class="table" style="margin-top: 20px;">
            <thead class="thead-inverse">
              <tr style="background-color: #CA4D4D; color: white;">
                <th>{{ trans('label.users.id') }}</th>
                <th>{{ trans('label.users.name') }}</th>
                <th>{{ trans('label.users.email') }}</th>
                <th>{{ trans('label.users.department') }}</th>
                <th>{{ trans('label.users.role') }}</th>
                @if(Auth::user()->hasRole('admin'))
                <th>{{ trans('label.users.changerole') }}</th>
                <th>{{ trans('label.users.delete') }}</th>
                @endif
              </tr>
            </thead>
            <tbody>
                @foreach($users as $key => $item)
                    <tr>
                        <td>
                            {{ $key + 1 }}
                            <input type='hidden' class="departmentId" value="{{ $item->id_department }}">
                        </td>
                        <td>
                            <a href="{{ action('UserController@show', $item->id) }}">{{ $item['name'] }}
                            </a>
                        </td>
                        <td>{{ $item['email'] }}</td>
                        <td>
                            <a href="#" class="btn" data-toggle="modal" data-target="#show_department" name="showDepartment">{{ $item->department->name }}
                            </a>
                        </td>
                        @if($item->id_role == 1)
                        <td>Admin</td>
                        @elseif($item->id_role == 2)
                        <td>Trưởng Phòng</td>
                        @else
                        <td>Nhân Viên</td>
                        @endif
                        @if(Auth::user()->hasRole('admin'))
                        <td>
                            @if($item->role->name == 'user')
                            {{ Form::open(['method' => 'PUT', 'route' => ['admin.setManager', $item->id]]) }}
                            {{ Form::button('<i class="fa fa-check"></i> ' . trans('label.users.make_manager'), ['type' => 'submit', 'class' => 'btn btn-success']) }}
                            {!! Form::close() !!}
                            @endif
                        </td>
                        <td>
                            @if($item->id_role != 1)
                            {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $item['id']]]) !!}
                            {{ Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> ', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure to delete ?')"]) }}
                            {!! Form::close() !!}
                            @endif
                        </td>
                        @endif
                    </tr>
                @endforeach()
            </tbody>
        </table>
    </div>

    <!-- pagination -->
    <div class="pagination pull-right">
        {!! $users->appends(Request::except('page'))->links() !!}
    </div>
</div>
@include('users.user.show_department');
@stop
