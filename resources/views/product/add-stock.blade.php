<div class="modal fade" id="modalAddProduct{{ $product->id}}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white">Ajout de {{ $product->nomprod }} </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('product.addstock', $product->id)}}">
                @csrf
                {{ method_field('PATCH') }}
                <div class="modal-body">
                    <p class="text-center">
                        <div class="form-group">
                           <input type="number"
                           onKeyUp="if(this.value<1){this.value='';}"
                           class="form-control @error('qte') is-invalid @enderror" min="1" id="qte" name="qte" placeholder="Tapez la Quantité svp" required>
                           @error('qte')
                                    <span class="invalid-feedback" role="alert" style="color:red;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success">Ajouter</button>
                    <button class="btn btn-dark" data-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>
