@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Add Product</h1>
@stop


@section('content')
<form method="POST" action="{{ route('clients.update', $client) }}">
  @csrf
  @method('PUT')
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
        <label for="name">Client Name</label>
        <input type="text" class="form-control" value="{{ $client->name }}" name="name">
      </div>
      <div class="form-group">
        <label for="Phone1">Client Phone 1</label>
        <input type="text" class="form-control" min="1" value="{{ $client->phone[0] }}" name="phone[]">
      </div>
      <div class="form-group">
        <label for="Phone2">Client Phone 2</label>
        <input type="text" class="form-control" min="1" value="{{ $client->phone[1] }}" name="phone[]">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Description</label>
        <textarea class="form-control" name="address">{{ $client->address }}</textarea>
      </div>
      {{-- <div class="form-check">
        <input type="checkbox" class="form-check-input" name="active" {{ old('active')? 'checked' :''}}>
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div> --}}
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Save</button>
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