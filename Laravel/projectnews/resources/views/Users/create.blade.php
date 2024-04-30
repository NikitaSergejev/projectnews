
@extends('layouts.app')
@section('content')
<!-- content categories list-->
<div class="box-header with-border">
    <h3 class="box-title"><strong>Users manage - Add</strong></h3>
</div>
<div class="box-body">
    <div class="add">
        <a href="users" class="btn btn-primary btn-sm btn-flat"></i>Back</a>
    </div>
    <div class="container">
        <!-- Display validation errors -->
        @include('common.errors')
        <!-- New Category Form -->
        <form action="{{url('adduser')}}" method="POST" class="form-horizontal">
            {{csrf_field()}}

            <!-- User Name-->
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" id="name" value="">
                </div>
            </div>
            <!-- User email-->
            <div class="form-group">
                <label for="email" class="col-sm-3 control-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" id="email" value="">
                </div>
            </div>
            <!-- User role-->
            <div class="form-group">
                <label for="email" class="col-sm-3 control-label">Role</label>
                <div class="col-sm-6">
                <select class="form-control input-sm" name="role">
                    @foreach ($roles as $role)
                        <option value="{{$role}}"
                            @if ($role == "user") selected @endif
                            >{{$role}}</option>
                    @endforeach
                </select>
                </div>
            </div>
            <!-- User password-->
            <div class="form-group">
                <label for="password" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="password" id="password" value="">
                </div>
            </div>
            <!-- User confirm password-->
            <div class="form-group">
                <label for="password_confirmation" class="col-sm-3 control-label">Password confirmation</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="password_confirmation" id="password_confirmation" value="">
                </div>
            </div>
            <!-- Add User Button-->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-btn fa-plus"></i>Add User
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

