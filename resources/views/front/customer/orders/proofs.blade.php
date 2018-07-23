@if(count($proofed_orders) > 0)
    <div class="content" id="proof_order_history">
        <!-- Start :: Pagination -->
        @include('customer.profilepagination', array('items' => $proofed_orders))
        <div class="row margin-top-xxl proofs-available-block">
        <!-- End :: Pagination -->
        @foreach ($proofed_orders as $proofed_order)
                <div class="orders-block">
                <div class="row">
                    <span class="user-data"><strong>Order Number: </strong></span>
                    <span class="user-data">{!! $proofed_order->order_id !!}</span>
                </div>

                @if($proofed_order->product_name != '')
                    <div class="row">
                        <span class="user-data"><strong>Product Name: </strong></span>
                        <span class="user-data">{!! $proofed_order->product_name !!}</span>
                    </div>
                @endif

                <div class="row">
                    <span class="user-data"><strong>Order Date:</strong></span>
                    <span class="user-data">{!! format_date($proofed_order->order->order_date, "M dS, Y") !!}</span>
                </div>

                @if( trim($proofed_order->order->shipping->first_name . '' . $proofed_order->order->shipping->last_name != ""))
                    <div class="row">
                        <span class="user-data"><strong>Ship To:</strong></span>
                        <span class="user-data">{!! $proofed_order->order->shipping->first_name . ' ' . $proofed_order->order->shipping->last_name !!}</span>
                    </div>
                @endif

                <div class="row">
                    <span class="user-data"><strong>Order Total:</strong></span>
                    <span class="user-data">{!! format($proofed_order->order->total + $proofed_order->order->gift_certificate_amount, 'price') !!}</span>
                </div>
                {!! Html::link("view-proof/".$proofed_order->order_item_id.'/', "View Proof", array("title" => "View Proof", "class" => "account-btn")) !!}

            </div>
            <!-- /.col-6 -->
        @endforeach
        </div>
    </div>
    <!-- /.content -->
@else
    <p>No record found.</p>
@endif