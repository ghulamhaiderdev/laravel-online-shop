@extends('front.layouts.app')
@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                    <li class="breadcrumb-item">Settings</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-11 ">
        <div class="container  mt-5">
            <div class="row">
                <div class="col-md-12">
                    @include('admin.message')
                </div>
                <div class="col-md-3">
                    @include('front.account.common.sidebar')
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">Personal Information</h2>
                        </div>
                        <form name="profileForm" method="post" id="profileForm">
                            @csrf
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" value="{{ $user->name }}" placeholder="Enter Your Name" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" value="{{ $user->email }}" placeholder="Enter Your Email" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" id="phone" value="{{ $user->phone }}" placeholder="Enter Your Phone" class="form-control">
                                </div>

{{--                                <div class="mb-3">--}}
{{--                                    <label for="phone">Address</label>--}}
{{--                                    <textarea name="address" id="address" class="form-control" cols="30" rows="5" placeholder="Enter Your Address"></textarea>--}}
{{--                                </div>--}}

                                <div class="d-flex">
                                    <button class="btn btn-dark">Update</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="card mt-4">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">Address</h2>
                        </div>
                        <form name="profileAddress" method="post" id="profileAddress">
                            @csrf
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name">First Name</label>
                                        <input type="text" name="first_name" id="first_name" value="{{ (!empty($customerAddress))  ? $customerAddress->first_name : '' }}" placeholder="Enter Your First Name" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email">Last Name</label>
                                        <input type="text" name="last_name" id="last_name" value="{{ (!empty($customerAddress))  ? $customerAddress->last_name : '' }}" placeholder="Enter Your Last Name" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email" value="{{ (!empty($customerAddress))  ? $customerAddress->email : '' }}" placeholder="Enter Your Email" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone">Mobile</label>
                                        <input type="text" name="mobile" id="mobile" value="{{ (!empty($customerAddress))  ? $customerAddress->mobile : '' }}" placeholder="Enter Your Mobile" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone">Countries</label>
                                        <select name="country" id="country" class="form-control">
                                            <option>Select a country</option>
                                            @if($countries->isNotEmpty())
                                                @foreach($countries as $country)
                                                    <option {{ ($customerAddress->country_id == $country->id) ? 'selected' : ''}} value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone">Address</label>
                                        <textarea name="address" id="address" class="form-control" cols="30" rows="5" placeholder="Enter Your Address">{{ (!empty($customerAddress))  ? $customerAddress->address : '' }}</textarea>
                                    </div>
                                    <div class="mb-3 col-md-6 ">
                                        <label for="phone">Apartment</label>
                                        <input type="text" name="apartment" id="apartment" value="{{ (!empty($customerAddress))  ? $customerAddress->apartment : '' }}" placeholder="Enter Your Last Apartment" class="form-control">
                                    </div>
                                    <div class="mb-3 col-md-6 ">
                                        <label for="phone">City</label>
                                        <input type="text" name="city" id="city" value="{{ (!empty($customerAddress))  ? $customerAddress->city : '' }}" placeholder="Enter Your Last City" class="form-control">
                                    </div>
                                    <div class="mb-3 col-md-6 ">
                                        <label for="phone">State</label>
                                        <input type="text" name="state" id="state" value="{{ (!empty($customerAddress))  ? $customerAddress->state : '' }}" placeholder="Enter Your Last State" class="form-control">
                                    </div>
                                    <div class="mb-3 col-md-6 ">
                                        <label for="phone">Zip</label>
                                        <input type="text" name="zip" id="zip" value="{{ (!empty($customerAddress))  ? $customerAddress->zip : '' }}" placeholder="Enter Your Last Zip" class="form-control">
                                    </div>
                                    <div class="d-flex">
                                        <button class="btn btn-dark">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('customJs')
    <script>
        $('#productForm').submit(function (event){

            event.preventDefault()
            var element = $(this)

            $.ajax({
                url: '{{ route('account.updateProfile') }}',
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                success: function (response){
                    if(response['status'] === true)
                    {
                        window.location.href = "{{ route('account.profile') }}"
                        $('#name')
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                        $('#productForm #email')
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                        $('#phone')
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                    }else{

                        let errors = response['errors'];
                        if(errors['name'])
                        {
                            $('#name')
                                .addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['name'])
                        }else{
                            $('#name')
                                .removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html('')
                        }
                        if(errors['email'])
                        {
                            $('#email')
                                .addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['email'])
                        }else{
                            $('#productForm #email')
                                .removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html('')
                        }
                        if(errors['phone'])
                        {
                            $('#phone')
                                .addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['phone'])
                        }else{
                            $('#phone')
                                .removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html('')
                        }
                    }

                },
                error: function (jqXHR, exception){

                }
            })
        })

        $('#profileAddress').submit(function (event){

            event.preventDefault()
            var element = $(this)

            $.ajax({
                url: '{{ route('account.updateAddress') }}',
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                success: function (response){
                    if(response['status'] === true)
                    {
                        window.location.href = "{{ route('account.profile') }}"
                        $('#first_name')
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                        $('#last_name')
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                        $('#email')
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                        $('#mobile')
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                        $('#country')
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                        $('#address')
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                        $('#state')
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                        $('#city')
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                        $('#zip')
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                    }else{

                        let errors = response['errors'];
                        if(errors['first_name'])
                        {
                            $('#profileAddress #first_name')
                                .addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['first_name'])
                        }else{
                            $('#profileAddress #first_name')
                                .removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html('')
                        }
                        if(errors['last_name'])
                        {
                            $('#profileAddress #last_name')
                                .addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['last_name'])
                        }else{
                            $('#profileAddress #last_name')
                                .removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html('')
                        }
                        if(errors['email'])
                        {
                            $('#profileAddress #email')
                                .addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['email'])
                        }else{
                            $('#profileAddress #email')
                                .removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html('')
                        }
                        if(errors['mobile'])
                        {
                            $('#profileAddress #mobile')
                                .addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['mobile'])
                        }else{
                            $('#profileAddress #mobile')
                                .removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html('')
                        }
                        if(errors['country_id'])
                        {
                            $('#profileAddress #country')
                                .addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['country_id'])
                        }else{
                            $('#profileAddress #country')
                                .removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html('')
                        }
                        if(errors['address'])
                        {
                            $('#profileAddress #address')
                                .addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['address'])
                        }else{
                            $('#profileAddress #address')
                                .removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html('')
                        }
                        if(errors['state'])
                        {
                            $('#profileAddress #state')
                                .addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['state'])
                        }else{
                            $('#profileAddress #state')
                                .removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html('')
                        }
                        if(errors['zip'])
                        {
                            $('#profileAddress #zip')
                                .addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['zip'])
                        }else{
                            $('#profileAddress #zip')
                                .removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html('')
                        }
                    }

                },
                error: function (jqXHR, exception){

                }
            })
        })
    </script>
@endsection
