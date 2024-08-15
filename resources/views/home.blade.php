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
                <div class="col">
                    <div class="box_section">
                      <div class="image_4"><img src="images/img-4.png"></div>
                      <h2 class="dolor_text">$<span style="color: #ebc30a;">{{ $product->p_price }}</span></h2>
                      <h2 class="dolor_text">{{ $product->name }}</h2>
                      <h2 class="dolor_text_1">1 kg</h2>
                      <p class="tempor_text">{{ $product->p_desc }} </p>
                      <div class="buy_bt_1 active">
                        <form method="POST" action="/addcart/{{ $product->id }}">
                            @csrf
                            <button type="submit" class="buy_bt_1"  >Add to cart</button>
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
