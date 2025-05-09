@extends('base')
@section('title', 'Profile')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Name: {{$profile['name']}}</h5>
                <p>Email: {{$profile['email']}}</p>
                <p>Age: {{$profile['age']}}</p>
            </div>
        </div>
    </div>
@endsection
