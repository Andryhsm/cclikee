@extends($layout)

@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
@stop
@section('content')
    <section class="content-header">
        <h1>
            Company Account
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Company Accounts</h3>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Merchant Name</th>
                                <th>Product Name</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td>{!! !empty($item->itemRequest->first()->merchant) ? $item->itemRequest->first()->merchant->first_name." ".$item->itemRequest->first()->merchant->last_name:'' !!}</td>
                                <td>{!! $item->product_name !!}</td>
                                <td>{!! format_price($item->final_price) !!}</td>
                                <td>
                                    @if(!empty($item->invoiceItem) && $item->invoiceItem->invoice->status=='0')
                                        <span class="label label-primary">Billed</span>
                                    @elseif(!empty($item->invoiceItem) && $item->invoiceItem->invoice->status=='1')
                                        <span class="label label-success">Payed</span>
                                    @else
                                        <span class="label label-warning">Sold</span>
                                    @endif
                                </td>
                                <td>{!! convertDate($item->itemRequest->first()->booked_date) !!}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{!! url('admin/company-account/'.$item->order_item_id) !!}"  class="btn btn-default btn-sm" title="Delete"><i class="fa fa-fw fa-eye"></i></a>
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
@stop
@section('footer-scripts')
    <script type="application/javascript" language="javascript">
        $(function () {
            if (jQuery('table.table').length > 0) {
                jQuery('table.table').DataTable({
                    "responsive"   : true,
                    "bPaginate"    : true,
                    "bLengthChange": true,
                    "bFilter"      : true,
                    "bInfo"        : true,
                    "bAutoWidth"   : false,
                    "order"        : [[4, "desc"]],
                    "lengthMenu"   : [20, 40, 60, 80, 100],
                    "pageLength"   : 20,
                    columns        : [
                        {searchable: true, sortable: true},
                        {searchable: true, sortable: true},
                        {searchable: true, sortable: true},
                        {searchable: true, sortable: true},
                        {searchable: true, sortable: true},
                        {searchable: false, sortable: false}
                    ],
                    fnDrawCallback : function () {
                        var $paginate = this.siblings('.dataTables_paginate');
                        if (this.api().data().length <= this.fnSettings()._iDisplayLength) {
                            $paginate.hide();
                        }
                        else {
                            $paginate.show();
                        }
                    }
                });
            }

            if (jQuery('.dataTables_filter').length > 0) {
                jQuery('.dataTables_filter').find('input').addClass('form-control')
            }

        });
    </script>

@stop
