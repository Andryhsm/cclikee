<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" id="{!! ($delete_multiple == false) ? 'confirm' : 'confirm_delete_multiple' !!}">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                @if($delete_multiple == false)
                    Voulez-vous vraiment supprimer?
                @else
                    Voulez-vous vraiment supprimer ces produits sélectionner?
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-block btn-merchant-filled" id="delete">Supprimer</button>
                <button type="button" data-dismiss="modal" class="btn btn-block btn-merchant-filled">Annuler</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div style="position: fixed;top: 0px;width: 100%;text-align: center; z-index: 999999;">
    <div class="notification_area" style="display:none;">Loading..</div>
</div>