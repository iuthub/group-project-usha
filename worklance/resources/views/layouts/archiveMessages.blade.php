<div class="col-lg-4 order-lg-2 order-1 mb-lg-0 mb-4">
    <div class="announcement">
        <div class="overlay"></div>
        <div class="top-title">
            <h6><img src="{{ asset('data/img/bell.svg') }}" alt=""> Notifications</h6>
            <a href="{{url('/home/archive')}}">Back</a>
        </div>
        <div class="main_archive_content">
            <div class="d-flex align-items-center flex-column justify-content-between mt-3 archive_chat">
                <div class="d-flex w-100 justify-content-start" style="cursor: pointer">
                    <a href="{{url('/users/' . $data['user']->id)}}">
                        <img class="announcement-image mr-2"
                             src="{{$data['user']->avatar ? asset($data['user']->avatar) : asset('data/img/Ellipse.png')}}"
                             alt="">
                    </a>
                    <div class="d-flex">
                        <div class="announcement-text d-flex toggle-btn">
                            <div>
                                <p>{{ $data['user']->name}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="parent_chat_content w-100">
                    <div class="chat_content p-2">
                        @foreach($data['messages'] as $message)
                            @if($message->from_user_id == Auth()->user()->id)
                                <div class="d-flex align-items-center m-2 justify-content-end">
                                    <div class="message-content p-2 rounded" style="background: #82b2ff">
                                        <div>{{$message->text}}
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="d-flex align-items-center m-2">
                                    <div class="message-content p-2 rounded" style="background: #ffda8a">
                                        <div>{{$message->text}}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="mt-2 w-100">
                    <div class="message">
                        <form action="{{ route('sendMessage') }}" method="POST">
                            @csrf
                            <div class="input-group mb-1 form-group">
                                <textarea class="form-control" required name="text" id="message_content"
                                          placeholder="Reply..."></textarea>
                                <input type="hidden" name="user_id" value="{{$data['user']->id}}">
                                <input type="hidden" name="active" value="1">
                            </div>
                            <div class="d-flex justify-content-end ">
                                <button type="submit" class="back-btn">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>