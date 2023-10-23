@extends('admin.layout.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Change Password</h1>
                </div>
                <div class="col-sm-6 text-right">
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="" method="post" name="changePasswordForm" id="changePasswordForm">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Old Password</label>
                                    <input type="text" name="old_password" id="old_password" class="form-control" placeholder="Old Password">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email">New Password</label>
                                    <input type="text" name="new_password" id="new_password" class="form-control" placeholder="NewPassword" >
                                    <p></p>
                                </div>
                            </div>
                            @csrf
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="showHome">Confirm Password</label>
                                    <input type="text" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" >
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@section('customJs')
    <script>
        $('#changePasswordForm').submit(function (event){

            event.preventDefault()
            var element = $(this)
            console.log(element.serializeArray())
            $.ajax({
                url: '{{ route('admin.changePassword') }}',
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                success: function (response){
                    if(response['status'] === true)
                    {
                        window.location.href = "{{ route('admin.showChangePasswordForm') }}"
                        $('#old_password')
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                        $('#new_password')
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                        $('#confirm_password')
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                    }else{

                        let errors = response['errors'];
                        if(errors['name'])
                        {
                            $('#old_password')
                                .addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['old_password'])
                        }else{
                            $('#old_password')
                                .removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html('')
                        }
                        if(errors['new_password'])
                        {
                            $('#new_password')
                                .addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['new_password'])
                        }else{
                            $('#new_password')
                                .removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html('')
                        }
                        if(errors['confirm_password'])
                        {
                            $('#confirm_password')
                                .addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['confirm_password'])
                        }else{
                            $('#confirm_password')
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
