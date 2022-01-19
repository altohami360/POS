@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Edit User</h1>
@stop


@section('content')
<form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
  <div class="row">
    @csrf
    <div class="col-md-6">
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <div class="card card-primary card-outline">
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">First Name</label>
            <input type="text" class="form-control" value="{{ old('first_name') }}" name="first_name">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Last Name</label>
            <input type="text" class="form-control" value="{{ old('last_name') }}" name="last_name">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" value="{{ old('email') }}" name="email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" value="{{ old('password') }}" name="password">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" value="{{ old('password') }}" name="password_confirmation">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Image</label><br>
            <input type="file" name="image">
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" name="active" {{ old('active')? 'checked' :''}}>
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">
            Permissions
          </h3>
        </div>
        <div class=" ">
          @php
          $modals = ['users', 'categories', 'products'];
          $maps = ['create', 'read', 'update', 'delete'];
          @endphp
          <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
              @foreach ($modals as $index=>$modal)
              <li class="nav-item">
                <a class="nav-link {{$index==0? 'active' : ''}}" data-toggle="pill" href="#{{$modal}}"
                  role="tab">{{$modal}}
                </a>
              </li>
              @endforeach
            </ul>
          </div>

          <div class="card-body">
            <div class="tab-content" id="custom-tabs-four-tabContent">
              @foreach ($modals as $index=>$modal)
              <div class="tab-pane fade show {{$index==0? 'active' : ''}}" id="{{$modal}}" role="tabpanel"
                aria-labelledby="custom-tabs-four-home-tab">
                <div class="col-sm-6">
                  @foreach ($maps as $index=>$map)
                  <div class="form-group clearfix">
                    <input type="checkbox" name="permissions[]" value="{{$modal}}-{{$map}}" >
                    <label for="checkboxPrimary3">
                      {{ $map }}
                    </label>
                  </div>
                  @endforeach
                </div>
              </div>
              @endforeach
            </div>
          </div>
          <div class="card-footer">
            {{-- <button type="submit" class="btn btn-primary">Add</button> --}}
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
  console.log('Hi!'); 
</script>
@stop