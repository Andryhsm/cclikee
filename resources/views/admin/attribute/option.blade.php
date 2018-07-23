<div class="row form-group option_row master-option-container hidden">
    <div class="col-xs-1 order_data">
        <center><a class='up' onclick="up(this);" href='#'><i class="glyphicon glyphicon-arrow-up"></i></a> <a class='down'  onclick="down(this);" href='#'><i class="glyphicon glyphicon-arrow-down"></i></a></center>
    </div>
    <!-- <div class="col-xs-3 option_name english_input">
        <input type="text" class="form-control" placeholder="Option Name(English)">
    </div> -->
    <div class="col-xs-3 option_name french_input">
        <input type="text" class="form-control" placeholder="Nom de l'option">
    </div>
    <div class="col-xs-3 option_value">
        <input type="text" class="form-control" placeholder="Valeur de l'option">
    </div>

    <div class="col-xs-3 color_picker hidden">
        <div class="input-group colorpicker">
            <input type="text" class="form-control">
            <div class="input-group-addon">
                <i></i>
            </div>
        </div>
    </div>
    <div class="col-xs-2 button">
        <button type="button" class="btn btn-primary">Ajouter une option</button>
    </div>
</div>

<div id="attribute_option" class="box-body">
    <div class="row">
        <div class="col-xs-1">
            <center><label>Ordre</label></center>
        </div><!-- 
        <div class="col-xs-3">
            <label>Option Name(English)</label>
        </div> -->
        <div class="col-xs-3 french_input">
          <label>Nom de l'option</label>
        </div>
        <div class="col-xs-3">
            <label>Valeur de l'option</label>
        </div>
        <div class="col-xs-2">
        </div>
        <div class="col-xs-2">
        </div>
    </div>
    <div id="option_list">
        @if($attribute && count($attribute->options) > 0)
            <?php $old_option = []; ?>
            @foreach($attribute->options as $index=>$option)
                <?php $old_option[] = $option->attribute_option_id;
                      $index = $index+1;
                    ?>
                <div class="row form-group option_row" id="{!! $index !!}">
                    <div class="col-xs-1 order_data">
                        <center><a class='up' onclick="up(this);" href='#'><i class="glyphicon glyphicon-arrow-up"></i></a> <a class='down' onclick="down(this);" href='#'><i class="glyphicon glyphicon-arrow-down"></i></a></center>
                    </div>
                    <div class="col-xs-3 option_name french_input">
                        <input type="text" class="form-control" value="{!! (!empty($option->french)) ? $option->french->option_name : null !!}"
                               name="options[{!! $index !!}][fr_name]" placeholder="Nom de l'option">
                    </div>

                    @if($attribute->type == '2')
                        <div class="col-xs-3 option_value">
                            <input type="text" class="form-control" value="{!! $option->option_value !!}"
                                   name="options[{!! $index !!}][value]" placeholder="Valeur de l'option">
                        </div>
                    @else
                        <div class="col-xs-3 color_picker ">
                            <div class="input-group colorpicker">
                                <input type="text" name="options[{!! $index !!}][value]"
                                       value="{!! $option->option_value !!}"
                                       class="form-control">
                                <div class="input-group-addon">
                                    <i></i>
                                </div>
                            </div>
                        </div>
                    @endif
                    <input type="hidden" name="options[{!! $index !!}][attribute_option_id]"
                           value="{!! $option->attribute_option_id !!}">
                    <div class="col-xs-2 button">
                        <?php $class = ($index > 1) ? 'btn-danger remove_option' : 'btn-primary add_option'; ?>
                        <button type="button"
                                class="btn {!! $class !!}">{!! ($index > 1) ? "Effacer l'option" : "Ajouter une option"  !!}</button>
                    </div>
                </div>
            @endforeach
            <input type="hidden" name="old_options" value="{!! implode(',',$old_option) !!}">
            
        @else

            <div class="row form-group option_row" id="1">
                <div class="col-xs-1">
                    <center><a class='up' onclick="up(this);" href='#'><i class="glyphicon glyphicon-arrow-up"></i></a> <a class='down' onclick="down(this);" href='#'><i class="glyphicon glyphicon-arrow-down"></i></a></center>
                </div>
                <!-- <div class="col-xs-3 option_name english_input">
                    <input type="text" class="form-control" name="options[1][en_name]" placeholder="Option Name(English)">
                </div> -->
                <div class="col-xs-3 option_name french_input">
                    <input type="text" class="form-control" name="options[1][fr_name]" placeholder="Nom de l'option">
                </div>
                <div class="col-xs-3 option_value">
                    <input type="text" class="form-control" name="options[1][value]" placeholder="Valeur de l'option">
                </div>
                <div class="col-xs-3 color_picker hidden">
                    <div class="input-group colorpicker">
                        <input type="text" class="form-control">
                        <div class="input-group-addon">
                            <i></i>
                        </div>
                    </div>
                </div>
                <div class="col-xs-2 button">
                    <button type="button" class="btn btn-primary add_option">Ajouter une option</button>
                </div>
            </div>

        @endif
    </div>
</div>