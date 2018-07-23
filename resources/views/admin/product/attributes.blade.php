<div class="row">
    <div class="col-md-12">
        <div class="box-body">
            <?php
            $selected_attribute_options = [];
            $selected_attrs = [];
            if (count($product_attributes) > 0 && count($product_attributes->attributeValues) > 0) {
                foreach ($product_attributes->attributeValues as $attribute) {
                    $selected_attribute_options[] = $attribute->attribute_option_id;
                    $selected_attrs[$attribute->attribute_id][] = $attribute->attribute_option_id;
                }
            }


            ?>

            @if($attribute_set)
                @foreach($attribute_set->attributes as $attribute)
                    <div class="form-group">
                        {!! Form::label('attribute_name', $attribute->english->attribute_name, ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <select class="form-control select2" multiple="multiple"
                                    name="attributes[{!! $attribute->attribute_id !!}][]"
                                    data-placeholder="Select option" style="width: 100%;">
                                @foreach($attribute->options as $option)
                                    <option value="{!! $option->attribute_option_id !!}"
                                            {!! (isset($selected_attrs[$attribute->attribute_id]) && in_array($option->attribute_option_id,$selected_attrs[$attribute->attribute_id]))?'selected':'' !!} >
                                        {!! $option->english->option_name !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endforeach
                <input type="hidden" name="old_attribute_option_id"
                       value="{!! implode(',',$selected_attribute_options) !!}">
            @endif

        </div>
    </div>
</div>
