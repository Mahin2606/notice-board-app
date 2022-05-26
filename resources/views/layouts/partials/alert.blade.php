@if ($errors->any())
<div class="p-2">
    @foreach ($errors->toArray() as $type => $error)
    <div class="alert alert-{{ (in_array($type, ['warning', 'info', 'success', 'light'])) ? $type : 'danger' }}" role="alert">
        {!! $error[0] ?? '' !!}
    </div>
    @endforeach
</div>
@elseif (session()->has('success'))
<div class="p-2">
    <div class="alert alert-success" role="alert">
        {{ session()->get('success') }}
    </div>
</div>
@endif
