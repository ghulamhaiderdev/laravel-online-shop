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
                <a href="{{ route('subcategories.index') }}" class="btn btn-primary">Back</a>
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
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ $subCategory->name }}">
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug" value="{{ $subCategory->slug }}" readonly>
                            <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Select Category</label>
                            <select name="category_id" id="category-id" class="form-control">
                                <option>--Select--</option>
                                {!! \App\Models\Category::getCategories() !!}
                            </select>
                        </div>

                    </div>
                    <input type="hidden" id="image_id" name="image_id">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status">Status</label>
                           <select class="form-control" id="status" name="status">
                               <option value="1" {{ $subCategory->status == '1' ? 'selected': '' }}>Active</option>
                               <option value="0" {{ $subCategory->status == '0' ? 'selected': '' }}>Block</option>
                           </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-5 pt-3">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('subcategories.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
        </form>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection

@section('customJs')
    <script>
        let categoryID = "{{$subCategory->category_id}}"
        $('#category-id').val(categoryID)

        $('#categoryForm').submit(function (event){

            event.preventDefault()
            var element = $(this)
            console.log(element.serializeArray())
            $.ajax({
                url: '{{ route('subcategories.update', $subCategory->id) }}',
                type: 'put',
                // data: element.serializeArray(),
                data: {
                    "_token": "{{ csrf_token() }}",
                    "name": $('#name').val(),
                    "slug": $('#slug').val(),
                    "status": $('#status').val(),
                    "category_id": $("#category-id").val()
                },
                dataType: 'json',
                success: function (response){
                    if(response['status'] === true)
                    {
                    window.location.href = "{{ route('subcategories.index') }}"
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
                            window.location.href = "{{ route('subcategories.index') }}"
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


    </script>
@endsection
