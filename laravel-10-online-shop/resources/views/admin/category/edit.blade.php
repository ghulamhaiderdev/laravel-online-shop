@extends('admin.layout.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Category</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('categories.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <form action="" method="post" name="categoryForm" id="categoryForm">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ $category->name }}">
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug" value="{{ $category->slug }}" >
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">

                            <div id="image" class="dropzone dz-clickable">
                                <div class="dz-message needsclick">
                                    <br>Drop files here or click to upload.<br><br>
                                </div>
                            </div>
                        </div>
                        @if(!empty($category->image))
                            <img width="250" src="{{ asset('uploads/category/thumb/'.$category->image) }}">
                        @endif
                    </div>
                    <input type="hidden" id="image_id" name="image_id">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status">Status</label>
                           <select class="form-control" id="status" name="status">
                               <option value="1" {{ $category->status == '1' ? 'selected': '' }}>Active</option>
                               <option value="0" {{ $category->status == '0' ? 'selected': '' }}>Block</option>
                           </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="showHome">Show Home</label>
                            <select class="form-control" id="showHome" name="show_home">
                                <option value="Yes" {{ $category->show_home == 'Yes' ? 'selected': '' }}>Yes</option>
                                <option value="No" {{ $category->show_home == 'No' ? 'selected': '' }}>No</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-5 pt-3">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('categories.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
        </form>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection

@section('customJs')
    <script>
        $('#categoryForm').submit(function (event){

            event.preventDefault()
            var element = $(this)
            console.log(element.serializeArray())
            $.ajax({
                url: '{{ route('categories.update', $category->id) }}',
                type: 'put',
                // data: element.serializeArray(),
                data: {
                    "_token": "{{ csrf_token() }}",
                    "name": $('#name').val(),
                    "slug": $('#slug').val(),
                    "status": $('#status').val(),
                    "image_id": $("#image_id").val()
                },
                dataType: 'json',
                success: function (response){
                    if(response['status'] === true)
                    {
                    window.location.href = "{{ route('categories.index') }}"
                        $('#name')
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                        $('#slug')
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html('')
                    }else{
                        if(response['notFound'] === true)
                        {
                            window.location.href = "{{ route('categories.index') }}"
                        }
                        let errors = response['error'];
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

        Dropzone.autoDiscover = false;
        const dropzone = $("#image").dropzone({
            init: function() {
                this.on('addedfile', function(file) {
                    if (this.files.length > 1) {
                        this.removeFile(this.files[0]);
                    }
                });
            },
            url:  "{{ route('temp-images.create') }}",
            maxFiles: 1,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, success: function(file, response){
                $("#image_id").val(response.image_id);
                //console.log(response)
            }
        });
    </script>
@endsection
