@extends('layouts.app')
@section('title')
    {{ trans('label.profile') }}
@stop
@section('content')
<div class="container">
    <div class="row">
        <!-- Profile -->
        <div class="col-md-4 col-md-4-ofset-2" style="margin-top: 20px;">
            {{ Html::image($user->avatar, $user->name, ['class' => 'img-thumbnail img-row']) }}
            <br>

            <table class="table table-striped table-info">
                <tbody>
                    <tr>
                        <td><strong>{{ trans('label.users.role') }}</strong></td>
                        <td><i class="fa fa-asterisk" aria-hidden="true"></i> {{ $user->role->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>{{ trans('label.name') }}</strong></td>
                        <td><i class="fa fa-user"></i> {{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>{{ trans('label.email') }}</strong></td>
                        <td><i class="fa fa-envelope"></i> <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                    </tr>
                    <tr>
                        <td><strong>{{ trans('label.department') }}</strong></td>
                        <td><i class="fa fa-users" aria-hidden="true"></i> {{ $user->department->name }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- update profile -->
        @include('users.profile.change_profile')
        <!-- update password -->
        @include('users.profile.change_password')
    </div>
</div>
@stop
