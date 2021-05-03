@extends('layouts.main')

@section('title', 'Register')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-8 col-lg-5 mt-5 shadow rounded bg-white">
            <form class="my-4" method="POST" action="{{route('registration.create')}}">
                @csrf
                <h1 class="h3 mb-3 font-weight-normal">Register</h1>
                <div class="form-group">
                    <label class="form-label" for="name">Full Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                    @error('name')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
                    @error('email')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control">
                    @error('password')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <p><a class="text-secondary" href="{{route('auth.loginForm')}}">Already have an account?</a></p>
                <button class="btn btn-lg btn-warning btn-block my-3" type="submit">Sign up</button>
            </form>
        </div>
    </div>
</div>
@endsection