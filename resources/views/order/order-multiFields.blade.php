<!DOCTYPE html>
<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<style>
select#select_product_0,input#input_qte_0,input#input_p_0 {
    border: none;
    margin: 0;
    padding: 0;
}
td{
    padding:0 !important;
}
</style>
                <div class="card-body">
                <form action="{{ url('orders') }}" method="POST">
                    @csrf
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if (Session::has('success'))
                            <div class="alert alert-success text-center">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p>{{ Session::get('success') }}</p>
                            </div>
                        @endif
                        <table class="table table-bordered" id="dynamicAddRemove">
                            <tr>
                                <th>Produit</th>
                                <th>Qté</th>
                                <th>Prix</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="moreFields[0][product_id]" class="form-control @error('moreFields[0][product_id]') is-invalid @enderror b"
                                        oninput="
                                        document.getElementById('input_p_0').value=document.getElementById('input_qte_0').value * document.getElementById('select_product_0').value.split('|')[1];
                                        document.getElementById('input_price_0').value=document.getElementById('input_qte_0').value * document.getElementById('select_product_0').value.split('|')[1];
                                        "
                                        id="select_product_0" required>
                                            <option selected hidden></option>
                                            @foreach($products as $product)
                                            <option value="{{ $product['id']}}|{{ $product['prixclient']}}">{{ $product['nomprod']}}</option>
                                            @endforeach
                                    </select>
                                    @error('moreFields[0][product_id]')
                                        <span class="invalid-feedback" role="alert" style="color:red;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="number" min="0"
                                    onKeyUp="if(this.value<1){this.value='';}"
                                    id="input_qte_0" oninput="
                                    document.getElementById('input_p_0').value=this.value * document.getElementById('select_product_0').value.split('|')[1];" name="moreFields[0][qte]"
                                    document.getElementById('input_price_0').value=this.value * document.getElementById('select_product_0').value.split('|')[1];" name="moreFields[0][qte]
                                    " placeholder="Taper votre Quantité" class="form-control @error('moreFields[0][qte]') is-invalid @enderror c" />

                                    @error('moreFields[0][qte]')
                                        <span class="invalid-feedback" role="alert" style="color:red;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>

                                <td>
                                    <input type="hidden" id="input_price_0" name="moreFields[0][prix]" class="form-control1 @error('moreFields[0][prix]') is-invalid @enderror a"/>
                                    <input type="number" id="input_p_0" name="rtp" class="form-control d" disabled/>
                                    @error('moreFields[0][prix]')
                                        <span class="invalid-feedback" role="alert" style="color:red;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>
                                <td><button type="button" name="add" id="add-btn" class="btn btn-success"><i class="fa fa-plus"></i></button></td>

                            </tr>
                        </table>
                                <button type="submit" class="btn btn-success">Enregistrer</button>
                    </form>
                </div>
        <script type="text/javascript">
            let i = 0;
            $("#add-btn").click(function(){
            ++i;
            $("#dynamicAddRemove").append(`
            <tr>
                <td>
                    <select name="moreFields[`+i+`][product_id]" id="select_product_`+i+`" class="form-control @error('moreFields[`+i+`][product_id]') is-invalid @enderror e"
                        oninput="
                        document.getElementById('input_p_`+i+`').value=document.getElementById('input_qte_`+i+`').value * document.getElementById('select_product_`+i+`').value.split('|')[1];
                        document.getElementById('input_price_`+i+`').value=document.getElementById('input_qte_`+i+`').value * document.getElementById('select_product_`+i+`').value.split('|')[1];
                        "
                        required>
                        <option selected hidden></option>
                        @foreach($products as $product)
                            <option value="{{ $product['id']}}|{{ $product['prixclient']}}">{{ $product['nomprod']}}</option>
                        @endforeach
                    </select>
                    @error('moreFields[`+i+`][product_id]')
                                        <span class="invalid-feedback" role="alert" style="color:red;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                </td>

                <td>
                    <input type="number" id="input_qte_`+i+`"
                    oninput="
                    document.getElementById('input_p_`+i+`').value=this.value * document.getElementById('select_product_`+i+`').value.split('|')[1];
                    document.getElementById('input_price_`+i+`').value=this.value * document.getElementById('select_product_`+i+`').value.split('|')[1];
                    "
                    name="moreFields[`+i+`][qte]"
                    placeholder="Taper votre Quantité"
                    class="form-control @error('moreFields[`+i+`][qte]') is-invalid @enderror f" required>
                    @error('moreFields[`+i+`][qte]')
                                        <span class="invalid-feedback" role="alert" style="color:red;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                </td>

                <td>
                    <input type="hidden" style="display:none;" id="input_price_`+i+`"
                    name="moreFields[`+i+`][prix]" class="form-control @error('moreFields[`+i+`][prix]') is-invalid @enderror d">
                    <input type="number" id="input_p_`+i+`" name="rantanplan" name="moreFields[`+i+`][prix]" class="form-control d" disabled/>
                    @error('moreFields[`+i+`][prix]')
                                        <span class="invalid-feedback" role="alert" style="color:red;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                </td>

                <td>
                    <button type="button" class="btn btn-danger remove-tr"><i class="fa fa-times"></i></button>
                </td>
            </tr>
            `);
        });
            $(document).on('click', '.remove-tr', function(){
            $(this).parents('tr').remove();
            });
        </script>

		<script>
			$(document).ready(function(){
				$('#menu').on('change', function(){
					var valeur = $(this).val();
					$("div.layer").hide();
					$("#layer"+valeur).fadeIn();
				});
			});
		</script>
</body>
</html>
