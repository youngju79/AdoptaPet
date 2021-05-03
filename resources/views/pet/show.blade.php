@extends('layouts.main')

@section('title', "$pet->name's Page")

@section('content')
<div class="py-5">
    <h2 class="text-center">My name is {{$pet->name}}!</h2>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-4 text-center">
                <img class="rounded img-fluid" src="{{$pet->image_url}}" alt="Pet Thumbnail">
            </div>
            <div class="col-3 m-2">
                <h4 class="mb-3">Facts About Me</h4>
                <strong>Breed:</strong> 
                <span class="float-end">{{$pet->breed}}</span>
                <br>
                <strong class="text-end">Gender:</strong>
                <span class="float-end">{{$pet->gender->name}}</span>
                <br>
                <strong>Color:</strong>
                <span class="float-end">{{$pet->color}}</span>
                <br>
                <strong>Age:</strong> 
                <span class="float-end">{{$pet->age->name}}</span>
                <br>
                <hr>
                <h4 class="mb-3">Owner</h4>
                <p>Please contact my owner if interested in adopting me!</p>
                <strong>Name:</strong> 
                <span class="float-end">{{$pet->user->name}}</span>
                <br>
                <strong>Email:</strong> 
                <span class="float-end">{{$pet->user->email}}</span>
                <br>
            </div>
        </div>
    </div>
</div>
@endsection