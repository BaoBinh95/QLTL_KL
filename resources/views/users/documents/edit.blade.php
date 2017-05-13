@extends('layouts.app')
@section('title')
    {{ trans('label.documents.edit_documents') }}
@stop
@section('content')
 <div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1" style="float: right; margin-bottom: 10px; margin-top: 20px;">
            <div class="panel panel-info">
                <div class="panel-heading">
                    {{ trans('label.documents.edit_documents') }}
                </div>

                <div class="panel-body">
                    @include('errors.errors')
                    {!! Form::model($document, ['method' => 'PATCH', 'route' => ['documents.update', $document->id], 'class' => 'form-horizontal', 'files' => true]) !!}
                    <div class="form-group">
                        {!! Form::label('id_typedoc', trans('label.typedocuments.name'), ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-8">
                            {!! Form::select('id_typedoc', $typedocuments, null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('title', trans('label.documents.title'), ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-8">
                            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => trans('label.documents.enter_title'), 'required ' => 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('content', trans('label.documents.content'), ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-8">
                            {!! Form::file('content[]', array('multiple'=>true)) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('old_content', trans('label.documents.old_content'), ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-6">
                            @foreach($document_files as $file)
                                <!-- xoa tai lieu cu -->
                                <a href="javascript:void(0);" class="deleteDocBtn" documentId="{{$document->id}}" fileId="{{ $file->id }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>&nbsp;
                                <!-- end -->
                                <a href="{{ 'https://docs.google.com/gview?url=' .asset('file_upload') . '/' . $file->content . '&embedded=true'}}">
                                   {{ strstr($file->content, '[') }}
                                </a>
                                <br/>
                                <br/>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('description', trans('label.documents.description'), ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-8">
                            {{ Form::textarea('description', null, ['class' => 'field']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">{{ trans('label.documents.status') }}</label>
                        <div class="col-md-8">
                            <label class="radio-inline">
                                <input name="status" value="1" type="radio"
                                @if($document->status == 1)
                                    checked="checked"
                                @endif
                                >Private
                            </label>
                            <label class="radio-inline">
                                <input name="status" value="0" type="radio"
                                @if($document->status == 0)
                                    checked="checked"
                                @endif
                                >Public
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-7 col-md-offset-3">
                            {{ Form::button('<i class="fa fa-plus-circle"></i> ' . trans('label.save'), ['type' => 'submit', 'class' => 'btn btn-primary']) }}
                            {{ Form::button('<i class="fa fa-refresh"></i> ' . trans('label.reset'), ['type' => 'reset', 'class' => 'btn btn-primary']) }}
                            <a href="{{ route('documents.index') }}" class="btn btn-success"><i class="fa fa-chevron-circle-left"></i> {{ trans('label.back') }}</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop
