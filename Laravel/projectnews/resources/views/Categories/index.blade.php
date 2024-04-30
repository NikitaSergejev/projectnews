
@extends('layouts.app')
@section('content')
<!-- content categories list -->
<div class="box-header with-border">
    <h3 class="box-title"><strong>Categories manage</strong></h3>
</div>
<div class="box-body">
    <div class="add">
        <a href="/addcategory" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
    </div>
    <div class="container">
        <table id="example1" class="table table-bordered">
            <thead>
                <th>Category name</th>
                <th>Tools</th>
            </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{$category->name}}</td>
                    <td>
                        <form id="deleteCategoryForm-{{ $category->id }}" action="{{ url('deletecategory/' . $category->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <a href="{{ url('editcategory/' . $category->id) }}" title="edit" type="button" class="btn btn-success btn-sm edit btn-flat">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <button type="button" class="btn btn-danger btn-sm delete btn-flat" onclick="confirmDeleteCategory({{ $category->id }})">
                                <i class="fa fa-trash-o"></i> Delete
                            </button>
                        </form>
                    </td>

                    <script>
                        function confirmDeleteCategory(categoryId) {
                            var result = confirm("Are you sure you want to delete this category?");
                            if (result) {
                                document.getElementById('deleteCategoryForm-' + categoryId).submit();
                            }
                        }
                    </script>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>
@endsection
