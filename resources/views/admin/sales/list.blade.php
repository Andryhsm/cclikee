@extends($layout)

@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
@stop
@section('content')
    <section class="content-header">

        <h1>
            Ventes
        </h1>
        <div class="header-btn">
            <div class="clearfix">
                <div class="btn-group inline pull-left">
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        @include('admin.layout.notification')
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{!! $title !!}</h3>
                    </div>
                    <div class="box-body">
                        <table id="sales_order" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Num commande</th>
                                <th>Date de commande</th>
                                <th>Client</th>
                                <th>Total commande</th>
                                <th>Product(s)</th>
                                <th>Action</th>
                            </tr>
                            </thead>
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
    {!! Html::script('backend/js/sales.js') !!}

@stop
@section('footer-scripts')
<script>
    var status_id ='{!! $status !!}';
</script>
@stop
