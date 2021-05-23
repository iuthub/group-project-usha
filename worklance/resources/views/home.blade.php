@extends('layouts.navAndFooter')
@section('content')
    @include('layouts.message')
    <div class="row mt-4">
        <div class="col-lg-8 order-lg-1 order-2">
            @include('layouts.search')
            @if(count($data['posts']) == 0)
                <ul class="w-list">
                    <li class="w-list-item p-3 text-center">You haven't posted yet!</li>
                </ul>
            @endif
            <ul class="w-list">
                @foreach($data['posts'] as $post)
                    <li class="w-list-item">
                        <a href="/post/{{$post->id}}">
                            <div class="user-info">
                                <h6>{{ $post->name }}</h6>
                                @if(isset($post->user->name))
                                    <p class="publication-block-author">{{ $post->user->name }}</p>
                                @endif
                                <p>
                                    {{ Str::words($post->about, 10)}}
                                </p>
                                <div class="tags">
                                    @if(isset($post->skills))
                                        @foreach ($post->skills as $skill)
                                            <button onclick="location.href='#'">{{ $skill->name }}</button>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
            {{ $data['posts']->onEachSide(1)->links() }}
        </div>
        @if($data['render'] === 'archive')
            @include('layouts.archive')
        @elseif($data['render'] === 'archive/messages')
            @include('layouts.archiveMessages')
        @else
            @include('layouts.messageToUser')
        @endif
    </div>
@endsection
