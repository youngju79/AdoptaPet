@extends('layouts.main')

@section('title', 'Profile')

@section('active-profile', 'active')

@section('content')
<div class="py-5">
    <h2 class="text-center">Profile Page</h2>
    <div class="container my-5">
        <div class="row">
            <div class="col-2">
                <div class="sticky-top">
                    <img class="rounded-circle img-fluid my-4 border" src="https://i5.walmartimages.com/asr/51fbef1a-797b-40bd-b656-467d3e7447f5_1.cf8b658088d4ae35f306fec246104437.png" alt="Female Icon">
                    <p><a class="link-dark" href="#about">About</a></p>
                    <p><a class="link-dark" href="#currentlylisted">Listed Pets</a></p>
                    <p><a class="link-dark" href="#favorite">Favorites</a></p>
                </div>
            </div>
            <div class="col-9 offset-1">
                <div class="bg-white shadow-sm p-4 mb-4" id="about">
                    <h4 class="mb-3">About</h4>
                    <p class="mb-3">Name: {{ $user->name }}</p>
                    <p class="mb-3">Email: {{ $user->email }}</p>
                    <p class="mb-3">Created on: {{ $user->created_at }}</p>
                </div>
                <div class="bg-white shadow-sm p-4 mb-4" id="currentlylisted">
                    <h4 class="mb-3">Current Listed Pets</h4>
                    <p><a href={{route('pet.add')}}>List a new pet</a></p>
                    @if ($user->hasListedPets())
                        <div class="container-fluid p-0">
                            @foreach($user->listedPets as $pet)
                                <div class="row">
                                    <div class="col-3">
                                        <img src="{{$pet->image_url}}" class="card-img-top" alt="Pet thumbnail">
                                    </div>
                                    <div class="col-6">
                                        <h5>{{$pet->name}}</h5>
                                        <p>
                                            <span>Gender: </span> {{$pet->gender->name}}
                                            <br>
                                            <span>Breed: </span> {{$pet->breed}}
                                            <br>
                                            <span>Color: </span> {{$pet->color}}
                                            <br>
                                            <span>Age: </span> {{$pet->age->name}}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div class="btn-group">
                                                <a href="{{route('pet.show', ['id' => $pet->id])}}"><button type="button" class="btn btn-sm btn-outline-secondary">View</button></a>
                                                <a href="{{route('pet.edit', ['id' => $pet->id])}}"><button type="button" class="btn btn-sm btn-outline-secondary">Edit</button></a>
                                                <form method="POST" action="{{ route('pet.remove', ['id' => $pet->id]) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>                                                    
                                            </div>                                
                                        </div>
                                        <small class="text-muted">Posted on {{$pet->created_at}}</small>
                                    </div>        
                                </div>
                                <hr>
                            @endforeach
                        </div>
                    @else
                        <p>You have no pets currently listed.</p>
                    @endif
                </div>
                <div class="bg-white shadow-sm p-4 mb-4" id="favorite">
                    <h4 class="mb-3">Favorites</h4>
                    @if ($user->hasFavoritedPets())
                        <div class="container-fluid p-0">
                            @foreach($user->favoritedPets as $favorite)
                                @if ($favorite->pet != null)
                                    <div class="row">
                                        <div class="col-3">
                                            <img src="{{$favorite->pet->image_url}}" class="card-img-top" alt="Pet thumbnail">
                                        </div>
                                        <div class="col-6">
                                            <h5>{{$favorite->pet->name}}</h5>
                                            <p>
                                                <span>Gender: </span> {{$favorite->pet->gender->name}}
                                                <br>
                                                <span>Breed: </span> {{$favorite->pet->breed}}
                                                <br>
                                                <span>Color: </span> {{$favorite->pet->color}}
                                                <br>
                                                <span>Age: </span> {{$favorite->pet->age->name}}
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div class="btn-group">
                                                    <a href="{{route('pet.show', ['id' => $favorite->pet->id])}}"><button type="button" class="btn btn-sm btn-outline-secondary">View</button></a>
                                                    <form method="POST" action="{{ route('favorite.remove', ['id' => $favorite->id]) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-danger">Remove ★</button>
                                                    </form>     
                                                </div>                                
                                            </div>
                                            <small class="text-muted">Added on {{$favorite->created_at}}</small>
                                        </div>        
                                    </div>
                                    <hr>
                                @else
                                    <div class="row">
                                        <div class="col-3">
                                            <img src="https://developers.google.com/maps/documentation/streetview/images/error-image-generic.png" class="card-img-top" alt="Pet thumbnail">
                                        </div>
                                        <div class="col-6">        
                                            <h5>This pet has been removed.</h5>
                                            <p class="text-muted">Please click on the button below to remove from favorites</p>
                                            <div class="d-flex justify-content-between align-items-center mb-2">                                    
                                                <div class="btn-group">
                                                    <form method="POST" action="{{ route('favorite.remove', ['id' => $favorite->id]) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-danger">Remove ★</button>
                                                    </form>     
                                                </div>                                
                                            </div>                   
                                        </div>        
                                    </div>
                                    <hr>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <p>You have no favorited pets.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection