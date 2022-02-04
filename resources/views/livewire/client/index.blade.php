<div>
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="card-tools">
                @can('clients-create')
                    <a href="{{ route('clients.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"> </i> Add Client
                    </a>
                @endcan
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="search" wire:model="search" class="form-control" placeholder="Search.." />
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
                            Name
                        </th>
                        <th>
                            Phone
                        </th>
                        <th>
                            Address
                        </th>
                        <th style="width: 150px">
                            Add Orders
                        </th>
                        {{-- <th class="text-center">
                            Status
                        </th> --}}
                        <th>
                            
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clients as $index=>$client)
                    <tr>
                        <td>
                            {{ $index + 1 }}
                        </td>
                        <td>
                            {{ $client->name }}
                        </td>
                        <td>
                            {{ implode(array_filter($client->phone), ' -- ') }}
                        </td>
                        <td>
                            {{ $client->address }}
                        </td>
                        <td>
                            <a href="{{ route('clients.orders.create', $client) }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add Order
                            </a>
                        </td>
                        {{-- <td class="project-state">
                            <span class="badge badge-{{ $client->active? 'success':'danger' }}">{{
                                $client->active?
                                'Active':'Not Active' }}</span>
                        </td> --}}
                        <td class="">
                            <div class="btn-group">
                                {{-- Edit button --}}
                                @can('clients-update')
                                    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                @endcan
                                {{-- Delete Button --}}
                                @can('clients-delete')
                                    <button wire:click.prevent="setAtt('{{ $client->id }}', '{{$client->name}}')" data-toggle="modal" data-target="#delete"
                                        class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @endcan
    
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td>
                            <h2>NO Data</h2>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <div wire:ignore.self class="modal fade show" id="delete" aria-modal="true" tabindex="" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you want delete <b>{{$client_name}}</b> ?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" wire:click="deleteClient" class="btn btn-danger"
                        data-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
