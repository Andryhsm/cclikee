@extends($layout)

@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
@stop
@section('content')
    <section class="content-header">
        <h1>
            Liste des produits
        </h1>
        
    </section>

    <section class="content">
        @include('admin.layout.notification')
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>La revue</th>
                                <th>Taux</th>
                                <th>Produit</th>
                                <th>Client</th>
                                <th>Statut</th>
                                <th>Date du revue</th>
                                <th class="no-sort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($ratings->data as $rating)
                                    <tr>
                                        <td>{!! $rating->review !!}</td>
                                        <td>{!! $rating->rating !!}</td>
                                        <td>{!! (isset($rating->product->english->product_name)) ? $rating->product->english->product_name : "" !!}</
                                        td>
                                        <td>{!! ($rating->user != null) ? $rating->user->first_name.' '.$rating->user->last_name :"" !!}</td>
                                        <td>
                                            @if($rating->status==1)
                                                <span class="badge bg-green">Approuver</span>
                                            @elseif($rating->status==2)
                                                <span class="badge bg-red">Rejeter</span>
                                            @else
                                                <span class="badge bg-light-blue">En attente d'approbation</span>
                                            @endif
                                        </td>
                                         <td>{!! convertDate($rating->review_date) !!}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ URL::to('admin/product-rating/' . $rating->product_rating_id . '/edit') }}"
                                                   class="btn btn-default btn-sm" title="Edit"><i
                                                            class="fa fa-fw fa-edit"></i></a>
                                                {!! Form::open(array('url' => 'admin/product-rating/' . $rating->product_rating_id, 'class' => 'pull-right')) !!}
                                                {!! Form::hidden('_method', 'SUPPRIMER') !!}
                                                {!! Form::button('<i class="fa fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn delete-btn btn-default btn-sm'] ) !!}
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

@section('additional-scripts')
    {!! Html::script('backend/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('backend/plugins/datatables/dataTables.bootstrap.min.js') !!}
@stop
@section('footer-scripts')
    {!! Html::script('backend/js/rating.js') !!}

@stop
