<div class="modal fade" id="show_department" tabindex="-1" role="dialog" aria-labelledby="showDepartmentLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="showDepartmentLabel">{{ trans('label.departments.show_department') }}</h4>
            </div>
            <div class="modal-body">
                <div id="views">
                    <div class="control-group">
                        {{ Form::label('name', trans('label.departments.name_department')) }}
                        <div class="controls">
                            {!! Form::text('name', null, ['class' => 'form-control name', 'id' => 'name', 'disabled']) !!}
                        </div>
                    </div>
                    <div class="control-group">
                        {{ Form::label('alias', trans('label.departments.alias')) }}
                        <div class="controls">
                            {!! Form::text('alias', null, ['class' => 'form-control', 'disabled']) !!}
                        </div>
                    </div>
                    <div class="control-group">
                        {{ Form::label('address', trans('label.departments.address')) }}
                        <div class="controls">
                            {!! Form::text('address', null, ['class' => 'form-control', 'disabled']) !!}
                        </div>
                    </div>
                    <!-- <div class="control-group">
                        {{ Form::label('manager', trans('label.departments.manager')) }}
                        <div class="controls">
                            {!! Form::text('manager', null, ['class' => 'form-control', 'disabled']) !!}
                        </div>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="clear">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
