<div>
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible" role="alert"> 
            {{ session('message') }}
            
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
    <div class="row">
        @foreach($products as $p)
        <div class="col-sm-4 mb-2">
            <div class="card" style="width: 18rem;">
                <a href="{{ route('products.show', ['product' => $p->slug]) }}"><img class="card-img-top" src="{{ asset('storage/public/' . $p->thumbnail ) }}" alt="Card image cap"></a>
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">${{ $p->price }} <sup>00</sup> </h5>
                    <p><span>12x $ 10.75 sin interés</span></p>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-outline-primary" wire:click="addToCart('{{ $p->slug }}')">Add to cart</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

