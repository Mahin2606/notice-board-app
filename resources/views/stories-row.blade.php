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
    <tbody id="add-story">
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