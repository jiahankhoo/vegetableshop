@extends('layout')
@section('content')
<style>
    body {
  font-family: 'lato', sans-serif;
}
.container {
  max-width: 1000px;
  margin-left: auto;
  margin-right: auto;
  padding-left: 10px;
  padding-right: 10px;
}

h2 {
  font-size: 26px;
  margin: 20px 0;
  text-align: center;
  small {
    font-size: 0.5em;
  }
}

.responsive-table {
  li {
    border-radius: 3px;
    padding: 25px 30px;
    display: flex;
    justify-content: space-between;
    margin-bottom: 25px;
  }
  .table-header {
    background-color: #95A5A6;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.03em;
  }
  .table-row {
    background-color: #ffffff;
    box-shadow: 0px 0px 9px 0px rgba(0,0,0,0.1);
  }
  .col-1 {
    flex-basis: 10%;
  }
  .col-2 {
    flex-basis: 40%;
  }
  .col-3 {
    flex-basis: 25%;
  }
  .col-4 {
    flex-basis: 25%;
  }

  @media all and (max-width: 767px) {
    .table-header {
      display: none;
    }
    .table-row{

    }
    li {
      display: block;
    }
    .col {

      flex-basis: 100%;

    }
    .col {
      display: flex;
      padding: 10px 0;
      &:before {
        color: #6C7A89;
        padding-right: 10px;
        content: attr(data-label);
        flex-basis: 50%;
        text-align: right;
      }
    }
  }
}
</style>
<div class="vegetables_section layout_padding">
    <div class="container">
        <div class="vegetables_section_2 layout_padding">
            <div class="row">
                @unless(count($carts)==0)
                <ul class="responsive-table" style="width:100%">
                    <li class="table-header">
                        <div class="col col-4">Product Name</div>
                        <div class="col col-2">Quantity</div>
                        <div class="col col-3">Amount Due</div>
                        <div class="col col-1">Remove</div>
                      </li>
                        @foreach ($carts as $cart)
                        <li class="table-row">
                            <div class="col col-4" data-label="Product Name">{{ $cart->p_name }}</div>
                            <div class="col col-2" data-label="Quantity">{{ $cart->qty }}</div>
                            <div class="col col-3" data-label="Amount">${{ $cart->price }}</div>
                            <div class="col col-1" data-label="status">

                                <form action="{{ route('delete',$cart->id) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit"  >Delete</button>
                                </form>
                            </div>
                        </li>
                        @endforeach
                        <li class="table-row">
                            <div class="col col-7" >Total Amount</div>
                            <div class="col col-3" style="text-align:left">${{ $total_price[0]->t_price }}</div>
                            <div class="col col-2" style="text-align:left">
                            <form action="/checkout/{{ $carts[0]->c_id }}" method="POST">
                                @csrf
                                @method("PUT")
                                <button type="submit" name="checkout" class="buy_bt_1"  >Checkout</button>
                            </form>
                            </div>
                        </li>
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
