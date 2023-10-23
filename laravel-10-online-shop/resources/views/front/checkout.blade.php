@extends('front.layouts.app')
@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="#">Shop</a></li>
                    <li class="breadcrumb-item">Checkout</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-9 pt-4">
        <div class="container">
            <form id="orderForm" name="orderForm" action="" method="post">
                @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="sub-title">
                        <h2>Shipping Address</h2>
                    </div>
                    <div class="card shadow-lg border-0">
                        <div class="card-body checkout-form">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" name="first_name" value="{{ !empty($customerAddress) ? $customerAddress->first_name : '' }}" id="first_name" class="form-control" placeholder="First Name">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" value="{{ !empty($customerAddress) ? $customerAddress->last_name : '' }}" name="last_name" id="last_name" class="form-control" placeholder="Last Name">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" name="email" value="{{ !empty($customerAddress) ? $customerAddress->email : '' }}" id="email" class="form-control" placeholder="Email">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <select name="country" id="country" class="form-control">
                                            <option value="">Select a Country</option>
                                            @if($countries->isNotEmpty())
                                            @foreach($countries as $item)
                                            <option {{ !empty($customerAddress && $customerAddress->country_id == $item->id) ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <textarea name="address" id="address" cols="30" rows="3" placeholder="Address" class="form-control">{{ !empty($customerAddress) ? $customerAddress->address : '' }}</textarea>
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" name="appartment" value="{{ !empty($customerAddress) ? $customerAddress->apartment : '' }}" id="appartment" class="form-control" placeholder="Apartment, suite, unit, etc. (optional)">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <input type="text" name="city" id="city" value="{{ !empty($customerAddress) ? $customerAddress->city : '' }}" class="form-control" placeholder="City">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <input type="text" name="state" id="state" class="form-control" value="{{ !empty($customerAddress) ? $customerAddress->state : '' }}" placeholder="State">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <input type="text" name="zip" id="zip" class="form-control" value="{{ !empty($customerAddress) ? $customerAddress->zip : '' }}" placeholder="Zip">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" name="mobile" id="mobile" class="form-control" value="{{ !empty($customerAddress) ? $customerAddress->mobile : '' }}" placeholder="Mobile No.">
                                        <p></p>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <textarea name="order_notes" id="order_notes" cols="30" rows="2" placeholder="Order Notes (optional)" class="form-control">{{ !empty($customerAddress) ? $customerAddress->notes : '' }}</textarea>
                                        <p></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sub-title">
                        <h2>Order Summery</h2>
                    </div>
                    <div class="card cart-summery">
                        <div class="card-body">

                            @foreach(Cart::content() as $item)
                            <div class="d-flex justify-content-between pb-2">
                                <div class="h6">{{ $item->name }} X {{ $item->qty }}</div>
                                <div class="h6">${{ $item->price }}</div>
                            </div>
                            @endforeach
                            <div class="d-flex justify-content-between summery-end">
                                <div class="h6"><strong>Subtotal</strong></div>
                                <div class="h6"><strong>${{ Cart::subtotal() }}</strong></div>
                            </div>
                            <div class="d-flex justify-content-between summery-end">
                                <div class="h6"><strong>Discount</strong></div>
                                <div class="h6"><strong id="discount-card">${{ $discount }}</strong></div>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <div class="h6"><strong>Shipping</strong></div>
                                <div class="h6"><strong id="shippingAmount">${{ number_format($totalShippingCharge) }}</strong></div>
                            </div>
                            <div class="d-flex justify-content-between mt-2 summery-end">
                                <div class="h5"><strong>Total</strong></div>
                                <div class="h5"><strong id="grandTotal">${{ number_format($grandTotal, 2) }}</strong></div>
                            </div>
                        </div>
                    </div>
                    <div class="input-group apply-coupon mt-4">
                        <input type="text" placeholder="Coupon Code" class="form-control" name="discount_code" id="discount_code">
                        <button class="btn btn-dark" type="button" id="apply-discount">Apply Coupon</button>
                    </div>
                    <div id="discount-response-wrapper">
                        @if(Session::has('code'))
                            <div class="mt-4" id="discount-row">
                                <strong>${{ Session::get('code')[0]['code'] }}</strong>
                                <a class="btn btn-sm btn-danger" id="removeDiscount"><i class="fa fa-times"></i></a>
                            </div>
                        @endif
                    </div>

                    <div class="card payment-form">
                        <h3 class="card-title h5 mb-3">Payment Details</h3>
                        <div>
                            <input type="radio" checked name="payment_method" value="cod" id="payment_method_one">
                            <label id="payment_method_one" class="form-check-label">COD</label>
                        </div>
                        <div>
                            <input type="radio" name="payment_method" value="cod" id="payment_method_two">
                            <label id="payment_method_two" class="form-check-label">Stripe</label>
                        </div>


                        <div class="card-body p-0 d-none mt-3" id="card-payment-form">
                            <div class="mb-3">
                                <label for="card_number" class="mb-2">Card Number</label>
                                <input type="text" name="card_number" id="card_number" placeholder="Valid Card Number" class="form-control">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="expiry_date" class="mb-2">Expiry Date</label>
                                    <input type="text" name="expiry_date" id="expiry_date" placeholder="MM/YYYY" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="expiry_date" class="mb-2">CVV Code</label>
                                    <input type="text" name="expiry_date" id="expiry_date" placeholder="123" class="form-control">
                                </div>
                            </div>

                        </div>
                        <div class="pt-4">
{{--                            <a href="#" class="btn-dark btn btn-block w-100">Pay Now</a>--}}
                            <button type="submit" class="btn-dark btn btn-block w-100">Pay Now</button>
                        </div>
                    </div>


                    <!-- CREDIT CARD FORM ENDS HERE -->

                </div>
            </div>
            </form>
        </div>
    </section>
@endsection
@section('customJs')
    <script>
        $('#payment_method_one').click(function (){
            if($(this).is(':checked') === true){
                $('#card-payment-form').addClass('d-none')
            }
        })
        $('#payment_method_two').click(function (){
            if($(this).is(':checked') === true){
                $('#card-payment-form').removeClass('d-none')
            }
        })

        $('#orderForm').submit(function (event){
            event.preventDefault()
            $('button[type="submit"]').prop('disabled', true);

            $.ajax({
                type: 'post',
                url: '{{ route("front.processCheckout") }}',
                dataType: 'json',
                data: $(this).serializeArray(),
                success: function (response){
                    $('button[type="submit"]').prop('disabled', false);
                    var errors = response.errors
                    if(response.status === false)
                    {
                    if(errors.first_name)
                    {
                        $('#first_name').addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(errors.first_name)
                    }else{
                        $('#first_name').removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                    }
                    if(errors.last_name)
                    {
                        $('#last_name').addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(errors.last_name)
                    }else{
                        $('#last_name').removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                    }
                    if(errors.email)
                    {
                        $('#email').addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(errors.email)
                    }else{
                        $('#email').removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                    }
                    if(errors.country)
                    {
                        $('#country').addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(errors.country)
                    }else{
                        $('#country').removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                    }
                    if(errors.address)
                    {
                        $('#address').addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(errors.address)
                    }else{
                        $('#address').removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                    }
                    if(errors.state)
                    {
                        $('#state').addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(errors.state)
                    }else{
                        $('#state').removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                    }
                    if(errors.city)
                    {
                        $('#city').addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(errors.city)
                    }else{
                        $('#city').removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                    }
                    if(errors.zip)
                    {
                        $('#zip').addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(errors.zip)
                    }else{
                        $('#zip').removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                    }
                    if(errors.mobile)
                    {
                        $('#mobile').addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(errors.mobile)
                    }else{
                        $('#mobile').removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                    }
                    }else{
                        window.location.href = "{{ url('/thanks/') }}/"+response.orderId
                    }
                },
                error: function (){
                    console.log('some thing went wrong')
                }
            })
        })
        $('#country').change(function (){
            $.ajax({
                url: '{{ route("front.getOrderSummery") }}',
                type: 'post',
                data: {_token: "{{csrf_token()}}", country_id: $(this).val()},
                dataType: 'json',
                success: function (res)
                {
                    $('#shippingAmount').html('$'+res.shippingCharge)
                    $('#grandTotal').html('$'+res.grandTotal)
                }
            })
        })

        $('#apply-discount').click(function (){
            $.ajax({
                url: '{{ route("front.applyDiscount") }}',
                type: 'post',
                data: {_token: "{{csrf_token()}}", code: $('#discount_code').val(), country_id: $('#country').val()},
                dataType: 'json',
                success: function (res)
                {
                    if(res.status === true)
                    {

                        $('#shippingAmount').html('$'+res.shippingCharge)
                        $('#grandTotal').html('$'+res.grandTotal)
                        $('#discount-card').html('$'+res.discount)
                        $('#discount-response-wrapper').html(res.discountString)
                    }else{
                        $('#discount-response-wrapper').html(`<span class="text-danger">${res.message}</span`)
                    }
                }
            })
        })

        $('body').on('click', '#removeDiscount', function (){
            $.ajax({
                url: '{{ route("front.removeCoupon") }}',
                type: 'post',
                data: {_token: "{{csrf_token()}}", country_id: $('#country').val()},
                dataType: 'json',
                success: function (res)
                {
                    if(res.status === true)
                    {
                        $('#shippingAmount').html('$'+res.shippingCharge)
                        $('#grandTotal').html('$'+res.grandTotal)
                        $('#discount-card').html('$'+res.discount)
                        $('#discount-row').html('')
                        $('#discount_code').html('')

                    }
                }
            })
        })


    </script>
@endsection
