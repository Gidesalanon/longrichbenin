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
                        <span>N°: <strong>{{ $order->id }} </strong></span>

                        @if ($qte_prod[$order->product_id] < $order->qte && $order->execute == "1" && $order->approve == "1")
                            <span class="badge badge-success">Approuvée | Exécutée</span>
                        @else
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
                        @endif



                            </br><span data-toggle="tooltip" data-placement="right" title="" data-original-title="Stock: {{$qte_prod[$order->product_id]}}">Produit: {{ $products[$order->product_id] }}</span></br>
                                <script>$(function () {
                                    $('[data-toggle="tooltip"]').tooltip()
                                    })
                                </script>

                        <span>Quantité: {{ $order->qte }}</span> </br>
                        Prix: <span class="myDIV">{{ $order->prix }}</span> </br>
                        Status:
                        @if ($qte_prod[$order->product_id] < $order->qte && $order->execute == "1" && $order->approve == "1")
                                    </br><span style="color:red; font-family:italic;"> Rupture de stock après l'exécution de cette commande, pensez à le renouveller!</span>
                            @elseif ($qte_prod[$order->product_id] < $order->qte)
                                </br><span style="color:red; font-family:italic;"> Impossible d'approuver cette commande, car sa quantité dépasse le stock initial. Modifier la quantité du stock ou de cette commande pour l'approuver.</span>

                            @elseif ($order->approve == "0")
                                                    Status:
                                                            <a href="{{ route('admin.orders.Oneapprove', $order->id) }}">
                                                                <span class="label label-default" title="Approuver cette commande"><i class="fa fa-check-circle"></i> Non Approuvée</span>
                                                            </a>
                                                            @else
                                                                @if ($order->execute == "1")
                                                                    <span class="badge badge-success" title="Désapprouver cette commande">
                                                                        Approuvée | Exécutée
                                                                    </span>
                                                                @else
                                                                    <a href="{{ route('admin.orders.Onedesapprove', $order->id) }}">
                                                                        <span class="badge badge-success" title="Désapprouver cette commande"><i class="fa fa-check-circle"></i> Approuvée</span></a>
                                                                    </a>
                                                                @endif @endif</br></br>
                                                    @endforeach

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-dark" data-dismiss="modal">Fermer</button>
                </div>
        </div>
    </div>
</div>
