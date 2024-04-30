
@extends('layouts.app')
@section('content')
<!-- content categories list-->
<div class="box-header with-border">
    <h3 class="box-title"><strong>Categories manage - Add</strong></h3>
</div>
<div class="box-body">
    <div class="add">
        <a href="categorylist" class="btn btn-primary btn-sm btn-flat"></i>Back</a>
    </div>
    <div class="container">
        <!-- Display validation errors -->
        @include('common.errors')
        <!-- New Category Form -->
        <form action="{{url('addcategory')}}" method="POST" class="form-horizontal">
            {{csrf_field()}}

            <!-- Category Name-->
            <div class="form-group">
                <label for="task-name" class="col-sm-3 control-label">Category</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" id="category-name" value="">
                </div>
            </div>
            <!-- Add Category Button-->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-btn fa-plus"></i>Add Category
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection

