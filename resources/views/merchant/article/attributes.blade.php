<div class="row">
    <div class="col-md-12">
        
        @if($attribute_set)
            @foreach($attribute_set->attributes as $key=>$attribute)
                <div class="form-group">
                    {!! Form::label('attribute_name', $attribute->french->attribute_name, ['class' => 'control-label']) !!}
                    <div class="">
                        <input type="text" name="attribute_id[0][]" class="hidden attribute_id" value="{!! $attribute->attribute_id !!}" />
                            <select class="form-control attribute_option"
                                    name="attributes[0][]"
                                    data-placeholder="Select option" style="width: 100%;">
                            @foreach($attribute->options as $option)
                                <option value="{!! $option->attribute_option_id !!}">{!! $option->french->option_name !!}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
</div>
