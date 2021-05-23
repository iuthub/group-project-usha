<div class="col-lg-4 order-lg-2 order-1 mb-lg-0 mb-4">
    <div class="announcement">
        <div class="overlay"></div>
        <div class="top-title">
            <h6><img src="{{ asset('data/img/bell.svg') }}" alt=""> Notifications</h6>
            <a href="{{url('/home/archive')}}">Archive</a>
        </div>
        @if(count(Auth()->user()->messagesNew) == 0)
            @include('.layouts.emptyBox')
        @endif
        @foreach (Auth()->user()->messagesNew->reverse() as $message)
            <?php $user = Auth()->user()->fromUser($message->from_user_id) ?>
            <div class="d-flex align-items-center flex-column justify-content-between mt-3">
                <div class="d-flex w-100 justi  fy-content-start" style="cursor: pointer">
                    <a href="{{url('/users/' . $user->id)}}">
                        <img class="announcement-image mr-2"
                             src="{{$user->avatar ? asset($user->avatar) : asset('data/img/Ellipse.png')}}" alt="">
                    </a>
                    <div class="d-flex">
                        <div class="announcement-text d-flex toggle-btn" data-toggle="collapse"
                             data-target="#message{{ $message->id }}">
                            <div>
                                <p>{{ $user->name }}</p>
                                <p>Sent you a message| <span>{{ $message->created_at }}</span></p>
                            </div>
                            <button data-toggle="collapse" class="read-btn"><img
                                        src="{{ asset('data/img/ChevronDown.svg') }}" alt="">
                            </button>
                        </div>
                    </div>
                </div>
                <div id="message{{ $message->id }}" class="collapse w-100">
                    <p>
                        {{ $message->text }}
                    </p>
                    <div class="message">
                        <form action="{{ route('sendMessage') }}" method="POST">
                            @csrf
                            <div class="input-group mb-1 form-group">
                                <textarea class="form-control" required name="text" id="message_content"
                                          placeholder="Reply..."></textarea>
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                <input type="hidden" name="message_id_to_be_archived" value="{{$message->id}}">
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('archiveMessage', ['id' => $message->id]) }}"
                                   class="mark-as-read-btn bg-transparent pt-2">Отметить как
                                    прочитанное</a>
                                <button type="submit" class="back-btn">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>