@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Add Order</h1>
@stop


@section('content')
<div class="row">
  <div class="col-md-6">

    @livewire('client.order.create', ['client' => $client])

  </div>
  
  <div class="col-md-6">

   @livewire('client.order.order-products', ['client' => $client])

  </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
  console.log('Hi!'); 
</script>
@stop