<div class="btn-group">
    @if(is_null($brand->parent_id))
        <a href="{{ URL::to('admin/brand/' . $brand->brand_id . '/edit') }}" class="btn btn-default btn-sm"
           title="Edit"><i class="fa fa-fw fa-edit"></i></a>
        {!! Form::open(array('url' => 'admin/brand/' . $brand->brand_id, 'class' => 'pull-right')) !!}
        {!! Form::hidden('_method', 'DELETE') !!}
        {!! Form::button('<i class="fa fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn delete-btn btn-default btn-sm','title'=>'Delete'] ) !!}
        {{ Form::close() }}
    @endif
</div>