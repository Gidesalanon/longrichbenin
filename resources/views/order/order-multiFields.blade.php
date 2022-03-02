<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
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
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="moreFields[0][product_id]" class="form-control b"
                                        oninput="document.getElementById('input_price_0').value=document.getElementById('input_qte_0').value * document.getElementById('select_product_0').value.split('|')[1];"
                                        id="select_product_0" required>
                                            <option selected hidden></option>
                                            @foreach($products as $product)
                                            <option value="{{ $product['id']}}|{{ $product['prixclient']}}">{{ $product['nomprod']}}</option>
                                            @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" id="input_qte_0" oninput="document.getElementById('input_price_0').value=this.value * document.getElementById('select_product_0').value.split('|')[1];" name="moreFields[0][qte]" placeholder="Taper votre Quantité" class="form-control c" />
                                </td>
                                <td>
                                    <input type="number" id="input_price_0" name="moreFields[0][prix]" class="form-control1 a" disabled/>
                                </td>
                                <td><textarea name="moreFields[0][description]" placeholder="Laisser un Avis" class="form-control"></textarea></td>
                                <td><button type="button" name="add" id="add-btn" class="btn btn-success"><i class="fa fa-plus"></i></button></td>

                            </tr>
                        </table>
                                <button type="submit" class="btn btn-success">Save</button>
                    </form>
                </div>
        <script type="text/javascript">
            let i = 0;
            $("#add-btn").click(function(){
            ++i;
            $("#dynamicAddRemove").append(`
            <tr>
                <td>
                    <select name="moreFields['+i+'][product_id]" id="select_product_`+i+`" class="form-control e"
                        oninput="document.getElementById('input_price_`+i+`').value=document.getElementById('input_qte_`+i+`').value * document.getElementById('select_product_`+i+`').value.split('|')[1];"
                        required>
                        <option selected hidden></option>
                        @foreach($products as $product)
                            <option value="{{ $product['id']}}|{{ $product['prixclient']}}">{{ $product['nomprod']}}</option>
                        @endforeach
                    </select>
                </td>

                <td>
                    <input type="number" id="input_qte_`+i+`"
                    oninput="document.getElementById('input_price_`+i+`').value=this.value * document.getElementById('select_product_`+i+`').value.split('|')[1];"
                    name="moreFields['+i+'][qte]"
                    placeholder="Taper votre Quantité"
                    class="form-control f" required>
                </td>

                <td>
                    <input type="number" id="input_price_`+i+`"
                    name="moreFields['+i+'][prix]" class="form-control d" disabled>
                </td>

                <td>
                    <textarea name="moreFields['+i+'][description]" placeholder="Laisser un Avis" class="form-control"></textarea>
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

        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
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
