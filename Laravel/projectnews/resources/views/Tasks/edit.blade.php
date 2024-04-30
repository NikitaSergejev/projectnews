@extends('layouts.app')
@section('content')

<div class="box-header with-border">
	<h3 class="box-title"><strong> Tasks manage - Edit task</strong></h3>
	<div class="box-body">
	<a href="/productlist" class="btn btn-primary btn-sm btn-flat"> <i class="fa fa-backward"></i> Back to list</a>
	</div>

</div>

<div class="box-body">
	<div class="container">
        <div class="col-lg-9 margin-tb">
			@if ($errors->any())
				<div class="alert alert-danger">
					<strong>Error!</strong>
					<ul>
						@foreach ($errors->all() as $error)
							<li></li>
						@endforeach
					</ul>
				</div>
			@endif
		<form action="{{url('edittask/' . $task->id)}}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group">
					<strong>Title:</strong>
					<input type="text" name="title" class="form-control" value="{{$task->title}}" placeholder="Title">
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group">
					<strong>Description:</strong>
					<textarea class="form-control" style="height:50px" name="description"
						placeholder="Description">"{{$task->description}}"</textarea>

				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group">
					<strong>Category:</strong>
				<select name="category_id" class="form-control" >
					@foreach ($categories as $category)
						<option value="{{$category->id}}"
                            @if ($category->id == $task->category_id)
                                selected
                            @endif
                            >{{$category->name}}</option>
					@endforeach
				</select>
				</div>
			</div>
            <div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group">
					<strong>Old image:</strong>
                    <img src="{{asset('images/' . $task->image)}}" class="img-thumbnail" alt="{{$task->name}}" width="104" height="136"/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group">
					<strong>Image:</strong>
				  <input type="file" name="image"  class="form-control" value="">
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<button type="submit" class="btn btn-primary">Save change</button>
			</div>
		</form>
		</div>
    </div>
</div>

@endsection
