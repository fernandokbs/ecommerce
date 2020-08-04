<div>
    <div class="container">
        <h2 class="text-center mb-4 mt-3">Resumen</h2>

        <div class="row">
            <div class="col-sm-7">
                <div class="card">
                    <div class="card-body">
                        <table class="table text-center table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Eliminar</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td><button class="btn btn-danger">Eliminar</button></td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <th></th>
                                    <td class="font-weight-bold">Total</td>
                                    <td class="font-weight-bold">{{ $products->sum('price') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center mb-5">Método de pago</h3>
                        <div class="row justify-content-center">
                            <div class="col-sm-8">
                                @include('svg.paypal')
                                @include('svg.stripe')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
