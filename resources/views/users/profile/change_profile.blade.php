<div class="col-md-6 col-md-offset-1">
    @include('errors.errors')
    @include('errors.success')
    @can('update-info', $user->id)
        <h3 style="padding-top: 10px; margin-bottom: 10px; text-align: center; color: #2ab27b;">Thay đổi thông tin cá nhân</h3>
        {!! Form::model($user, ['action' => ['UserController@update', $user->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'files' => true]) !!}

        {!! Form::label('name', trans('label.name')) !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}

        {!! Form::label('avatar', trans('label.avatar')) !!}
        {!! Form::file('avatar', ['id' => 'image']) !!}
        <br>
        <img src="{{ url($user['avatar']) }}" class="img-thumbnail img-row" id="image-url" style="width: 50%; height: 50%;">
        <br>
        <br>

        {!! Form::button('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> ' . trans('label.update'), ['type' => 'submit', 'class' => 'btn btn-success']) !!}

        {!! Form::close() !!}
    @endcan
</div>
