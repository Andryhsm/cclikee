@if(count($stores) > 0)
    <div class="content col-md-12" id="order_history">
        <!-- Start :: Pagination -->
        @include('customer.profilepagination', array('items' => $stores))
                <!-- End :: Pagination -->
            @foreach($stores as $store_data)
                <div class="col-md-6">
                    <div class="row">
                        <span class="user-data"><strong>Store Name: </strong></span>
                        <span class="user-data">{!! $store_data->store_name !!}</span>
                    </div>
                    <div class="row">
                        <span class="user-data"><strong>Registration Number:</strong></span>
                        <span class="user-data">{!! $store_data->registration_number !!}</span>
                    </div>
                    <div class="row">
                        <span class="user-data"><strong>Store Email:</strong></span>
                        <span class="user-data">{!! $store_data->email !!}</span>
                    </div>
                    <div class="row">
                        <a class="btn btn-default default-btn"
                           href="{!! url('/store/'.$store_data->store_id.'/edit') !!}">Edit
                            Store</a>
                    </div>
                </div>
            @endforeach
    </div>

    <!-- /.content -->
@else
    <p>No record found.</p>
@endif