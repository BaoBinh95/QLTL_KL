@extends('layouts.app')
@section('title')
    {{ trans('label.title.list_typedocment') }}
@stop
@section('content')
<div class="container">
    <div class="row">
        @include('errors.success')
            <div style="float: right; margin-bottom: 10px; margin-top: 20px;">
                <a class="btn btn-primary" href="{{ route('typedocuments.create') }}"  role="button"><i class="fa fa-plus-circle"></i> {{ trans('label.typedocuments.create_typedocument') }}
                </a>
            </div>
            <table id="table" class="table" style="margin-top: 20px;">
                <thead class="thead-inverse">
                  <tr style="background-color: #CA4D4D; color: white;">
                    <th>{{ trans('label.typedocuments.id') }}</th>
                    <th>{{ trans('label.typedocuments.name') }}</th>
                    <th>{{ trans('label.typedocuments.description') }}</th>
                    <th>{{ trans('label.typedocuments.edit') }}</th>
                    @if(Auth::user()->hasRole('admin'))
                    <th>{{ trans('label.typedocuments.delete') }}</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                    @foreach($typedocuments as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}
                                <input type='hidden' class="typedocId" value="{{ $item['id'] }}">
                            </td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                <a class="btn btn-small btn-warning" href="#" data-toggle="modal" data-target="#edittypedocument" name="typedocument_edit">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                            </td>
                            @if(Auth::user()->hasRole('admin'))
                            <td>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['typedocuments.destroy', $item['id']]]) !!}
                                {{ Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> ', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure to delete ?')"]) }}
                            </td>
                            @endif
                        </tr>
                    @endforeach()
                </tbody>
            </table>
        <!-- pagination -->
        <div class="pagination pull-right">
            {!! $typedocuments->appends(Request::except('page'))->links() !!}
        </div>
    </div>
</div>
@include('users.typedocument.edit')
@stop
