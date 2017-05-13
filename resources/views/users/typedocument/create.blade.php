@extends('layouts.app')
@section('title')
    {{ trans('label.typedocuments.create_typedocument') }}
@stop
@section('content')
 <div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1" style="float: right; margin-bottom: 10px; margin-top: 20px;">
            <div class="panel panel-info">
                <div class="panel-heading">
                    {{ trans('label.typedocuments.create_typedocument') }}
                </div>

                <div class="panel-body">
                    @include('errors.errors')
                    {!! Form::open(['route' => 'typedocuments.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                    <div class="form-group">
                        {!! Form::label('name', trans('label.typedocuments.name'), ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-8">
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('label.typedocuments.enter_name_typedocument'), 'required ' => 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('description', trans('label.typedocuments.description'), ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-8">
                            {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => trans('label.typedocuments.enter_description'), 'required ' => 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-7 col-md-offset-3">
                            {{ Form::button('<i class="fa fa-plus-circle"></i> ' . trans('label.save'), ['type' => 'submit', 'class' => 'btn btn-primary']) }}
                            {{ Form::button('<i class="fa fa-refresh"></i> ' . trans('label.reset'), ['type' => 'reset', 'class' => 'btn btn-primary']) }}
                            <a href="{{ route('typedocuments.index') }}" class="btn btn-success"><i class="fa fa-chevron-circle-left"></i> {{ trans('label.back') }}</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop

