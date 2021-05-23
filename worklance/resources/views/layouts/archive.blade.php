<div class="col-lg-4 order-lg-2 order-1 mb-lg-0 mb-4">
    <div class="announcement">
        <div class="overlay"></div>
        <div class="top-title">
            <h6><img src="{{ asset('data/img/bell.svg') }}" alt=""> Notifications</h6>
            <a href="{{url('/home')}}">Back</a>
        </div>
        @if(count($data['archivedChats']) == 0)
            @include('layouts.emptyBox')
        @endif
        <div class="main_archive_content">
            @foreach($data['archivedChats'] as $info)
                <div class="d-flex align-items-center flex-column justify-content-between mt-3 archive_chat">
                    <div class="d-flex w-100 justify-content-start" style="cursor: pointer">
                        <a href="{{url('/users/' . $info->id)}}">
                            <img class="announcement-image mr-2"
                                 src="{{$info->avatar ? asset($info->avatar) : asset('data/img/Ellipse.png')}}" alt="">
                        </a>
                        <a class="w-100" href="{{url('/home/archive/' . $info->id)}}">
                            <div class="d-flex">
                                <div class="announcement-text d-flex toggle-btn">
                                    <div class="d-flex align-items-center">
                                        <p>{{ $info->name}}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>