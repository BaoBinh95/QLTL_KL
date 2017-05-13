<div class="modal fade" id="edittypedocument" tabindex="-1" role="dialog" aria-labelledby="editTypeDocumentLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editTypeDocumentLabel">{{ trans('label.typedocuments.edit_typedocument') }}</h4>
            </div>
            <div class="modal-body">
                <div id="formerrors">

                </div>
                {{ Form::open(['id' => 'edit_typedocument', 'method' => 'PUT']) }}
                    <div class="control-group">
                        {{ Form::label('name', trans('label.typedocuments.name')) }}
                        <div class="controls">
                            {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                    </div>
                    <div class="control-group">
                        {{ Form::label('description', trans('label.typedocuments.description')) }}
                        <div class="controls">
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                    </div>
                {{ Form::close()}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="updateTypeDocument">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

