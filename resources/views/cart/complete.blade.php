@extends('layouts.app')

@section('content')

<div class="container">
    <h1>
        Thank You!!! For ordering your pizza
    </h1>
</div>
<div class="container">
    <a class="btn btn-primary" href="{{route('home')}}" role="button">Back to Home</a>
</div>

    @endsection
