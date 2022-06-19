@extends('layouts.app')

@section('content')
<div class="container">
<div class="card row g-1 shadow p-0 mb-5 bg-body rounded" ">
    <!--<img src="..." class="card-img-top" alt="...">-->
    <div class="card-body">
      <h5 class="card-title text-center">{{ucfirst($user->title)}}. {{$user->first_name}} {{$user->last_name}} : {{ucfirst($user->role)}}</h5>
    </div>

    <ul class="list-group list-group-flush">
        <li class="list-group-item list-group-item-action ">Username: {{$user->name}}</li> 
        <li class="list-group-item list-group-item-action ">Date Of Birth: {{$user->date_of_birth}}</li> 
        <li class="list-group-item list-group-item-action">Gender: {{ucfirst($user->gender)}}</li>
     <li class="list-group-item list-group-item-action ">Email: {{$user->email}}</li>
      <li class="list-group-item list-group-item-action ">Address 1: {{$user->address_1}}</li>
      <li class="list-group-item list-group-item-action ">Address 2: {{$user->address_2}}</li>
      <li class="list-group-item list-group-item-action ">City: {{$user->city}}</li>
      <li class="list-group-item list-group-item-action ">Postcode: {{$user->postcode}}</li>
      <li class="list-group-item list-group-item-action">Mobile Number: {{$user->mobile}}</li>
      <li class="list-group-item list-group-item-action ">Phone Number: {{$user->phone}}</li>
    </ul>
    <div class="card-body">
        <a class="btn btn-sm btn-outline-primary" href="{{ route('users.edit', $user->id) }}"
            role="button">Edit</a>
            @if (session()->has('success'))
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
    </div>
  </div>
</div>
@endsection
