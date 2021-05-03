@extends('layouts.main')

@section('title', 'Home')

@section('active-home', 'active')

@section('content')
<div class="py-5">
    <h2 class="text-center">Adopt the Perfect Pet!</h2>
    <div class="container my-5">
        <div class="row">
            <div class="col-12 px-3">
                <h4 class="mb-3">We currently have {{$pets->count()}} pet(s) listed</h4>
            </div>
        </div>
        <div class="row" data-masonry='{"percentPosition": true }'>
            @foreach($pets as $pet)
                <div class="col-12 col-lg-4 p-3">
                    <div class="card shadow-sm">
                        <img src="{{$pet->image_url}}" class="card-img-top" alt="Pet thumbnail">
                        <div class="card-body">
                            <h5 class="card-title">{{$pet->name}}</h5>
                            <p class="card-text">
                                <span>Gender: </span> {{$pet->gender->name}}
                                <br>
                                <span>Breed: </span> {{$pet->breed}}
                                <br>
                                <span>Color: </span> {{$pet->color}}
                                <br>
                                <span>Age: </span> {{$pet->age->name}}
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{route('pet.show', ['id' => $pet->id])}}"><button type="button" class="btn btn-sm btn-outline-secondary">View</button></a>
                                    @if (Auth::check())
                                        @if (Auth::user()->id == $pet->user_id)
                                            <a href="{{route('pet.edit', ['id' => $pet->id])}}"><button type="button" class="btn btn-sm btn-outline-secondary">Edit</button></a>
                                            <form method="POST" action="{{ route('pet.remove', ['id' => $pet->id]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        @else
                                            @if (Auth::user()->hasFavorite($pet->id))
                                                <form method="POST" action="{{route('favorite.remove', ['id' => Auth::user()->getFavoriteId($pet->id)])}}">
                                                    @csrf                             
                                                    <button type="submit" class="btn btn-sm btn-danger">Remove ★</button>
                                                </form>
                                            @else
                                                <form method="POST" action="{{route('favorite.add', ['id' => $pet->id])}}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-warning">Favorite ★</button>
                                                </form>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                                <small class="text-muted">Posted on {{$pet->created_at}}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection