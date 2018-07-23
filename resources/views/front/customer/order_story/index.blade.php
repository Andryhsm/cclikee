@extends('front.customer.layout.master')

@section('content')

<div class="ajax-content order_story">
    @if(count($items) > 0) 
        @foreach($items as $item)
        <div class="order col-lg-12 ">
            <div class="">
                <div class="row">
                    <div class="text-center col-lg-12 pt-20">
                        <?php 
                            switch ($item->order_status_id) {
                                case 3:
                                    $status = "PRODUIT NON DISPONIBLE";
                                    break;
                                case 5:
                                    $status = "TERMINER";
                                    break;
                                case 6:
                                    $status = "ANNULER";
                                    break;
                                default:
                                    $status = "";
                            }
                        ?>
                        <p ><span class="title-bold-2">STATUS : </span> {!! $status !!} </p>
                    </div>
                    
                    <div class="order-story col-lg-12">
                        <div class="order-img col-lg-4 col-md-4 col-sm-4 col-xs-6">
                            <img src="{!! URL::to('/').'/'.$item->product->getDefaultImagePath() !!}"></img>
                        </div>
                        <div class="order-info ptb-10 col-lg-3 col-md-3 col-sm-3 col-xs-5">
                            
                            <div><strong class="text-uppercase">{!! $item->product->brand_name !!}</strong></div>
                            
                            <div class="">
                                <p>{!! $item->product_name !!}</p>
                                @foreach($item->attributes as $index=>$attribute)
                                    <p>{!! $attribute->attribute_label !!} {!! $attribute->attribute_selected_value !!}</p>
                                @endforeach
                            </div>
                            <div>
                                <div class="title-bold-2">{!! format_price($item->price) !!}</div>
                            </div>
                            
                        </div>
                        <div class="order-info info-2 ptb-10 col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <div><p><span class="title-bold-2">N° DE COMMANDE : </span>{!! $item->order->order_id !!}</p></div>
                            <div><p><span class="title-bold-2">DATE DE COMMANDE : </span>{!! formatDate($item->order->order_date, "M dS, Y") !!}</p></div>
                            <div><p><span class="title-bold-2">BOUTIQUE : </span>{!! $item->product->store->store_name !!}</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @else
        <div class="order">
            <p class="title-bold-2 text-uppercase text-center">Aucun commande trouvé</p>&nbsp;
        </div>
    @endif
</div>
@endsection