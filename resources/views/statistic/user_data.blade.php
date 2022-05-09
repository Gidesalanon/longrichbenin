<div class="main-page">
    <div class="tables">
        <div class="grid-bottom table-responsive widget-shadow">
            <h4>@foreach ($marge_nets as $marge_net) {{ \Carbon\Carbon::parse($marge_net->created_at)->format('F Y')}} @endforeach</h4>
					<table class="table table-bordered table-striped no-margin grd_tble" id="myTable">
						<thead>
							<tr>
								<th>DATE</th>
								<th>PRODUITS</th>
								<th>
									QTÉ JOURNALIÈRE VENDUE
								</th>
                                <th>
                                    TOTAL PV
								</th>
                                <th>
                                    CA
								</th>
                                <th>
                                    MARGE BRUTE/JOUR
								</th>
                                <th>
                                    COMMISSION (0.7)
								</th>
                                <th>
                                    MARGE NET (0.3)
								</th>
							</tr>
						</thead>
						<tbody>
                            @foreach ($sellings as $selling)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($selling->date)->setTimezone('Africa/Porto-Novo')->format('d/m/y')}}</td>

                                    <td> <span data-toggle="tooltip" data-placement="top" data-original-title="Prix Partenaire: {{ $prixpartenaires[$selling->product_id] }} Prix Client: {{ $prixclients[$selling->product_id] }} PV: {{ $pvProducts[$selling->product_id] }}">
                                        {{ $products[$selling->product_id] }}</span>
                                    </td>
                                    <script>$(function () {
                                        $('[data-toggle="tooltip"]').tooltip()
                                        })
                                    </script>
                                    <td>{{$selling->total_qte}}</td>
                                    <td>{{$selling->total_pv}}</td>
                                    <td class="myDIV">{{$selling->total_ca}}</td>
                                    <td class="myDIV">{{$selling->total_benefice}}</td>
                                    <td class="myDIV">{{$selling->total_benefice * 0.7}}</td>
                                    <td class="myDIV">{{$selling->total_benefice - $selling->total_benefice * 0.7}}</td>
                                </tr>
                            @endforeach
                            <thead style="font-weight:bold;">
                                <td colspan="3">TOTAL:</td>
                                <td class="myDIV"> @foreach ($pv_sums as $pv_sum) {{$pv_sum->total_pv}} @endforeach </td>
                                <td class="myDIV"> @foreach ($ca_sums as $ca_sum) {{$ca_sum->total_ca}} @endforeach</td>
                                <td class="myDIV"> @foreach ($benefice_sums as $benefice_sum) {{$benefice_sum->total_benefice}} @endforeach</td>
                                <td class="myDIV"> @foreach ($marge_commissions as $marge_commission) {{$marge_commission->sum_com}} @endforeach</td>
                                <td class="myDIV"> @foreach ($marge_nets as $marge_net) {{$marge_net->margeNet}} @endforeach</td>
                            </thead>
                            <thead style="font-weight:bold;">
                                <td colspan="6">FRAIS FINANCIERS (0.4):</td>
                                <td class="myDIV">@foreach ($marge_commissions as $marge_commission) {{$marge_commission->sum_com * 0.4}} @endforeach</td>
                                <td>-</td>
                            </thead>
                            <thead style="font-weight:bold;">
                                <td colspan="6">AVANCE SUR COMMISSION (30.000):</td>
                                <td class="myDIV">@foreach ($marge_commissions as $marge_commission) {{$marge_commission->sum_com * 0.4 - 30000}} @endforeach</td>
                                <td>-</td>
                            </thead>
						</tbody>
					</table> </br>
		</div>
	</div>
</div>
