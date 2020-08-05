<form action="{{ route('stripe.checkout') }}" method="post" id="payment-form">
  @csrf
  <div class="form-row">
    <label for="card-element">
      Credit or debit card
    </label>
    <div id="card-element">
      <!-- A Stripe Element will be inserted here. -->
    </div>

    <!-- Used to display form errors. -->
    <div id="card-errors" role="alert"></div>
  </div>

  <div class="text-right">
    <button class="btn mt-2 btn-outline-primary">Submit Payment</button>
  </div>
</form>