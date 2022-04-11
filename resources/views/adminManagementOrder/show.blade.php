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
                        Par: <strong>{{ $users[$ordergroup->user_id] }} </strong>
                        <a href="{{ route('order.edit', $order->id) }}">
                            <i class="fa fa-pencil" title="Modifier"></i>
                        </a>

                            <a onclick="return confirm('Êtes vous sûr de vouloir supprimer cette ligne?')" href="{{ route('admin.lineOrder.destroy', $order->id)}}">
                                    <i class="fa fa-trash-o" style="color:red;" title="Supprimer"></i>
                            </a>
                            <form action="{{ route('admin.lineOrder.destroy', $order->id)}}" method="delete">
                                @csrf
                                {{ method_field('delete') }}
                            </form>
                        </br>

                        Nom du Produit: {{ $products[$order->product_id] }}</br>
                        Quantité: {{ $order->qte }}</br>
                        Prix: {{ $order->prix }} </br>
                        Status:
                        @if ($order->approve == "0")

                                                        <a href="{{ route('admin.orders.Oneapprove', $order->id) }}">
                                                            <span class="label label-default" title="Approuver cette commande"><i class="fa fa-check-circle"></i>Non Approuvée</span>
                                                        </a>

                                                @else
                                                            <a href="{{ route('admin.orders.Onedesapprove', $order->id) }}">
                                                                <span class="badge badge-success" title="Désapprouver cette commande">Approuvée</span></a>
                                                            </a>
                                                @endif </br></br>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-dark" data-dismiss="modal">Fermer</button>
                </div>
        </div>
    </div>
</div>
