<div class="col-md-6 col-md-offset-5">
    @can('update-info', $user->id)
        <h3 style="padding-top: 10px; margin-bottom: 10px; text-align: center; color: #2ab27b;">Thay đổi mật khẩu</h3>
        <br/>
           {!! Form::open(['route' => 'update_password', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

            {!! Form::label('old_password', trans('label.changePass.old_password')) !!}
            {!! Form::password('old_password', ['class' => 'form-control', 'placeholder' => trans('label.changePass.old_password_placeholder'), 'required' => 'required']) !!}

            {!! Form::label('password', trans('label.changePass.new_password')) !!}
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => trans('label.changePass.new_password_placeholder'), 'required' => 'required']) !!}

            {!! Form::label('password_confirmation', trans('label.changePass.password_confirm_label')) !!}
            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => trans('label.changePass.new_password_confirm'), 'required' => 'required']) !!}

            <br>

            {!! Form::button('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> ' . trans('label.update'), ['type' => 'submit', 'class' => 'btn btn-success']) !!}

            {!! Form::close() !!}
        @endcan
</div>
