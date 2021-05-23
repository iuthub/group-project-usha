@extends('layouts.navAndFooter')
@section('content')
    <div class="col-lg-8 m-2 m-md-3 ">
        <h6 class="title">Add Project</h6>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/post" method="POST" autocomplete="on">
            @csrf
            <input name="name" required class="input-style" type="text" placeholder="Project name">

            <div id="editor">
                <h3>Project details</h3>
            </div>

            <textarea name="about" required class="input-style" type="text" placeholder="References"></textarea>
            <textarea name="description" required rows="7" class="input-style" placeholder="Project details"></textarea>
            <div class="row">
                <div class="col-md-12">
                    <select name="skills[]" required class="selectpicker multiselect1 input-style-picker form-control" multiple
                            data-live-search="true"
                            data-size="4">
                        @foreach ($skills as $skill)
                            <option>{{ $skill->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <input name="reference" required class="input-style" type="text" placeholder="Telegram Username">
            <input name="user_id" required type="hidden" value="{{Auth::user()->id}}">
            <div class="row">
                <div class="col-md-8">
                    <input name="price" required class="input-style" type="text" placeholder="Price">
                </div>
                <div class="d-flex justify-content-end align-items-center col-md-4">
                    <a href="{{url()->previous()}}" class="back-btn m-0 mr-3">Back</a>
                    <button href="{{ url()->previous()}}" class="active-btn m-0">Save</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        initSample();
    </script>
@endsection