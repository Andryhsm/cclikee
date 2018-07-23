@extends($layout)

@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
@stop
@section('content')
    <section class="content-header">
        <h1>
            Produits dans la page d'accueil
        </h1>
        <div class="header-btn">
            <div class="clearfix">
                <div class="btn-group inline pull-left">
                    <div class="btn btn-small">
                        <a href="{!! URL::to('/admin/special-product/create') !!}" class="btn btn-block btn-primary">Nouvelle produit</a>
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
                    <div class="box-header">
                        <h3 class="box-title">Role</h3>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Type</th>
                                <th class="no-sort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($special_products as $special_product)
                                <tr>
                                    <td>{!! $special_product_type[$special_product[0]->type] !!}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ URL::to('admin/special-product/' . $special_product[0]->type . '/edit') }}"
                                               class="btn btn-default btn-sm" title="Edit"><i
                                                        class="fa fa-fw fa-edit"></i></a>
                                            {!! Form::open(array('url' => route('special-product.destroy', $special_product[0]->type), 'class' => 'pull-right')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button('<i class="fa fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-default btn-sm'] ) !!}
                                            {{ Form::close() }}
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