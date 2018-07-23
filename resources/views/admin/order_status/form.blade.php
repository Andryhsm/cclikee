@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            Add New Status
        </h1>
    </section>

    <section class="content">
        @include('admin.layout.notification')
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    {!! Form::open(array('url' =>($status) ? Url("admin/order-status/$status->order_status_id") : Url("admin/order-status"),'id'=>'order_status','class'=>'order_status','method' => ($status)? 'PATCH':'POST')) !!}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="status_name">Nom du statut</label>
                            <input type="text" name="status_name" class="form-control required" id="status_name"
                                   value="{!! ($status) ? $status->status_name : null !!}"
                                   placeholder="Nom du statut">
                        </div>
                        <div class="form-group">
                            <label for="customer_status">Nom statut du client</label>
                            <input type="text" name="customer_status" class="form-control required"
                                   id="customer_status"
                                   value="{!! ($status) ? $status->customer_status: null !!}"
                                   placeholder="Nom statut du client">
                        </div>
                        <div class="form-group">
                            <label for="is_default" class="col-sm-1 control-label">Par défaut</label>
                            <input type="checkbox" name="is_default" id="is_default"
                                   value="1" {!! ($status && $status->is_default=='1')?"checked":'' !!}>
                        </div>

                    </div>
                    <div class="box-footer">
                        <a href="{!! Url('admin/order-status') !!}" class="btn btn-default">Annuler</a>
                        <button type="submit" class="btn btn-primary pull-right save-form" id="add-role">Enregistrer</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@stop
