<div class="d-flex align-items-center">
    <span class="badge badge-primary">{{ is_null($cart) ? 0 : $cart->count() }}</span>
    <a class="nav-link" href="{{ route('checkout') }}"><i class="fa fa-shopping-cart" style="font-size: 25px;" aria-hidden="true"></i></a>
</div>