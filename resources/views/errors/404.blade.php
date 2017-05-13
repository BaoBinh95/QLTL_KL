@extends('layouts.app')

@section('title')
    {{ trans('layouts.404_title') }}
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="span12">
                {{ Html::image('/images/404.png', null, ['class' => 'img-responsive style-center']) }}
            </div>
            <br/>
        </div>
    </div>
@stop
