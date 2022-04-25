<div class="modal fade" id="modalInputProduct{{ $product->id}}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white">Suivie d'Entrée du produit {{ $product->nomprod }} </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <p class="text-center">
                        <div class="form-group">
                           Produit: {{$product->nomprod}}<br>
                           Valeur Actuelle: {{$product->qte}}<br>
                           Valeur Précédente: <br>
                           Date & Heure: <br>
                        </div>
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-dark" data-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>
