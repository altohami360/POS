@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Users</h1>
@stop


@section('content')
{{-- @if ($message = Session::get('message'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif --}}
    @livewire('user.index')
{{-- <div class="card card-primary card-outline">
    <div class="card-header">
        <div class="row justify-content-between">
            <div class="col-md-6">
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Search">
            </div>
            <div class="card-tools">
                @can('users-create')
                    <a href="{{ route('users.create') }}" class="btn  btn-primary">
                        <i class="fas fa-plus"></i> Add User
                    </a>
                @endcan
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
                    <th >
                        Full Name
                    </th>
                    <th>
                        Email
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
                        <td>
                            {{ $user->first_name.' '.$user->last_name }}
                        </td>
                        <td class="project_progress">
                            {{ $user->email }}
                        </td>
                        <td class="project-state">
                            <span class="badge badge-{{ $user->active? 'success':'danger' }}">{{ $user->active? 'Active':'Not Active' }}</span>
                        </td>
                        <td class="">
                            <div class="btn-group">

                                @can('users-update')
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                @else
                                    <button type="button" class="btn btn-primary" disabled><i class="fas fa-pencil-alt"></i></button>
                                @endcan
                                @can('users-delete')
                                    <button type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                @else
                                    <button type="button" class="btn btn-danger" disabled><i class="fas fa-trash"></i></button>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div> --}}
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!'); 
</script>
@stop