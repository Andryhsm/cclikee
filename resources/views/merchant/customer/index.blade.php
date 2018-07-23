@extends('merchant.layout.master')
@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
    {!! Html::style('frontend/css/font-awesome.min.css') !!}
    {!! Html::style('backend/bootstrap/css/bootstrap.min.css') !!}
    {!! Html::style('backend/plugins/select2/select2.css') !!}
    {!! Html::style('backend/dist/css/AdminLTE.min.css') !!}
    {!! Html::style('backend/dist/css/skins/skin-black-light.css') !!}
    {!! Html::style('backend/css/style.css') !!}
     {!! Html::style('backend/plugins/dynatree/src/skin/ui.dynatree.css') !!}
    {!! Html::style('backend/plugins/dropzone/dropzone.css') !!}
    {!! Html::style('backend/plugins/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css') !!}
    {!! Html::style('frontend/css/style-clickee.css') !!}
@stop
@section('page_title')
    <div class="section-title col-mm-8  col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="header-item">  
            <div class="title title-active col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="title-icon">
                    <img class="" src="{!! URL::to('/') !!}/images/icon/encasement.svg"/>
                </div> 
                <div class="title-title">
                    <span class="text-title-active">Encaissement</span>
                </div>
            </div>
        </div>
    </div>
@stop
@section('content')


    <section class="content">
        @include('admin.layout.notification')
        <div class="row">
            <section class="content-header mb-40" style="text-align: center;">
                <h1>
                    Mon fichier client
                </h1>
            </section>
            <div class="col-xs-12">
                <div class="box box-customer">
                    <div class="box-body">
                        <table id="customer" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                            	<!--<th>Adresse</th>-->
                                <th>Code postal</th>
                                <th>Ville</th>
                                <!--<th>Naissance</th>-->
                                <!--<th>Mail</th>-->
                                <th class="no-sort">Action</th>
                            </tr>
                            </thead>
	                         <tbody>
	                            @foreach($customers_user as $customer)
	                                <tr>
	                                    <td>{!! $customer->first_name !!}</td>
	                                    <td>{!! $customer->last_name !!}</td>
	                                    @if($customer->address)
	                                        <?php $address = $customer->address; ?>
	                                    @else
	                                        <?php $address = $customer; ?>
	                                    @endif
	                                    <td>{!! $address->zip !!}</td>
	                                    <td>{!! $address->city !!}</td>
	                                    <td>
	                                        <div class="btn-group">
	                                            <a href="{{ route('client.edit',['id' => $customer->user_id, 'type_customer' => 1]) }}"
	                                               class="btn btn-primary btn-sm" title="Edit">Encaissement</a>&nbsp;
	                                            {{-- {!! Form::open(array('url' => route('client.destroy',['id' => $customer->user_id, 'type_customer' => \App\StoreCustomer::CUSTOMER_SYSTEM_USER]), 'class' => 'pull-right')) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                {!! Form::button('<i class="fa fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn delete-btn btn-default btn-sm','title'=>'Delete'] ) !!}
                                                {{ Form::close() }} --}}
	                                        </div>
	                                    </td>
	                                </tr>
	                            @endforeach
                                @foreach($customers_local as $customer)
                                    <tr>
                                        <td>{!! $customer->first_name !!}</td>
                                        <td>{!! $customer->last_name !!}</td>
                                        <td>{!! $customer->postal_code !!}</td>
                                        <td>{!! $customer->country !!}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('client.edit',['id' => $customer->customer_id, 'type_customer' => 2]) }}"
                                                   class="btn btn-primary btn-sm" title="Edit">Encaisser</a>&nbsp;
                                                {{-- {!! Form::open(array('url' => route('client.destroy',['id' => $customer->user_id, 'type_customer' => \App\StoreCustomer::CUSTOMER_SYSTEM_USER]), 'class' => 'pull-right')) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                {!! Form::button('<i class="fa fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn delete-btn btn-default btn-sm','title'=>'Delete'] ) !!}
                                                {{ Form::close() }} --}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
	                         </tbody>

                        </table>
                        <a class="btn btn-default text-uppercase" href="{!! route('encasement') !!}" >Retour</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('additional-script')
    {!! Html::script('backend/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('backend/plugins/datatables/dataTables.bootstrap.min.js') !!}
@stop

@section('footer-scripts')
    <script type="text/javascript">
        if (jQuery('table.table').length > 0) {
            jQuery('table.table').DataTable({
                "responsive": true,
                "bPaginate": true,
                "bLengthChange": true,
                "bFilter": true,
                "bInfo": true,
                "bAutoWidth": false,
                "order": [[2, "desc"]],
                "lengthMenu": [20, 40, 60, 80, 100],
                "pageLength": 20,
                language: {
                        paginate: {
                            first:    'Premier',
                            previous: 'Précédent',
                            next:      'Suivant',
                            last:     'Dernier'
                        },
                        "lengthMenu": "Afficher _MENU_ entrées",
                        "search": "Chercher:",
                        "processing": "En traitement ...",
                        "infoEmpty": "Aucune entrée à afficher",
                        "info": "Afficher la page _PAGE_ de _PAGES_"
                },
                columns: [
                    {searchable: true, sortable: true},
                    {searchable: true, sortable: true},
                    {searchable: true, sortable: true},
                    {searchable: true, sortable: true},
                    {searchable: false, sortable: false},
                ],
                fnDrawCallback: function () {
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
    </script>
@stop
