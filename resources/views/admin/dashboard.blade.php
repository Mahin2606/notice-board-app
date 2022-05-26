@php
    use App\Enums\StoryStatus as sStatus;    
@endphp

@extends('layouts.master')

@section('title', __('Admin Dashboard'))

@section('content')
    <div class="container-fluid">
        <nav class="navbar navbar-light" style="background-color: #cfe2ff">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">{{ __("Admin Dashboard") }}</a>
                <div class="d-flex">
                    <a href="{{ route('auth.logout') }}" class="btn btn-light" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span>{{ __('Logout') }}</span>
                    </a>
                    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST"
                        style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </nav>
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #cfe2ff">
                        <div class="d-flex bd-highlight">
                            <div class="p-2 flex-grow-1 bd-highlight">
                                <h5>{{ __("List of Stories") }}</h5>
                            </div>
                            <div class="p-2 bd-highlight">
                                <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addStoryModal">
                                    {{ __("Add New Story") }}
                                </button>
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
                                    <th scope="col">{{ __("Status") }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stories as $story)
                                <tr>
                                    <td>{{ data_get($story, 'title') }}</td>
                                    <td>{!! data_get($story, 'description') !!}</td>
                                    <td>{{ data_get($story, 'title') }}</td>
                                    <td><span class="badge bg-{{ (data_get($story, 'status') == sStatus::APPROVED) ? 'success' : 'warning' }}">{{ __(ucfirst(data_get($story, 'status'))) }}</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $stories->appends(request()->all())->links('admin.misc.pagination') }}
                        @else
                        <div class="alert alert-primary" role="alert">
                            {{ __("No stories available yet.") }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <div class="modal fade" id="addStoryModal" tabindex="-1" aria-labelledby="addStoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStoryModalLabel">{{ __("Add New Story") }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.create.story') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="title" class="form-label">{{ __("Title") }}</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group mt-3">
                            <label for="description" class="form-label">{{ __("Description") }}</label>
                            <textarea name="description" id="description" class="form-control tinymce-editor"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-start">
                        <button type="submit" class="btn btn-primary">{{ __("Add") }}</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __("Close") }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '.tinymce-editor',
            height: 400,
        });
    </script>
@endpush