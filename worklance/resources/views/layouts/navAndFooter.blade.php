<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Worklance</title>
    <link rel="shortcut icon" href="{{ asset('data/img/favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="data/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('data/css/style.css') }}">
    <meta property="og:image" content="{{asset('ext2/img/dest/preview.jpg')}}">
    @if(isset($requireAssetForEdit))
        <link rel="stylesheet" href="{{asset('ext2/css/app.min.css')}}">
    @endif
    @if(isset($includeCroppieCss))
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">
    @endif


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="{{ asset('data/js/index.js') }}"></script>
</head>

<body>
<nav class="navbar navbar-expand-md needs_to_be_blurred">
    <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{ asset('data/img/WorklanceLogo.svg') }}" alt="">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <img src="{{ asset('data/img/menu.svg') }}" alt="">
    </button>


    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav w-100 align-items-lg-center align-items-sm-center text-center">
            <li class="nav-item">
                <a class="nav-link dr" href="{{ route('home') }}">Публикации</a>
            </li>
            <li class="nav-item">
                <a class="nav-link dr" href="{{ route('users') }}">Люди</a>
            </li>

            <li class="nav-item ml-md-auto">
                <a class="nav-link" href="{{ route('post.create') }}">
                    <button class="add-project-btn">+ <span>Добавить проект</span></button>
                </a>
            </li>
            <li class="nav-item dropdown row justify-content-center">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <span class="username">{{Auth::user()->name}}</span>
                            <p class="subdropdown">{{Auth::user()->profileType}}</p>
                        </div>
                        <div class="col-4 text-md-center">
                            <img class="nav-user-image"
                                 src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : asset('ext2/images/user-avatar.jpg')}}"
                                 alt="User image">
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('myPosts') }}">My Projects</a>
                    <a class="dropdown-item" href="{{ route('dashboard') }}">Settings</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                        Exit
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
<div class="wrapper needs_to_be_blurred">
    <div class="container-fluid">
        @yield('content')
    </div>
</div>
{{-- @if(isset($data['info']))
    @if($data['info'] == true)
        <!-- Button trigger modal -->
        <button type="button" id="first_trigger" style="display:none" class="btn btn-primary" data-toggle="modal"
                data-target="#first_welcome_modal">
            First Trigger
        </button>
        <div class="modal fade" id="first_welcome_modal" tabindex="-1" role="dialog"
             aria-labelledby="first_welcome_modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="w-100 d-flex justify-content-center p-3 border-0">
                        <h5 class="modal-title" id="first_welcome_modal_title">Добро пожаловать в Worklance!</h5>
                    </div>
                    <div class="modal-body d-flex justify-content-center">
                        <img src="{{asset('ext2/images/welcome 1.webp')}}" alt="welcome">
                    </div>
                    <div class="modal-footer d-flex justify-content-center border-0">
                        <button type="button" class="btn shadow-none bg-transparent" data-dismiss="modal"
                                data-toggle="modal" data-target="#second_welcome_modal">
                            Продолжить
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade" id="second_welcome_modal" tabindex="-1" role="dialog"
             aria-labelledby="second_welcome_modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="w-100 d-flex justify-content-center p-3 border-0">
                        <h5 class="modal-title" id="second_welcome_modal_title">Добавьте свои Skills!</h5>
                    </div>
                    <div class="modal-custom-content p-3">
                        <form action="{{ route('personalInfo') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <label for="role">Выберите стек</label>
                                <select name="role" id="new_users_role" class="input-style">
                                    @if(Auth::user()->role != null)
                                        <option value="{{Auth::user()->role}}">{{Auth::user()->role}}</option>
                                    @endif
                                    <option value="Design">Design</option>
                                    <option value="Front-end">Front-end</option>
                                    <option value="Back-end">Back-end</option>
                                </select>
                                <label for="skills[]">Выберите Skills</label>
                                <select name="skills[]" required
                                        class="selectpicker multiselect1 input-style-picker form-control"
                                        multiple id="new_users_skills"
                                        data-live-search="true"
                                        data-size="4">
                                    @foreach ($data['skills'] as $skill)
                                        <option>{{ $skill->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer d-flex justify-content-center border-0">
                                <button type="button" class="btn btn-primary" id="second_modal_submit" data-dismiss="modal" data-toggle="modal"
                                        data-target="#third_welcome_modal">
                                    Продолжить
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="third_welcome_modal" tabindex="-1" role="dialog"
             aria-labelledby="third_welcome_modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="w-100 d-flex justify-content-center p-3 border-0">
                        <h5 class="modal-title" id="first_welcome_modal_title">Добавьте о себе</h5>
                    </div>
                    <form action="{{ route('personalInfo') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="d-flex flex-column">
                                <label for="about">О себе</label>
                                <textarea name="about" id="about_new_user" class="custom-input" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center border-0">
                            <button type="button" class="btn btn-primary" id="third_modal_submit" data-dismiss="modal" data-toggle="modal"
                                    data-target="#third_welcome_modal">
                                Продолжить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="{{asset('data/js/need_info_modal.js')}}"></script>
    @endif
@endif --}}

<script>
    $(function () {
        $('.dr').each(function () {
            if ($(this).prop('href') == window.location.href) {
                $(this).addClass('active');
                $(this).parents('li').addClass('active');
            }
        });
    });
</script>
</body>
</html>
