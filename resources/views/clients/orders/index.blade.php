@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Orders</h1>
@stop


@section('content')


  <div class="row">
    <div class="col-md-8">
      <div class="card card-primary card-outline">
        <div class="card-header">
          <div class="card-tools">
          </div>
          <div class="row">
            <div class="col-md-6">
              <input type="search" wire:model="search" class="form-control" placeholder="Search">
            </div>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
            <thead>
              <tr>
                <th>
                  #
                </th>
                <th>
                  Client Name
                </th>
                <th>
                  total price
                </th>
                <th>
                  Date
                </th>
                <th>

                </th>
              </tr>
            </thead>
            <tbody>
              @forelse ($orders as $index=>$order)
              <tr>
                <td>
                  {{ $index + 1 }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  {{ $order->client->name }}
                </td>
                <td class="project_progress">
                  {{ $order->total_price }}
                </td>
                <td>
                  {{ $order->created_at->toformatteddatestring() }}
                </td>
                <td class="">
                  <div class="btn-group">

                    @livewire('client.order.btn-show-products-order', ['order_id' => $order->id], key($order->id))

                    <a class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                    <button type="button" class="btn btn-danger">
                      <i class="fas fa-trash"></i>
                    </button>
                  </div>
                </td>
              </tr>
              @empty
              <h3>NO Data</h3>
              @endforelse
            </tbody>
          </table>
        </div>
        <div class="card-footer text-center clearfix">
          <ul class="pagination m-0 float-right">
            {{-- {{ $orders->appends(request()->query())->links('pagination::bootstrap-4') }} --}}
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h4>Products Order</h4>
        </div>
        <div class="card-body p-0">

          @livewire('client.order.show-products-order')

        </div>
        <div class="card-footer text-center clearfix">
          <ul class="pagination m-0 float-right">
            {{-- {{ $orders->appends(request()->query())->links('pagination::bootstrap-4') }} --}}
          </ul>
        </div>
      </div>
    </div>
  </div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop