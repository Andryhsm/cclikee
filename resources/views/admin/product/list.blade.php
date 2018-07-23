@extends($layout)

@section('additional-styles')
    {!! Html::style('backend/plugins/datatables/dataTables.bootstrap.css') !!}
@stop
@section('content')
    <section class="content-header">
        <h1>
            Tous les produits
        </h1>

        <div class="header-btn">
            <div class="clearfix">
                <div class="btn-group inline pull-left">

                     <div class="btn btn-samall">
                        <div class="btn-group" data-toggle="modal" data-target="#exampleModal">
                          <a href="#" class="btn btn-default">Sélectionnez la colonne à afficher</a>
                          <a href="#" class="btn btn-default"><span class="caret"></span></a>
                        </div>
                    </div>

                    <div class="btn btn-small">
                        <a href="{!! route('create_product') !!}" class="btn btn-block btn-primary">Nouveau produit</a>
                    </div>
                    <div class="btn btn-small">
                        <button class="btn btn-block btn-info" id="exportCSV" > Exporter en CSV</button>
                       <!--  <button class="btn btn-block btn-info" id="exportCSV" onClick="$('#product_list').tableExport({type:'csv',escape:'false'});" >Export data to CSV</button> -->
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
                        <table id="product_list" class="table table-bordered table-hover table-responsive">
                            <thead>
                            <tr>
                                <th>Nom Produit</th>
                                <th>Numéro de série</th>
                                <th>Prix ​​d'origine</th>
                                <th>Meilleur prix</th>
                                <th>Créé par</th>
                                <th>Marque</th>
                                <th>Créé le</th>
                                <th>Modifié par</th>
                                <th>Modifié le</th>
                                <th>Note/Question</th>
                                <th>Affiliés</th>
                                <th>Statut</th>                                
                                <th class="no-sort">Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
                <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sélectionnez la colonne à afficher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="checkbox">
                    <label><input class="col1" type="checkbox" checked="" value="0">Nom Produit</input></label>
                </div>
                <div class="checkbox">  
                    <label><input class="col2" type="checkbox" checked="" value="1">Numéro de série</input></label>
                </div>
                <div class="checkbox">
                    <label><input class="col3" type="checkbox" value="2">Prix ​​d'origine</input></label>
                </div>
                <div class="checkbox">
                    <label><input class="col4" type="checkbox" value="3">Meilleur prix</input></label>
                </div>
                <div class="checkbox">
                    <label><input class="col5" type="checkbox" checked="" value="4">Créé par</input></label>
                </div>
                <div class="checkbox">
                    <label><input class="col6" type="checkbox" checked="" value="5">Marque</input></label>
                </div>
                <div class="checkbox">
                    <label><input class="col7" type="checkbox" value="6">Créé le</input></label>
                </div>
                <div class="checkbox">
                    <label><input class="col8" type="checkbox" value="7">Modifié par</input></label>
                </div>
                <div class="checkbox">
                    <label><input class="col11" type="checkbox" value="8">Modifié le</input></label>
                </div>
                <div class="checkbox">
                    <label><input class="col12" type="checkbox" checked="" value="9">Note / Question</input></label>
                </div>
                <div class="checkbox">
                    <label><input class="col13" type="checkbox" checked="" value="9">Statut</input></label>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <!-- <button type="button" class="btn btn-primary">Validate</button> -->
              </div>
            </div>
          </div>
        </div>

    </section>

@stop

@section('additional-scripts')
    {!! Html::script('backend/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('backend/plugins/datatables/dataTables.bootstrap.min.js') !!}
    {!! Html::script('backend/plugins/dropzone/dropzone.js') !!}
    {!! Html::script('backend/js/tableExport.js') !!}
    {!! Html::script('backend/js/product.js') !!}
@stop
