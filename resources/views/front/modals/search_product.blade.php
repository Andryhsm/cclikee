<div class="modal fade" id="search-product-modal" role="dialog" aria-hidden="true">
  <div class="modal-dialog search-product-modal" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form method="GET" id="form-search" action="{!! route('search') !!}">   
               <input type="text" id="search-product-input" name="q" placeholder="Chercher ..." name="search-product">
               <button type="submit" class="icon btn icon-search search-product btn-search"></button>
            </form>
      </div>
    </div>
  </div>
</div>