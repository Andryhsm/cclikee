<div class="btn-group">
    <a href="{!! url('admin/sales/view/'.$order->order_id) !!}" class="btn btn-default btn-sm" title="View"><i
                class="fa fa-fw fa-eye"></i></a>
    {!! Form::open(array('url' => 'admin/sales/' . $order->order_id, 'class' => 'pull-right')) !!}
    {!! Form::hidden('_method', 'DELETE') !!}
    {!! Form::button('<i class="fa fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn delete-btn btn-default btn-sm','title'=>'Delete'] ) !!}
    {{ Form::close() }}
</div>
