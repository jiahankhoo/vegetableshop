@extends('layout')
@section("content")
<div class="vegetables_section layout_padding">
    <div class="container">
        <div class="image_2"><img src="images/img-2.png"></div>
        <h1 class="about_taital">Our Vegetables</h1>
        <p class="lorem_text">Reader will be distracted by the readable content of a</p>
        <div class="vegetables_section_2 layout_padding">
            <div class="row">
                @unless(count($products)==0)
                @foreach ($products as $product)
                <div class="col-">
                    <div class="box_section">
                      <div class="image_4"><img src="images/img-4.png"></div>
                      <h2 class="dolor_text">$<span style="color: #ebc30a;">{{ $product->p_price }}</span></h2>
                      <h2 class="dolor_text">{{ $product->name }}</h2>
                      <h2 class="dolor_text_1">1 kg</h2>
                      <p class="tempor_text">{{ $product->p_desc }} </p>

                      <!-- Mass input and Total Price Display -->
                      <div>
                          <button onclick="adjustMass(-100, {{ $product->id }})">-</button>
                          <input type="number" id="mass_{{ $product->id }}" value="1000" readonly onchange="Calculate({{ $product->p_price }}, this.value / 1000)">
                          <button onclick="adjustMass(100, {{ $product->id }})">+</button>
                          <p>Total Price: $<span id="total_price_{{ $product->id }}"></span></p>
                          <input type="hidden" id="total_price_input_{{ $product->id }}" value="{{ $product->p_price }}">
                      </div>

                      <div class="buy_bt_1 active">
                        <form method="POST" action="/addcart/{{ $product->id }}">
                            @csrf
                            <button type="submit" class="buy_bt_1" id="addcart"  >Add to cart</button>
                        </form>
                      </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col">
                    <p class="tempor_text">No Product found</p>
                </div>
                @endunless
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function Calculate(price, mass, productId) {
        let totalPrice = parseFloat(price) * parseFloat(mass);
        document.getElementById('total_price_' + productId).innerText = totalPrice.toFixed(2);
        document.getElementById('total_price_input_' + productId).value = totalPrice.toFixed(2);
    }

    function adjustMass(value, productId) {
        let massInput = document.getElementById('mass_' + productId);
        let newMass = parseInt(massInput.value) + value;
        if (newMass < 100) { // Ensure at least 100g
            newMass = 100;
        }
        massInput.value = newMass;
        Calculate({{ $product->p_price }}, newMass / 1000, productId);
    }
</script>
