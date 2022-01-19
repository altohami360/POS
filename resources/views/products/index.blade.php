@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Products</h1>
{{-- @if ($message = Session::get('message')) --}}
  <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>mohammed

      
    </strong>
  </div>
  {{-- @endif --}}
@stop


@section('content')

@livewire('product.index')

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
  console.log('Hi!'); 
</script>
@stop