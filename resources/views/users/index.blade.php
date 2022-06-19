@extends('layouts.app')

@section('content')
    <div class="container p-3">
        <h3 class="fs-4 fw-bold "> List Of Users </h3>
    </div>
    <div class="container">
        <table class="table table-hover table-bordered table-sm">
            <thead>
                <tr>
                    <th scope="col">User Number</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <a class="btn btn-sm btn-outline-success" href="{{ route('users.show', $user->id) }}" role="button">View</a>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('users.edit', $user->id) }}"
                                role="button">Edit</a>

                            @if ($user->id != auth()->id())
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                    id="delete-{{ $user->id }}-user" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                        onclick="confirm('Are you sure you want to delete user {{ $user->name }} ?') ? document.getElementById('delete-{{ $user->id }}-user').submit() : null">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
        <div class="col">
            <a class="btn btn-outline-secondary" href="{{ route('users.create') }}">Create User</a>
        </div>
    @endsection
