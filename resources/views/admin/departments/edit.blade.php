<div class="modal fade" id="editdepartment" tabindex="-1" role="dialog" aria-labelledby="editCategoryLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editCategoryLabel">{{ trans('label.departments.edit_department') }}</h4>
            </div>
            <div class="modal-body">
                <div id="formerrors">

                </div>
                {{ Form::open(['id' => 'edit_form', 'method' => 'PUT']) }}
                    <div class="control-group">
                        {{ Form::label('name', trans('label.departments.name_department')) }}
                        <div class="controls">
                            {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'required' => 'required']) !!}
                        </div>
                    </div>
                    <div class="control-group">
                        {{ Form::label('alias', trans('label.departments.alias')) }}
                        <div class="controls">
                            {!! Form::text('alias', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                    </div>
                    <div class="control-group">
                        {{ Form::label('address', trans('label.departments.address')) }}
                        <div class="controls">
                            {!! Form::text('address', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                    </div>
                {{ Form::close()}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="updateDepartment">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

