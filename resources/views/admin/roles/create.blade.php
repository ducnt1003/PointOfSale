@extends('admin.layouts.app')
@section('alert')
    @include('admin.alert')
@stop
@section('create')
    <a type="button" class="btn btn-info btn-sm" style="float:right;" href="{{route('admin.roles.index')}}" >Role Management</a>
@stop
@section('content')
    <section class="content">
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
                <label>Permission</label>
                <div class="form-group" data-select2-id="46">
                    <div class="select2-green" data-select2-id="45">
                        <select class="select2 select2-hidden-accessible"  name="permissions[]" id="permissions" multiple="" data-placeholder="Select Permissions" data-dropdown-css-class="select2-green" style="width: 100%;" data-select2-id="15" tabindex="-1" aria-hidden="true">
                            @foreach($permissions as $permission)
                                <option value="{{$permission->id}}">{{$permission->name}}</option>
                            @endforeach
                        </select>
                    </div>
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
