@extends($layout)
@section('content')
    <section class="content-header">
        <h1>
            Ajouter une nouvelle marque
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" method="post" action="/">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="page_title">Nom du marque</label>
                                <input type="text" class="form-control" id="page_title" placeholder="Template Type">
                            </div>
                            <div class="form-group">
                                <label for="content-heading">Image du marque</label>
                                <input type="file" class="form-control">
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="{!! route('brand') !!}" class="btn btn-default">Annuler</a>
                            <button type="submit" class="btn btn-primary pull-right">Sauvegarder</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop
@section('footer-scripts')

@stop