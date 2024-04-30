@extends('layouts.app')

@section('content')
<div class="box-header with-border">
	<h3 class="box-title"><strong> Users manage</strong></h3>
	<div class="add">
	<a href="adduser" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
	</div>
<!--    форма список ролей для фильтрации данных          -->
<div class="pull-right">
    <form class="form-inline" action="{{ url('userByrole') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Role: </label>
            <select class="form-control input-sm" name="role" onChange="this.form.submit();">
                <option value="0">All</option>
                @if(isset($roles))
                    @foreach ($roles as $role)
                        <option value="{{ $role}}" @if(isset($selectRole) && $role==$selectRole) selected @endif>
                            {{$role}}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </form>
</div>

<div class="box-body">
	@if (count($users ?? '') > 0)
	<table class="table table-bordered">
		<thead>
		  <th width=3%>N/#</th>
		  <th width="20%">Name</th>
          <th>Email</th>
		  <th>Role</th>
		  <th>Date Updated</th>
		  <th>Tools</th>
		</thead>
		<tbody>
		@foreach($users as $user)
			<tr>
				<td>{{ $user->id }}</td>
                <td>{{$user->name}}</td>
                <td>{{ $user->email }}</td>
				<td>{{ $user->role }}</td>
				<td>{{ $user->updated_at->format('d.m.Y') }}</td>
				<td>
				  <a href="{{url('edituser/' . $user->id)}}" class='btn btn-success btn-sm edit btn-flat'><i class='fa fa-edit'></i> Edit</a>
                  <form action="{{ url('deleteuser/' . $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class='btn btn-danger btn-sm delete btn-flat'><i class='fa fa-trash'></i> Delete</button>
                </form>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	@else
		<p>Data no found</p>
	@endif
</div>
@endsection















