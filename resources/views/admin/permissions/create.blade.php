@extends('admin.layouts.app')
@section('alert')
    @include('admin.alert')
@stop
@section('create')
    <a type="button" class="btn btn-info btn-sm" style="float:right;" href="{{route('admin.permissions.index')}}" >Permission Management</a>
@stop
@section('content')
    <section class="content">
        @if(Session::has('success'))
            <div class="alert alert-success text-center">
                {{Session::get('success')}}
            </div>
        @endif
        <form role="form" method="post">
            <div class="card-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Permission</label>
                    <input type="text" name="permission" value="{{old('permission')}}" class="form-control @error('permission') is-invalid @enderror"  placeholder="Enter permission">
                    @error('permission')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
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
