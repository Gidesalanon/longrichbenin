<div class="modal fade" id="modalDeleteProduct{{ $product->id}}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white">Confirmation de la suppression</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('products.destroy', $product->id)}}">
                @csrf
                {{ method_field('delete') }}
                <div class="modal-body">
                    <p class="text-center">Voulez-vous vraiment supprimer ce produit ?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger">Supprimer</button>
                    <button class="btn btn-dark" data-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>
