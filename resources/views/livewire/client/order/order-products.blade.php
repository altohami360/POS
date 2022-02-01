<div>
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="card-tools">
                <a wire:click.prevent="clear" class="btn btn-danger">
                    <i class="fas fa-trash"> </i> Clear ({{\Cart::session($client->id)->getContent()->count()}})
                </a>
            </div>
            <h4>Orders</h4>
        </div>
        <div class="card-body p-0">
    
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th class="col-6">Product</th>
                        <th>Price</th>
                        <th class="col-6">Quantity</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders->sortBy('id') as $order)
                    <tr>
                        <td>{{  $order->name }}</td>
                        <td>${{ $order->price * $order->quantity }}</td>
                        <td>
                            <div class="btn-group">
                                <button wire:click.prevent="plus({{$order->id}})" type="button" class="btn btn-primary btn-sm col-2">+</button>
                                <input type="text" class="form-control form-control-sm col-3 p-0 text-center" min="1"
                                    value="{{ $order->quantity }}" disabled>
                                <button wire:click.prevent="minus({{$order->id}})" type="button" class="btn btn-primary btn-sm col-2">-</button>
                            </div>
                        </td>
                        <td>
                            <button wire:click.prevent="remove({{$order->id}})" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td>NO Data</td>
                    </tr>
                    @endforelse
    
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <h4>Total Price : {{\Cart::getTotal()}}$</h4>
            <button 
                wire:click="save" 
                type="submit" 
                class="btn btn-primary btn-block {{$orders->count()? '':'disabled'}}">
                    <i class="fa fa-plus"></i> Add Order
            </button>
        </div>
    </div>
</div>