@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Add Product</h1>
@stop


@section('content')
<form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
    @csrf
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
            <label>Category</label>
            <select class="form-control" name="category_id">
              <option selected disabled>Category..</option>
              @foreach ($categories as $category)
              <option value="{{ $category->id }}" {{ $category->id==old('category_id')? 'selected':'' }}>{{ $category->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Product Name</label>
            <input type="text" class="form-control" value="{{ old('name') }}" name="name">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Description</label>
            <textarea class="form-control" name="description">{{ old('description') }}</textarea>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Purchase Price</label>
            <input type="number" class="form-control" min="1" value="{{ old('purchase_price') }}" name="purchase_price">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Sale Price</label>
            <input type="number" class="form-control" min="1" value="{{ old('sale_price') }}" name="sale_price">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Stock</label>
            <input type="number" class="form-control" min="1" value="{{ old('stock') }}" name="stock">
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