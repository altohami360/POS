<div>
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h4>Categories</h4>
        </div>
        <div class="card-body">
            <div id="accordion">
                @foreach ($categories as $index=>$category)

                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                <a class="d-block w-100" data-toggle="collapse" href="#col{{ $index }}" aria-expanded="false">
                                    {{$category->name}}
                                </a>
                            </h4>
                        </div>
                        <div wire:ignore.self id="col{{ $index }}" class="collapse" data-parent="#accordion" style="">
                            <div class="card-body p-0">
                                <table class="table table-striped projects">
                                    <thead>
                                        <tr>
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Price
                                            </th>
                                            <th>
                                                Stock
                                            </th>
                                            <th>
        
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($category->products as $product)
                                        <tr>
                                            <td>
                                                {{ $product->name }}
                                            </td>
                                            <td>
                                                ${{ $product->sale_price }}
                                            </td>
                                            <td>
                                                {{ $product->stock > 0 ? $product->stock : 'Out of stock' }}
                                            </td>
                                            <td>
                                            @if ($product->stock > 0)
                                                <a onclick="event.preventDefault()" wire:click="store({{$product->id}},'{{$product->name}}',{{$product->sale_price}})"
                                                    class="btn btn-success">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                            @else
                                                {{-- <a onclick="event.preventDefault()"
                                                    class="btn btn-success disabled">
                                                    <i class="fas fa-plus"></i>
                                                </a> --}}
                                            @endif
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
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


{{-- <div class="col-md-7">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <input type="search" wire:model="search" class="form-control" placeholder="Search">
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <select wire:model.lazy="category_id" class="form-control select2 select2-hidden-accessible">
                            <option value="" selected>Category..</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="row">
                @forelse ($products as $product)
                <div class="col-sm-3">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h4>{{ $product->name }}<br><small>{{ $product->category->name }}</small></h4>
                            <p class="p-0">{{ $product->sale_price }} $</p>
                        </div>
                        <a wire:click.prevent="store({{ $product->id }}, '{{ $product->name }}', {{ $product->sale_price }})"
                            class="small-box-footer" style="cursor: pointer;">
                            <i class="fas fa-plus"></i> Add to Cart
                        </a>
                    </div>
                </div>
                @empty

                @endforelse

            </div>
        </div>
    </div>
</div> --}}