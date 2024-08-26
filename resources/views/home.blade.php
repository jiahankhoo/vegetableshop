@extends('layout')
@section('content')
<div class="vegetables_section layout_padding">
    <div class="container">
        <div class="image_2"><img src="images/img-2.png" alt="Vegetables Image"></div>
        <h1 class="about_taital">Our Vegetables</h1>
        <p class="lorem_text">Readers may be distracted by the readable content of a page.</p>

        <div class="vegetables_section_2 layout_padding">
            <div class="row">
                @forelse ($products as $product)
                <div class="col-md-3">
                    <div class="box_section">
                        <div class="image_4">
                            <img src="images/img-4.png" alt="{{ $product->name }}">
                        </div>
                        <h2 class="dolor_text">
                            $<span style="color: #ebc30a;">{{ $product->p_price }}</span>
                        </h2>
                        <h2 class="dolor_text">{{ $product->name }}</h2>
                        <h2 class="dolor_text_1">1 kg</h2>
                        <p class="tempor_text">{{ $product->p_desc }}</p>

                        <!-- Mass input and Total Price Display -->
                        <form method="POST" action="/addcart/{{ $product->id }}">
                        <div>
                        <button onclick="adjustMass(-1, {{ $product->id }}, {{ $product->p_price }})">-</button>
                            <input type="number" id="mass_{{ $product->id }}" value="1" name="qty" readonly> kg
                            <button type="button" onclick="adjustMass(1, {{ $product->id }}, {{ $product->p_price }})">+</button>
                            <p>Total Price: $<span id="total_price_{{ $product->id }}">{{ $product->p_price }}</span></p>
                            <input type="hidden" id="total_price_input_{{ $product->id }}" name="price" value="{{ $product->p_price }}">
                        </div>

                        <div class="buy_bt_1 active">

                                @csrf
                                <input type="hidden" name="mass" id="form_mass_{{ $product->id }}" value="1">
                                <button type="submit" class="buy_bt_1">Add to cart</button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col">
                    <p class="tempor_text">No Product found</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

<!-- External JavaScript section -->
<script>
    function calculateTotalPrice(price, mass, productId) {
        let totalPrice = (price * mass).toFixed(2);
        document.getElementById('total_price_' + productId).innerText = totalPrice;
        document.getElementById('total_price_input_' + productId).value = totalPrice;
    }

    function adjustMass(value, productId, price) {
        let massInput = document.getElementById('mass_' + productId);
        let newMass = parseInt(massInput.value) + value;

        if (newMass < 1) { // Ensure at least 1 kg
            newMass = 1;
        }

        massInput.value = newMass;
        document.getElementById('form_mass_' + productId).value = newMass; // Update hidden input for form
        calculateTotalPrice(price, newMass, productId);
    }
</script>
