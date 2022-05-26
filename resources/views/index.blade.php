@extends('layouts.master')

@section('title', __('Public Homepage'))

@section('content')
    <div class="container-fluid">
        <nav class="navbar navbar-light" style="background-color: #cfe2ff">
            <div class="container-fluid">
                <a class="navbar-brand" href="javascript:void(0)">{{ __("Homepage") }}</a>
            </div>
        </nav>
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #cfe2ff">
                        <div class="d-flex bd-highlight">
                            <div class="p-2 flex-grow-1 bd-highlight">
                                <h5>{{ __("Story List") }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('layouts.partials.alert')
                        
                        @if (filled($stories))
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __("Title") }}</th>
                                    <th scope="col">{{ __("Description") }}</th>
                                    <th scope="col">{{ __("Published By") }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stories as $story)
                                <tr>
                                    <td>{{ data_get($story, 'title') }}</td>
                                    <td>{!! data_get($story, 'description') !!}</td>
                                    <td>{{ data_get($story, 'user.name') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $stories->appends(request()->all())->links('admin.misc.pagination') }}
                        @else
                        <div class="alert alert-warning" role="alert">
                            {{ __("No stories available yet.") }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
