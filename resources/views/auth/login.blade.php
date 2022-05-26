@extends('layouts.master')

@section('title', __('Login'))

@section('content')
    <div class="container-fluid">
        <div class="card w-25 position-absolute top-50 start-50 translate-middle">
            <div class="card-body">
                <h4>{{ __("Login Form") }}</h4>
                @include('layouts.partials.alert')
                <form action="{{ route('auth.login') }}" method="POST" class="mt-4" autocomplete="off">
                    @csrf
                    <div class="mt-3">
                        <label for="email" class="form-label">{{ __("Email address") }}</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mt-3">
                        <label for="password" class="form-label">{{ __("Password") }}</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">{{ __("Login") }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
