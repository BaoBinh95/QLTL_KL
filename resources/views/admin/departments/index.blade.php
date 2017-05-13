@extends('layouts.app')
@section('title')
    {{ trans('label.title.list_department') }}
@stop
@section('content')
<div class="container">
    <div class="row">
        @include('errors.success')
            @if(Auth::user()->hasRole('admin'))
            <div style="float: right; margin-bottom: 10px; margin-top: 20px;">
                <a class="btn btn-primary" href="{{ route('departments.create') }}"  role="button"><i class="fa fa-plus-circle"></i> {{ trans('label.departments.add_department') }}
                </a>
            </div>
            @endif
            <table id="table" class="table" style="margin-top: 20px;">
                <thead class="thead-inverse">
                  <tr style="background-color: #CA4D4D; color: white;">
                    <th>{{ trans('label.departments.id') }}</th>
                    <th>{{ trans('label.departments.name_department') }}</th>
                    <th>{{ trans('label.departments.alias') }}</th>
                    <th>{{ trans('label.departments.address') }}</th>
                    @if(Auth::user()->hasRole('admin'))
                    <th>{{ trans('label.departments.add_user') }}</th>
                    <th>{{ trans('label.departments.edit') }}</th>
                    <th>{{ trans('label.departments.delete') }}</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                    @foreach($departments as $item)
                        <tr>
                            <td>{{ $item['id'] }}</td>
                            <td><a href="{{ route('admin.departments.users.list', $item->id) }}">{{ $item['name'] }}</a></td>
                            <td>{{ $item['alias'] }}</td>
                            <td>{{ $item['address'] }}</td>
                            @if(Auth::user()->hasRole('admin'))
                            <td>
                                <a class="btn btn-primary" href="{{ route('admin.departments.users.create', $item->id) }}" role="button"><i class="fa fa-plus-circle"></i> {{ trans('label.departments.add_user') }}</a>
                            </td>
                            <td>
                                <a class="btn btn-small btn-warning" href="#" data-toggle="modal" data-target="#editdepartment" name="department_edit">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['departments.destroy', $item['id']]]) !!}
                                {{ Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> ', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure to delete ?')"]) }}
                                {!! Form::close() !!}
                            </td>
                            @endif
                        </tr>
                    @endforeach()
                </tbody>
            </table>
        </div>

        <!-- pagination -->
        <div class="pagination pull-right">
            {!! $departments->appends(Request::except('page'))->links() !!}
        </div>
</div>

@include('admin.departments.edit')
@stop
