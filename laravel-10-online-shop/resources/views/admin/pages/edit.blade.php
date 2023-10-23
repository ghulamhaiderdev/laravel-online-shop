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
                    <a href="{{ route('pages.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="" method="post" name="pageForm" id="pageForm">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" value="{{ $page->name }}" id="name" class="form-control" placeholder="Name">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">slug</label>
                                    <input type="text" name="slug" id="slug" value="{{ $page->slug }}" class="form-control" placeholder="slug">
                                    <p></p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email">Content</label>
                                    <textarea name="content_page" class="form-control" cols="30" rows="10" id="content">{{ $page->content }}</textarea>
                                    <p></p>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('pages.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@section('customJs')
    <script>
        $('#pageForm').submit(function (event){

            event.preventDefault()
            var element = $(this)

            $.ajax({
                url: '{{ route('pages.update', $page->id) }}',
                type: 'put',
                data: element.serializeArray(),
                dataType: 'json',
                success: function (response){
                    if(response['status'] === true)
                    {
                        window.location.href = "{{ route('pages.index') }}"
                        $('#name')
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                        $('#slug')
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
                        if(errors['slug'])
                        {
                            $('#slug')
                                .addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['slug'])
                        }else{
                            $('#slug')
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

        $('#name').change(function (){
            var element = $(this)
            $.ajax({
                url: '{{ route('getSlug') }}',
                type: 'get',
                data: {title: element.val()},
                dataType: 'json',
                success: function (response){
                    if(response['status'] === true)
                    {
                        $('#slug').val(response.slug)
                    }
                }
            });
        });


    </script>
@endsection
