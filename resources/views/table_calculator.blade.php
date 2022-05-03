<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <link rel="stylesheet" href="style.css" media="screen" title="no title" charset="utf-8">
    <script src="https://code.jquery.com/jquery-2.2.4.js" charset="utf-8"></script>
    <meta name="robots" content="noindex,follow" />
  </head>
  <body>
    <div class="shopping-cart">
      <!-- Title -->
      <div class="title">
        Ma Calculatrice Longrich
      </div>

      <!-- Product #1 -->

    @foreach ($products as $product)
        <div class="item">
        <div class="buttons">
          <span class="delete-btn"></span>
        </div>

        <div class="image">
          <img src="{{ asset('imgprod/'.$product->image) }}" style="width:120px; height:92px;" class="img-responsive" alt="">
        </div>

        <div class="description">
          <span>{{$product->nomprod}}</span>
          <span>{{$product->nbpv}}</span>
          <span>{{$product->prixpartenaire}}</span>
        </div>

        <div class="quantity">
          <button class="plus-btn" type="button" name="button">
            <img src="plus.svg" alt="" />
          </button>
          <input type="text" name="name" value="1">
          <button class="minus-btn" type="button" name="button">
            <img src="minus.svg" alt="" />
          </button>
        </div>

        <div class="total-price">{{$product->prixclient}}</div>
      </div>

    @endforeach


      <div class="title">
        Total:...FCFA
        PV:...
      </div>
    </div>

    <script type="text/javascript">
      $('.minus-btn').on('click', function(e) {
    		e.preventDefault();
    		var $this = $(this);
    		var $input = $this.closest('div').find('input');
    		var value = parseInt($input.val());

    		if (value > 1) {
    			value = value - 1;
    		} else {
    			value = 0;
    		}

        $input.val(value);

    	});

    	$('.plus-btn').on('click', function(e) {
    		e.preventDefault();
    		var $this = $(this);
    		var $input = $this.closest('div').find('input');
    		var value = parseInt($input.val());

    		if (value < 100) {
      		value = value + 1;
    		} else {
    			value =100;
    		}

    		$input.val(value);
    	});

      $('.like-btn').on('click', function() {
        $(this).toggleClass('is-active');
      });
    </script>
  </body>
</html>
