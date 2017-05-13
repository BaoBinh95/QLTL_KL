@extends('layouts.app')

@section('title')
    {{ trans('layouts.403_title') }}
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="hero-unit style-center">
                    <h1>{{ trans('layouts.403_heading') }}</h1>
                    <br/>
                </div>
                {{ Html::image('/images/403.jpg', null, ['class' => 'img-responsive style-center']) }}
            </div>
            <br/>
        </div>
    </div>
@stop
