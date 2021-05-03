@extends('layouts.main')

@section('title', 'Add a Pet')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-10 mt-4 shadow rounded bg-white p-4">
            <form action="{{route('pet.store')}}" method="POST">
                @csrf
                <h1 class="h3 mb-3 font-weight-normal">Add a New Pet</h1>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
                    @error('name')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="breed" class="form-label">Breed</label>
                    <input type="text" name="breed" id="breed" class="form-control" value="{{old('breed')}}">
                    @error('breed')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="color" class="form-label">Color</label>
                    <input type="text" name="color" id="color" class="form-control" value="{{old('color')}}">
                    @error('color')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="age" class="form-label">Age</label>
                    <select name="age" id="age" class="form-select">
                        <option value="">-- Select Age --</option>
                        @foreach($ages as $age)
                            <option 
                                value="{{$age->id}}"
                                {{(string)$age->id === old('age') ? "selected" : ""}}
                            >
                                {{$age->name}}
                            </option>
                        @endforeach
                    </select>
                    @error('age')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select name="gender" id="gender" class="form-select">
                        <option value="">-- Select Gender --</option>
                        @foreach($genders as $gender)
                            <option 
                                value="{{$gender->id}}"
                                {{(string)$gender->id === old('gender') ? "selected" : ""}}
                            >
                                {{$gender->name}}
                            </option>
                        @endforeach
                    </select>
                    @error('gender')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="url" class="form-label">Image URL</label>
                    <input type="text" name="url" id="url" class="form-control" value="{{old('url')}}">
                    @error('url')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">
                    Add
                </button>
            </form>
        </div>
    </div>
</div>
@endsection