<div class="product-listing">
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Link</th>
            <th>Image</th>
        </tr>
        </thead>
        @if(count($products)>0)
            <tbody class="product-list">
            @foreach($products as $index=>$product)
        <tr>
            <input type="hidden" name="searchproduct[{!! $index !!}][name]" value="{!! $product['name'] !!}">
            <input type="hidden" name="searchproduct[{!! $index !!}][price]" value="{!! $product['price'] !!}">
            <input type="hidden" name="searchproduct[{!! $index !!}][url]" value="{!! $product['DetailPageURL'] !!}">
            <input type="hidden" name="searchproduct[{!! $index !!}][description]" value="{!! $product['description']!!}">
            <input type="hidden" name="searchproduct[{!! $index !!}][product_image]" value="{!! $product['image_url']!!}">
            <input type="hidden" name="searchproduct[{!! $index !!}][advertiser_name]" value="{!! $product['advertiser_name']!!}">
            <td><input type="checkbox" name="searchproduct[{!! $index !!}][select]" value="1"></td>
            <td><img class="product-image" src="{!! $product['image_url'] !!}"></td>
            <td><a href="{!! $product['DetailPageURL'] !!}" target="_blank"><strong>{!! $product['name'] !!}</strong></a><br/>{!! \Illuminate\Support\Str::words(strip_tags($product['description']),25) !!}</td>
            <td>{!! $product['price'] !!}</td>
            <td>
                <?php
                $img_src = null;
                $epartner_repo = App::make(\App\Repositories\EpartnerRepository::class);
                $epartner = $epartner_repo->getByName($product['advertiser_name']);
                if(!empty($epartner)){
                    $img_src = \App\Models\EpartnerMedia::IMAGE_PATH.'/'.$epartner->image;
                }
                ?>
                @if($img_src!=null)
                    <img class="product-image" src="{!! url($img_src) !!}">
                @else
                    {!!  $product['advertiser_name']!!}
                @endif
            </td>
        </tr>
    @endforeach

@else
    <tr>No record found</tr>
    @endif

    </table>
</div>