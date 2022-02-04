<div>
    @if ($message = Session::get('message'))
        <script>
            toastr.options = {
                "closeButton" : true,
                "progressBar" : true
            }
            toastr.success("{{ session('message') }}");
        </script>
    @endif
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <div class="row justify-content-between">
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
                                    Name
                                </th>
                                <th>
                                    Products Count
                                </th>
                                <th class="text-center">
                                    Status
                                </th>
                                <th>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $index=>$category)
                            <tr>
                                <td>
                                    {{ $index + 1 }}
                                </td>
                                <td>
                                    {{ $category->name }}
                                </td>
                                <td>
                                    {{ $category->products->count() }}
                                </td>
                                <td class="project-state">
                                    <span class="badge badge-{{ $category->active? 'success':'danger' }}">{{ $category->active?
                                        'Active':'Not Active' }}</span>
                                </td>
                                <td class="">
                                    <div class="btn-group">
                                        @can('categories-update')
                                            <button wire:click.prevent="edit('{{ $category->id }}', '{{$category->name}}')" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></button>
                                        @endcan
                                        @can('categories-delete')
                                            <button wire:click.prevent="setAtt('{{ $category->id }}', '{{$category->name}}')" data-toggle="modal" data-target="#delete" class="btn btn-danger"><i class="fas fa-trash" ></i></button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
            
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @can('categories-create')
            <div class="col-md-4">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h4>Add Catogry</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="exampleInput1">Catory Name</label>
                            <input type="text" wire:model="name" class="form-control">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" checked>
                            <label class="form-check-label" for="exampleCheck1">Active</label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button wire:click="store" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        @endcan
    </div>
    
    {{-- <div wire:ignore.self class="modal fade show" id="modal-add" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Catogry </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInput1">Catogry</label>
                            <input type="text" wire:model="name" class="form-control" id="exampleInput1" placeholder="">
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="store" class="btn btn-primary">Save </button>
                </div>
            </div>
        </div>
    </div> --}}
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
                    <p>Do you want delete <b>{{$name}}</b> ?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" wire:click="destory" class="btn btn-danger"
                        data-dismiss="modal">Delete</button>
                    {{-- <input type="text" wire:model="user_id" id=""> --}}
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

<script>
    $('.btndelete').click(function(){
        let id = $('.btndelete').attr('data-id');
        $('#userid').val(id);
    });
</script>