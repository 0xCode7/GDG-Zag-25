@extends('base')
@section('title', 'All Profiles')

@section('content')
    <h2 class="mb-4 text-center">All Profiles</h2>
    <div class="d-flex justify-content-between">
        @foreach($profiles as $id => $profile)
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{$profile['name']}}</h5>
                    <a href="{{url('/profile/' . $id)}}" class="btn btn-primary">View Profile</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
