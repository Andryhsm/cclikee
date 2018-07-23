@extends($layout)

@section('content')
    <section class="content-header">
        <h1>
            Tableau de bord
        </h1>
    </section>

    <section class="content">
        <section class="content">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-bag"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Produits</span>
                            <span class="info-box-number">{!! $product_count !!}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa ion-briefcase"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Magasins</span>
                            <span class="info-box-number">{!! $store_count !!}</span>
                        </div>
                    </div>
                </div>

                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Ventes</span>
                            <span class="info-box-number">{!! $sales_count !!}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Nouveaux membres</span>
                            <span class="info-box-number">{!! $member_count !!}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box box-danger">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Derniers membres</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <ul class="users-list clearfix">
                                        @foreach($members as $user)
                                        <li>
                                            <a class="users-list-name" href="javascript:void(0)">{!! $user->first_name." ".$user->last_name !!}</a>
                                            <span class="users-list-date">{!! \Carbon\Carbon::parse($user->created_at)->format('M d, Y') !!}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="box-footer text-center">
                                    <a href="{!! url('admin/customer') !!}" class="uppercase">Voir tous les utilisateurs</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Produits récemment ajoutés</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <ul class="products-list product-list-in-box">
                                        @foreach($products as $product)
                                        <li class="item">
                                            <div class="product-img">
                                                @if(count($product->images) > 0)
                                                <img src="{!! url('upload/product/thumb/'.$product->images[0]->image_name) !!}" alt="Product Image">
                                                @endif
                                            </div>
                                            <div class="product-info">
                                                <a href="javascript:void(0)" class="product-title">{!! $product->translation->product_name !!}
                                                    <span class="label label-warning pull-right">{!! format_price($product->original_price) !!}</span></a>
                                                <span class="product-description">
                                                    {!! str_limit($product->translation->description,80) !!}
                                                </span>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="box-footer text-center">
                                    <a href="{!! url('admin/product') !!}" class="uppercase">Voir tous les produits</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Magasins récemment ajoutéss</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <ul class="products-list product-list-in-box">
                                @foreach($stores as $store)
                                <li class="item">
                                    <div class="product-img">
                                        @if(file_exists(public_path('upload/store/'.$store->logo)))
                                        <img src="{!! url('upload/store/'.$store->logo) !!}" alt="Store Image">
                                        @endif
                                    </div>
                                    <div class="product-info">
                                        <a href="javascript:void(0)" class="product-title">{!! $store->store_name !!}
                                            <span class="product-description">
                                              {!! $store->short_description !!}
                                            </span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="box-footer text-center">
                            <a href="{!! url('admin/store') !!}" class="uppercase">Voir tous les magasins</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Dernières commandes</h3></h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>ID commande</th>
                                    <th>Client</th>
                                    <th>Statut</th>
                                    <th>Date de la commande</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td><a href="{!! url('admin/sales/view/'.$order->order_id) !!}">{!! $order->order_id !!}</a></td>
                                    <td>{!! ($order->customer != null) ? $order->customer->first_name." ".$order->customer->last_name : "" !!}</td>
                                    <td><span class="label label-success">{!! ($order->status != null) ? $order->status->status_name : "" !!}</span></td>
                                    <td>
                                        <div class="sparkbar" data-color="#00a65a" data-height="20">{!! \Carbon\Carbon::parse($order->order_date)->format('M d, Y h:i A') !!}</div>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <a href="{!! url('admin/sales/1') !!}" class="btn btn-sm btn-default btn-flat pull-right">Voir tous les commandes</a>
                    </div>
                </div>
            </div>
        </section>
    </section>
@stop
