@extends('layouts.app')
@section('title')
    {{ trans('label.welcome_home') }}
@stop
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Hệ thống quản lý tài liệu</div>

                <div class="panel-body">
                    {{ Html::image('/images/dms-banner.jpg', null, ['class' => 'img-responsive']) }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
