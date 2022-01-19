<div>
    @if ($message = Session::get('message'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <input type="search" wire:model="search" class="form-control" placeholder="Search" />
        </div>
        <div class="card-tools">
        <button class="btn btn-primary"><i class="fas fa-search"> </i> Search</button>
            <a href="{{ route('users.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"> </i> Add User
            </a>
        </div>
        <div class="col-md-4">
        </div>
    </div>
    <br>
    <div class="card card-primary card-outline">
        {{-- <div class="card-header">
            
        </div> --}}
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
                            Full Name
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            image
                        </th>
                        <th class="text-center">
                            Status
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $index=>$user)
                    <tr>
                        <td>
                            {{ $index + 1 }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $user->first_name.' '.$user->last_name }}
                        </td>
                        <td class="project_progress">
                            {{ $user->email }}
                        </td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    @if ($user->image)
                                        <img alt="Avatar" class="table-avatar" src="{{ asset('storage/'. $user->image) }}">
                                    @else
                                        <i class="fa fa-lg fa-user"></i>
                                    @endif
                                </li>
                            </ul>
                        </td>
                        <td class="project-state">
                            <span class="badge badge-{{ $user->active? 'success':'danger' }}">{{ $user->active?
                                'Active':'Not Active' }}</span>
                        </td>
                        <td class="">
                            <div class="btn-group">
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-primary"><i
                                        class="fas fa-pencil-alt"></i></a>
                                    <button type="button" class="btn btn-danger btndelete" wire:click.prevent="setAtt('{{ $user->id }}', '{{$user->first_name}}')" data-toggle="modal" data-target="#delete">
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
                {{ $users->appends(request()->query())->links('pagination::bootstrap-4') }}
            </ul>
        </div>
    </div>

    <div wire:ignore.self class="modal fade show" id="delete" aria-modal="true" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you want delete <b>{{$user_name}}</b> ?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" wire:click="deleteUser" class="btn btn-danger" data-dismiss="modal">Delete</button>
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