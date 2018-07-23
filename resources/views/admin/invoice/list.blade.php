@extends($layout)

@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
@stop
@section('content')
    <section class="content-header">
        <h1>
            All Invoices
        </h1>
        <div class="header-btn">
            <div class="clearfix">
                <div class="btn-group inline pull-left">
                    <div class="btn btn-small">
                        <a href="{!! URL::to('/admin/invoice/create') !!}" class="btn btn-block btn-primary">Create New Invoice</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        @include('admin.layout.notification')
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="invoice_list" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Invoice Id</th>
                                <th>Merchant</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date Created</th>
                                <th class="no-sort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices->data as $invoice)
                                <tr>
                                    <td>#{!! $invoice->id !!}</td>
                                    <td>{!! $invoice->merchant->first_name." ".$invoice->merchant->last_name !!}</td>
                                    <td>{!! format_price($invoice->amount) !!}</td>
                                    <td>
                                        @if($invoice->status==0)
                                            <span class="label label-primary">Billed</span>
                                        @else
                                            <span class="label label-success">Payed</span>
                                        @endif
                                    </td>
                                    <td>{!! convertDate($invoice->created_at) !!}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{!! url('admin/invoice/'.$invoice->id) !!}"  class="btn btn-default btn-sm" title="Delete"><i class="fa fa-fw fa-eye"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
@section('additional-scripts')
    {!! Html::script('backend/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('backend/plugins/datatables/dataTables.bootstrap.min.js') !!}
    {!! Html::script('backend/js/invoice.js') !!}

@stop
@section('footer-scripts')

@stop
