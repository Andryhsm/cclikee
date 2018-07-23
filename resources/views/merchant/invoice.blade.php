@if(count($invoices) > 0)
    <div class="content col-md-12" id="invoice_history">
        <!-- Start :: Pagination -->
    @include('front.customer.profilepagination', array('items' => $invoices))
    <!-- End :: Pagination -->
        @foreach($invoices as $invoice)
            <div class="col-md-3">
                <div class="row">
                    <span class="user-data"><strong>{!! trans('merchant.invoice_id') !!}: </strong></span>
                    <span class="user-data">#{!! $invoice->id !!}</span>
                </div>
                <div class="row">
                    <span class="user-data"><strong>{!! trans('merchant.amount') !!}: </strong></span>
                    <span class="user-data">{!! format_price($invoice->amount) !!}</span>
                </div>
                <div class="row">
                    <span class="user-data"><strong>{!! trans('merchant.date') !!}: </strong></span>
                    <span class="user-data">{!! convertDate($invoice->created_at) !!}</span>
                </div>
                <div class="row">
                    <span class="user-data"><strong>{!! trans('merchant.status') !!}: </strong></span>
                    <span class="user-data">
                        @if($invoice->status=='0')
                            Billed
                        @else
                            Payed
                        @endif
                    </span>
                </div>
                <div class="row">
                    <span class="user-data"><strong>{!! trans('merchant.notes') !!}: </strong></span>
                    <span class="user-data">{!! $invoice->notes !!}</span>
                </div>

                <div class="row">
                    <a class="btn btn-default default-btn"
                       href="{!! url('/invoice/'.$invoice->id) !!}">{!! trans('merchant.view_invoice') !!}</a>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p>No record found.</p>
@endif