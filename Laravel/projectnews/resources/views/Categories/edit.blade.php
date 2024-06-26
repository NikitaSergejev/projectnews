@extends('layouts.app')
@section('content')
<!-- content categories -->
<div class="box-header with-border">
    <h3 class="box-title"><strong>Categories manage - Edit</strong></h3>
</div>
<div class="box-body">
    <div class="add">
        <a href="/categorylist" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-backward"></i> Back</a>
    </div>
    <div class="container">
    <!--Display Validation Errors -->
    @include('common.errors')
    <!--Category EditForm -->
<form action="{{url('editcategory/' . $category->id)}}" method="POST" class="form-horizontal">
@csrf
    <!--Category Name -->
    <div class="form-group">
        <label for="category-name" class="col-sm-3 control-label">Category name</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" type="text" value="{{$category->name}}" name="name" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
        <button type="submit" class="btn btn-default" name="add"><i class="fa fa-btn fa-edit"></i> Save change</button>            
        </div>
    </div>
</form>
    </div>
</div>
@endsection