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
                    <div class="card-body" id="stories">
                        @include('stories-row')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let element = $('#stories'), url = "{{ route('homepage') }}";
            setInterval(function () {
                $.get(url, function(res) {
                    if (res.status) {
                        element.html(res.embed)
                    }
                });
            }, 1000 * 30);
        });
    </script>
@endpush
