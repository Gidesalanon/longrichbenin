<div class="modal fade" id="modalShowOrder{{ $ordergroup->id}}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Commande du {{ \Carbon\Carbon::parse($ordergroup->created_at)->setTimezone('Africa/Porto-Novo')->format('d/m/y à H:i:s')}}</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <div class="table-responsive bs-example widget-shadow">
                        @foreach ($ordergroup->orders as $order)
                        N°: <strong>{{ $order->id }} </strong>
                        </br>
                        Produit: {{ $products[$order->product_id] }}</br>
                        Quantité: {{ $order->qte }}</br>
                        Prix: <span class="myDIV">{{ $order->prix }}</span> </br>
                        Status:

                        @if ($order->approve == 0)
                            <span class="label label-default">Encours d'Approbation...</span>
                        @elseif ($order->execute == "0")
                            <a href="{{ route('manager.orders.execute', $order->id) }}">
                                <span class="label label-default" title="Exécuter cette commande"><i class="fa fa-stop"></i> Commande Inexécutée</span>
                            </a>
                        @elseif ($order->status == "1")
                            <span class="label label-success">Vendu <i class="fa fa-check"></i></span>
                        @else
                            <a href="{{ route('manager.orders.unExecute', $order->id) }}">
                                <span class="badge badge-success" title="Annuler cette commande"><i class="fa fa-play-circle"></i> Commande Exécutée</span></a>
                            </a>
                        @endif
                        </br></br>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-dark" data-dismiss="modal">Fermer</button>
                </div>
        </div>
    </div>
</div>
