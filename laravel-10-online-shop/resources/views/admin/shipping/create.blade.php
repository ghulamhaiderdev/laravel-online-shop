@extends('admin.layout.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Shipping Management</h1>
                </div>
{{--                <div class="col-sm-6 text-right">--}}
{{--                    <a href="{{ route('categories.index') }}" class="btn btn-primary">Back</a>--}}
{{--                </div>--}}
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            @include('admin.message')
            <form action="" method="post" name="shippingForm" id="shippingForm">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                     <select name="country" class="form-control" id="country">
                                            <option value="">Select a Country</option>
                                            @if($countries->isNotEmpty())
                                                @foreach($countries as $country)
                                                  <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                                    <option value="rest_of_world">Rest of the world</option>
                                            @endif

                                        </select>

                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount">
                                <p></p>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                    @if($shippingCharges->isNotEmpty())
                                        @foreach($shippingCharges as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ ($item->country_id == 'rest_of_world') ? 'Rest of the world' : $item->name }}</td>
                                                <td>${{ $item->amount }}</td>
                                                <td>
                                                    <a href="{{ route('shipping.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                                                    <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteCategory({{ $item->id }})">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@section('customJs')
    <script>
        $('#shippingForm').submit(function (event){

            event.preventDefault()
            var element = $(this)
            console.log(element.serializeArray())
            $.ajax({
                url: '{{ route('shipping.store') }}',
                type: 'post',
                // data: element.serializeArray(),
                data: element.serializeArray(),
                dataType: 'json',
                success: function (response){
                    if(response['status'] === true)
                    {
                        window.location.href = "{{ route('shipping.create') }}"

                    }else{

                        let errors = response['errors'];
                        if(errors['country'])
                        {
                            $('#country')
                                .addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['country'])
                        }else{
                            $('#country')
                                .removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html('')
                        }
                        if(errors['amount'])
                        {
                            $('#amount')
                                .addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['amount'])
                        }else{
                            $('#amount')
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

        const deleteCategory = (id) => {
            var url = "{{ route('shipping.destroy', 'ID') }}";
            let newUrl = url.replace('ID', id)
            if(confirm('Are you sure'))
            {
                $.ajax({
                    url: newUrl,
                    type: 'delete',
                    // data: element.serializeArray(),
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response['status']) {
                            window.location.href = "{{ route('shipping.create') }}"
                        }
                    }
                })
            }

        }
    </script>
@endsection
