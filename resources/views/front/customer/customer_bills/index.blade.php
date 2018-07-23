@extends('front.customer.layout.master')

@section('content')
<div class="ajax-content">
    <div class="customer_bills col-lg-12">
            <table class="customer-bills-table" id="">
                <thead>
                    <tr>
                        <th>N° Commande</th>
                        <th>N° Facture</th>
                        <th>Date d’Achat</th>
                        <th>Montant Total</th>
                        <th>Pdf</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>301335388</td>
                        <td>76485</td>
                        <td>12/04/2018</td>
                        <td>199,99€</td>
                        <td>
                            <div class="customer-file-action download">
                                <button class="btn btn-customer-filled bill" type="button">
                                    <span><p>Télécharger</p></span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>301335389</td>
                        <td>76498</td>
                        <td>15/04/2018 </td>
                        <td>473,70€</td>
                        <td>
                           <div class="customer-file-action download">
                                <button class="btn btn-customer-filled bill" type="button">
                                    <span><p>Télécharger</p></span>
                                </button>
                            </div> 
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
</div>
@endsection