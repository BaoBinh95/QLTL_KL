@extends('layouts.app')
@section('title')
    {{ trans('label.documents.add_documents') }}
@stop
@section('content')
 <div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1" style="float: right; margin-bottom: 10px; margin-top: 20px;">
            <div class="panel panel-info">
                <div class="panel-heading">
                    {{ trans('label.documents.add_documents') }}
                </div>

                <div class="panel-body">
                    @include('errors.errors')
                    {!! Form::open(['route' => 'documents.store', 'method' => 'POST', 'class' => 'form-horizontal', 'files' => true]) !!}
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
                        {!! Form::label('description', trans('label.documents.description'), ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-8">
                            {{ Form::textarea('description', null, ['class' => 'field']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">{{ trans('label.documents.status') }}</label>
                        <div class="col-md-8">
                            <label class="radio-inline" style="padding-left: 30px;">
                                <input name="status" value="1" type="radio">{{ trans('label.documents.private') }}
                            </label>
                            <label class="radio-inline">
                                <input name="status" value="0"  type="radio">{{ trans('label.documents.public') }}
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
