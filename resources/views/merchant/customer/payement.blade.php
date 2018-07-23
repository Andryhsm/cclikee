<div class="col-lg-12">
    <div class="box-body">
    	<div class="title">
    		<h1>Paiement</h1>
    	</div>
        <div class="row">
        	<div class="col-md-12 table-responsive">
        		<table class="table table-hover">
        			<thead>
        				<tr>
        					<th>Nom produit</th>
        					<th>Référence</th>
        					<th>Quantité</th>
        					<th>Montant HT</th>
        				</tr>
        			</thead>
        			<tbody class="table-content-paiement">
        			</tbody>
        		</table>
        	</div>
        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class=""> <!-- box-footer -->
        <a href="#tab_2" data-toggle="tab" class="btn btn-merchant-filled">Precedent</a>
        <a href="{!! url('/merchant/facturePdf') !!}" target="_blank" class="btn btn-merchant-filled hidden">
            Afficher facture
        </a>
        <button type="submit" id="encasement" class="btn btn-merchant-filled pull-right">Encaissement</button>
    </div>
</div>

            