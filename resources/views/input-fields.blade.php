<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
                <div class="card-body">
                    <form action="{{ url('categories') }}" method="POST">
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
                                <th>Libellé</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td><input type="text" name="moreFields[0][libelle]" placeholder="Taper le Libellé" class="form-control" /></td>
                                <td><input type="text" name="moreFields[0][description]" placeholder="Taper la Description" class="form-control" /></td>
                                <td><button type="button" name="add" id="add-btn" class="btn btn-success">Ajouter Plus</button></td>
                            </tr>
                        </table>
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                    </form>
                </div>

        <script type="text/javascript">
            var i = 0;
            $("#add-btn").click(function(){
            ++i;
            $("#dynamicAddRemove").append('<tr><td><input type="text" name="moreFields['+i+'][libelle]" placeholder="Taper le Libellé" class="form-control" /></td><td><input type="text" name="moreFields['+i+'][description]" placeholder="Taper la Descrption" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
            });
            $(document).on('click', '.remove-tr', function(){
            $(this).parents('tr').remove();
            });
        </script>
</body>
</html>
