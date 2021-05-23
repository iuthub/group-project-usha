@if (session('msg'))
    @isset($data['render'])
        @if ($data['render'] !== 'archive/messages')
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>  
        @endif
    @endisset
@endif