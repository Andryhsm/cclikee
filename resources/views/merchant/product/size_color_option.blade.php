<!-- Need for clone -->
<div class="row form-group size_input_row master-input-size-container hidden">
        <div class="row col-sm-5">   
            <label for="sizes" class="col-sm-3 label-size"></label>
            <div class="col-sm-9 size_input">
                <input type="text" class="form-control" placeholder="taille 1">
            </div>
        </div>
        <div class="row col-sm-5">
            <label for="sizes" class="col-sm-3">Quantité</label>
            <div class="col-xs-9 size_input_quantity">
                <input type="text" class="form-control" placeholder="quantité">
            </div>
        </div>
        <div class="col-sm-2 button">
            <button type="button" class="btn btn-primary">x</button>
        </div>
</div>

<div class="row form-group color_input_row master-input-color-container hidden">
        <div class="row col-sm-5">   
            <label for="colors" class="col-sm-3 label-color"></label>
            <div class="col-sm-9 color_input">
                <input type="text" class="form-control" placeholder="couleur 1">
            </div>
        </div>
        <div class="row col-sm-5">
            <label for="colors" class="col-sm-3">Quantité</label>
            <div class="col-xs-9 color_input_quantity">
                <input type="text" class="form-control" placeholder="quantité">
            </div>
        </div>
        <div class="col-sm-2 button">
            <button type="button" class="btn btn-primary">x</button>
        </div>
</div>


<!-- end Need for clone -->

<div class="" id="size_list_input">
    <div class="row form-group size_input_row" id="1">
        <div class="row col-sm-5">   
            <label for="sizes" class="col-sm-3">Taille 1</label>
            <div class="col-sm-9 size_input">
                <input type="text" class="form-control" name="sizes[1]" placeholder="Taille 1">
            </div>
        </div>
        <div class="row col-sm-5">
            <label for="sizes" class="col-sm-3">Quantité</label>
            <div class="col-xs-9 size_input_quantity">
                <input type="text" class="form-control" name="quantities_size[1]" placeholder="Quantité">
            </div>
        </div>
        <div class="col-sm-10 mt-10 button">
            <button type="button" style="float:right;" class="btn btn-primary add_size_input">Ajouter une taille</button>
        </div>
    </div>
</div>

<div class="" id="color_list_input">
    <div class="row form-group color_input_row" id="1">
        <div class="row col-sm-5">   
            <label for="colors" class="col-sm-3">Couleur 1</label>
            <div class="col-sm-9 color_input">
                <input type="text" class="form-control" name="colors[1]" placeholder="Couleur 1">
            </div>
        </div>
        <div class="row col-sm-5">
            <label for="colors" class="col-sm-3">Quantité</label>
            <div class="col-xs-9 color_input_quantity">
                <input type="text" class="form-control" name="quantities_color[1]" placeholder="Quantité">
            </div>
        </div>
        <div class="col-sm-10 mt-10 button">
            <button type="button" style="float:right;" class="btn btn-primary add_color_input">Ajouter une couleur</button>
        </div>
    </div>
</div>