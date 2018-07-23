@extends($layout)

@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
@stop
@section('content')
    <section class="content-header">
        <h1>
            Sommes dues aux marchands
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    
                    <div class="box-body">
                        <table id="accounting" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Nom du magasin</th>
                                <th>Dernière remise à zéro</th>
                                <th>Montant encaissé</th>
                                <th>Frais de service 3,5%</th>
                                <th>Montant du</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($stores->data as $store)
                                <tr>
                                    <td>{!! $store->store_name!!}</td>
                                    <td>
                                        @if(isset($store->encasementorderlastreset))
                                            {!! Jenssegers\Date\Date::parse($store->encasementorderlastreset->updated_at)->format('d-m-Y') !!}
                                        @endif
                                    </td>
                                    <td>
                                        <?php 
                                            $price_total=0;
                                            foreach ($store->requests as $value) {
                                                if($value->reset_accounting == 0)
                                                    $price_total+=$value->orderitem->final_price;
                                            }
                                            foreach ($store->encasements as $value) {
                                                if($value->reset_accounting == 0)
                                                    $price_total+=$value->total_ttc;
                                            }
                                            echo(format_price($price_total));
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            $service_charge = ($price_total*3.5)/100; 
                                            echo(format_price($service_charge));
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            echo(format_price($price_total-$service_charge));
                                        ?>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{!! url('admin/accounting/'.$store->store_id) !!}"  class="btn btn-default btn-sm" title="Reset"><i class="fa fa-fw fa-undo"></i> Remise à zéro</a>
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
    <script>
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
                    {searchable: true, sortable: true},
                    {searchable: false, sortable: false}
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