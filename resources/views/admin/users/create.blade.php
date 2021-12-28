@extends('admin.layouts.app')
@section('alert')
    @include('admin.alert')
@stop
@section('create')
    <a type="button" class="btn btn-info btn-sm" style="float:right;" href="{{route('admin.users.index')}}" >User Manager</a>
@stop
@section('content')
    <section class="content">
        <form role="form" method="post" >
            <div class="card-body">
                <div class="form-group" data-select2-id="46">
                    <label>Roles</label>
                    <div class="select2-green" data-select2-id="45">
                        <select class="select2 select2-hidden-accessible"  name="roles[]" id="roles" multiple="" data-placeholder="Select a Role" data-dropdown-css-class="select2-green" style="width: 100%;" data-select2-id="15" tabindex="-1" aria-hidden="true">
                            @foreach($roles as $role)
                                <option value="{{$role->id}}" >{{$role->name}}</option>
                            @endforeach
                        </select>
                        </div>
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" name="name" placeholder="Enter name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" name="email" placeholder="Email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            @csrf
        </form>
    </section>
    <!-- /.content -->
@stop
