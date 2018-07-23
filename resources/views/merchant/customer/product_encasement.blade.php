
<div class="row mt-30 product_input_row master-input-size-container hidden">
        <div class="col-md-12">
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group product_name">
                            <label class="control-label">Nom produit</label>
                            <select class=" form-control required">
                            
                            </select>
                        </div>
                        <div class="form-group parent_category">
                            <label for="parent_category" class="control-label">Catégorie</label>
                            <select class="form-control required">
                                <option></option>
                            </select>
                        </div>
                        <div class="form-group product_size">
                            <label for="product_size" class="control-label">Taille</label>
                            <select class="form-control required">
                                <option></option>
                            </select>
                        </div>
                        <div class="form-group discount">
                            <label for="discount" class="control-label">Rémise</label>
                            <div class="input-group">
                                <input type="number" placeholder="Rémise" class="form-control required"/>
                                 <span class="input-group-addon"> % </span>
                            </div>
                        </div>
                    </div>
                        
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group product_reference">
                            <label for="product_reference" class="control-label">Référence</label>
                            <input type="text" placeholder="Référence" class=" form-control required"/>
                        </div>
                        <div class="form-group sub_category">
                            <label for="sub_category" class="control-label">Sous catégorie</label>
                            <select class="form-control required">
                                <option></option>
                            </select>
                        </div>
                        <div class="form-group product_color">
                            <label for="product_color" class="control-label">Couleur</label>
                            <select class="form-control required">
                                <option></option>
                            </select>
                        </div>
                        <div class="form-group promo_code">
                            <label for="promo_code" class="control-label">Code promo</label>
                            <select class="form-control required">
                            </select>
                        </div>
                    </div>
                
                <div class="row">
                    <div class="product_price hidden">  
                        <input type="text" placeholder="price" />
                    </div>
                    <div class="product_quantity hidden">  
                        <input type="text" class="form-control required" placeholder="price" />
                    </div>
                </div>
                <div class="col-sm-12 mt-10 button">
                    <button type="button" style="float:right;" class="btn btn-danger remove_size_input">Annuler ce produit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="content" id="size_list_input">
    <div class="row product-content row product_input_row " id="1">
        <div class="col-md-12">
            <div class="box-body mt-30">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group product_name">
                            <label for="product_name" class="control-label">Nom produit</label>
                            <select id="product_name1" name="product_name[1]" data-content-range="1" class="select-product-name form-control required">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="parent_category" class="control-label">Catégorie</label>
                            <select id="parent_category1" name="parent_category[1]" data-content-range="1" class="select-parent-category form-control required">
                                <option></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_size" class="control-label">Taille</label>
                            <select id="product_size1" name="product_size[1]" class="select-product-size form-control required">
                                <option></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="discount" class="control-label">Rémise</label>
                            <div class="input-group">
                                <input type="number" name="discount[1]" placeholder="Rémise" id="discount1" class="input-discount form-control required"/>
                                <span class="input-group-addon"> % </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="product_reference" class="control-label">Référence</label>
                            <input type="text" name="product_reference[1]" placeholder="Référence" id="product_reference1" class="input-product-reference form-control required"/>
                           
                        </div>
                        <div class="form-group">
                            <label for="sub_category" class="control-label">Sous catégorie</label>
                            <select id="sub_category1" name="sub_category[1]" class="select-sub-category form-control required">
                                <option></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_color" class="control-label">Couleur</label>
                            <select id="product_color1" name="product_color[1]" class="select-product-color form-control required">
                                <option></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="promo_code" class="control-label">Code promo</label>
                            <select name="promo_code[1]"  id="promo_code1" class="select-promo-code form-control required">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="product_price hidden">  
                        <input type="text" name="product_price[1]" id="product_price1" class="input-product-price form-control required" placeholder="price" />
                    </div>
                    <div class="product_quantity hidden">  
                        <input type="text" name="product_quantity[1]" id="product_quantity1" class="input-product-quantity form-control required" placeholder="price" />
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
<input type="text" class="hidden" id="total_ht" name="total_ht"/>
 <input type="text" class="hidden" id="total_ttc" name="total_ttc"/>
<section>
    <div class="">
        <div class="col-md-12 mt-10 mb-30">
            <div class=""> <!-- box-footer -->
                <button type="button" style="float:right;" class="btn btn-merchant-filled add_size_input">Produit suivant</button>
            </div>
        </div>
    </div>
</section>
<div class="footer-button"><!-- box-footer -->
    <a href="#tab_1" data-toggle="tab" class="btn btn-merchant-filled">Precedent</a>
    <a class="btn btn-merchant-filled pull-right" onclick="validate_product_info();" id="paiement"> Paiement </a>
    <a type="button"  id="next-in-paiement" class="btn btn-merchant-filled hidden"  href="#tab_3" data-toggle="tab" >Valid</a>
</div>