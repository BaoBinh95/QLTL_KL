@extends('layouts.app')
@section('title')
    {{ trans('label.title.list_documents') }}
@stop
@section('content')
<div class="container">
    <div class="row">
        @include('errors.success')
            <div style="float: right; margin-bottom: 10px; margin-top: 20px;">
                <a class="btn btn-primary" href="{{ route('documents.create') }}"  role="button"><i class="fa fa-plus-circle"></i> {{ trans('label.documents.add_document') }}
                </a>
            </div>

            <table id="dataTables-example" class="table" style="margin-top: 20px;">
                <thead class="thead-inverse">
                  <tr style="background-color: #CA4D4D; color: white;">
                    <th>{{ trans('label.documents.id') }}</th>
                    <th>{{ trans('label.documents.user') }}</th>
                    <th>{{ trans('label.documents.title') }}</th>
                    <th>{{ trans('label.documents.description') }}</th>
                    <th>{{ trans('label.documents.content') }}</th>
                    <th>{{ trans('label.documents.date') }}</th>
                    @if(Auth::user()->hasRole('admin'))
                    <th>{{ trans('label.documents.edit') }}</th>
                    <th>{{ trans('label.documents.delete') }}</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                    @foreach($documents as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            @if(Auth::user()->hasRole('admin'))
                            <td>{{ $item->user->name }}</td>
                            @else
                            <td>{{ $item->name }}</td>
                            @endif
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                @foreach($data as $doc)
                                @if($item->id == $doc->id_document)
                                   <a id="{{'showfile-' . $doc->id}}" href="{{ 'https://docs.google.com/gview?url=' .asset('file_upload') . '/' . $doc->content . '&embedded=true'}}">
                                   {{ strstr($doc->content, '[') }}
                                   </a>&nbsp;
                                   <!-- downloadfile -->
                                   <a href="{{route('documents-file.show', $doc->id)}}"><i class="fa fa-download" aria-hidden="true"></i></a>
                                    </br>
                                @endif
                                @endforeach
                            </td>
                            <td>{{ DateTime::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('Y-m-d') }}</td>
                            @if(Auth::user()->hasRole('admin'))
                            <td>
                                {!! Form::open(['method' => 'GET', 'route' => ['documents.edit', $item->id]]) !!}
                                {{ Form::button('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> ', ['type' => 'submit', 'class' => 'btn btn-warning']) }}
                                {!! Form::close() !!}
                            </td>
                            <td>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['documents.destroy', $item->id]]) !!}
                                {{ Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> ', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure to delete ?')"]) }}
                                {!! Form::close() !!}
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- pagination -->
        <div class="pagination pull-right">
            {!! $documents->appends(Request::except('page'))->links() !!}
        </div>
</div>
@stop
