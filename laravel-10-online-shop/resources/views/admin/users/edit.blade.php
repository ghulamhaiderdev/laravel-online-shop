@extends('admin.layout.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit User</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="" method="post" name="userForm" id="userForm">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" value="{{ $user->name }}" id="name" class="form-control" placeholder="Name">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Password</label>
                                    <input type="text" name="password" id="password" class="form-control" placeholder="Password">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" value="{{ $user->email }}" id="email" class="form-control" placeholder="Email" >
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email">Phone</label>
                                    <input type="text" name="phone" id="phone" value="{{ $user->phone }}" class="form-control" placeholder="Phone" >
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" {{ ($user->status) == 1 ? 'selected' : ''}}>Active</option>
                                        <option value="0" {{ ($user->status) == 0 ? 'selected' : ''}}>Block</option>
                                    </select>
                                    <p></p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@section('customJs')
    <script>
        $('#userForm').submit(function (event){

            event.preventDefault()
            var element = $(this)

            $.ajax({
                url: '{{ route('users.update', $user->id) }}',
                type: 'put',
                data: element.serializeArray(),
                dataType: 'json',
                success: function (response){
                    if(response['status'] === true)
                    {
                        window.location.href = "{{ route('users.index') }}"
                        $('#name')
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                        $('#email')
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                        $('#phone')
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                        $('#password')
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
                            $('#email')
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
                        if(errors['password'])
                        {
                            $('#password')
                                .addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['password'])
                        }else{
                            $('#password')
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
