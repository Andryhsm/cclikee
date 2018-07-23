<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{{ csrf_token() }}"/>

    <title>CLICKEE | Marchand</title>

    {!! Html::style('frontend/css/bootstrap.min.css') !!}
    {!! Html::style('frontend/css/merchant.css') !!}
    {!! Html::style('frontend/css/style-clickee.css') !!}
    {!! Html::style('frontend/css/customer.css') !!}
    {!! Html::style('frontend/css/responsive.css') !!}
    {!! Html::style('frontend/css/customer-responsive.css') !!}
    {{ Html::style('https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css') }}

</head>
<body>
    
    <div class='container-fluid ptb-20'>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
            <p>
                <b class="fs-27">FACTURE n° 1212</b><br> En date du : 15-06-2018
            </p>
        </div>
        <br><br><br><br>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="logo text-center">
                <img style="max-width: 25%;" src="{!! URL::to('/') !!}/images/logoPdf.png" alt="logo clickee"/>
            </div>
        </div>
        <br><br><br><br><br>
        <div class="facture-header row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <p><b>Nom magasin</b></p>
                    <p>60 chemin d’Odos</p>
                    <p>TARBES</p>
                    <p>65000</p>
                    <p>FRANCE</p>
                    <p>0619840764</p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="padding-left:36rem;">
                    <p><b>Feno Tolojanahary</b></p>
                    <p>Ambalavato</p>
                    <p>Antsirabe</p>
                    <p>00110</p>
                    <p>Madagascar</p>
                    <p>3465425145</p>
                </div>
            </div>    
        </div>    
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive" style="border:none;">
            <table class="table table-paiement">
    			<thead>
    				<tr>
    					<th>Nom produit</th>
    					<th>Référence</th>
    					<th>Quantité</th>
    					<th>Montant HT</th>
    				</tr>
    			</thead>
    			<tbody class="table-content-paiement">
    			    <tr>
    			        <td>Capichon chinois</td>
    			        <td>2100</td>
    			        <td>1</td>
    			        <td>10.00<i class="fa fa-eur"></i></td>
    			    </tr>
    			    <tr>
    			        <td>Lunette</td>
    			        <td>2102</td>
    			        <td>1</td>
    			        <td>50.00<i class="fa fa-eur"></i></td>
    			    </tr>
    			</tbody>
    			<tfoot>
    			    <tr>
    			        <th class="border-none"></th>
    			        <th class="border-none"></th>
    			        <th class="border-none">Montant total HT</th>
    			        <th class="border-none">60.00<i class="fa fa-eur"></i></th>
    			    </tr>
    			    <tr>
    			        <th class="border-none"></th>
    			        <th class="border-none"></th>
    			        <th class="border-none">Remise</th>
    			        <th class="border-none">0%</th>
    			    </tr>
    			    <tr>
    			        <th class="border-none"></th>
    			        <th class="border-none"></th>
    			        <th class="border-none">TVA</th>
    			        <th class="border-none">0%</th>
    			    </tr>
    			    <tr>
    			        <th class="border-none"></th>
    			        <th class="border-none"></th>
    			        <th class="border-none">Montant total TTC</th>
    			        <th class="border-none">60.00<i class="fa fa-eur"></i></th>
    			    </tr>
    			</tfoot>    
    		</table>
        </div>
        
    </div>

{!! Html::script('backend/bootstrap/js/bootstrap.min.js') !!}
{!! Html::script('backend/dist/js/app.js') !!}
{!! Html::script('backend/js/jquery.form.js') !!}

@yield('footer-scripts')
</body>
</html>