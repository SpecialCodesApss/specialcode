@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ trans('users.Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">


                            <div class="col-md-6
                            offset-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center text-center">
                                            <img src="{{url('storage/images/noimage.png')}}" class="image_profile img-radius" alt="User-Profile-Image" id="profile_image">
                                            <div class="mt-3">
                                                <input type="file" name="profile_image" id="profile_input" onchange="putImage('profile_input','profile_image','change_profile_btn')" name="image" class="inputfile_file">
                                                <button type="button" class="btn btn-outline-primary" onclick="OpenImgUpload('profile_input','change_profile_btn')">{{trans('users.Upload')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6 from-input">
                                <label for="fullname" class="col-md-12 col-form-label text-md--left">
                                    {{ trans('users.fullname') }}</label>
                                <div class="col-md-12">
                                    <input id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ old('fullname') }}" required autocomplete="fullname" autofocus>
                                    @error('fullname')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 from-input">
                                <label for="email" class="col-md-12 col-form-label text-md--left">
                                    {{ trans('users.email') }}</label>
                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 from-input">
                                <label for="mobile" class="col-md-12 col-form-label text-md--left">
                                    {{ trans('users.mobile') }}</label>
                                <div class="col-md-12">
                                    <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile" autofocus>
                                    @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6 from-input">
                                <label for="gender" class="col-md-12 col-form-label text-md--left">
                                    {{ trans('users.gender') }}</label>
                                <div class="col-md-12">

                                    <select name="gender" id="gender" class="form-control">--}}
                                       <option value="male" @if(old('gender'))=="male" selected @endif>{{ trans('users.Male') }}</option>
                                       <option value="female" @if(old('gender'))=="female" selected @endif>{{ trans('users.Female') }}</option>
                                    </select>
                                    @error('gender')
                                       <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                       </span>
                                    @enderror

                                </div>
                            </div>


                            <div class="col-md-6 from-input">
                                <label for="password" class="col-md-12 col-form-label text-md--left">
                                    {{ trans('users.Password') }}</label>
                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6 from-input">
                                <label for="password_confirmation" class="col-md-12 col-form-label text-md--left">
                                    {{ trans('users.Confirm Password') }}</label>
                                <div class="col-md-12">
                                    <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="{{ old('password_confirmation') }}" required autocomplete="password_confirmation" autofocus>
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-12 from-input">
                                <div class="col-md-6 offset-md-3">
                                    <button type="submit" class=" form-control btn btn-primary">{{ trans('users.Register_submit') }}</button>
                                </div>
                            </div>



                        </div>








{{--                        <div class="form-group row">--}}
{{--                            <div class="col-md-3"></div>--}}
{{--                        <div class="col-md-6 col-md-offset-3">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="d-flex flex-column align-items-center text-center">--}}

{{--                                    <img src="{{url('storage/images/noimage.png')}}" class="image_profile img-radius" alt="User-Profile-Image" id="profile_image">--}}

{{--                                    <div class="mt-3">--}}

{{--                                        <input type="file" name="profile_image" id="profile_input" onchange="putImage('profile_input','profile_image','change_profile_btn')" name="image" class="inputfile_file">--}}
{{--                                        <button type="button" class="btn btn-outline-primary" onclick="OpenImgUpload('profile_input','change_profile_btn')">{{trans('users.Upload')}}</button>--}}


{{--                                    </div>--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ trans('users.fullname') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ old('fullname') }}" required autocomplete="fullname" autofocus>--}}

{{--                                @error('fullname')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ trans('users.email') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ trans('users.mobile') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="mobile" type="mobile" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile">--}}

{{--                                @error('mobile')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}


{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ trans('users.gender') }}</label>--}}

{{--                            <div class="col-md-6">--}}

{{--                                <select name="gender" id="gender" class="form-control">--}}
{{--                                    <option value="male" @if(old('gender'))=="male" selected @endif>{{ trans('users.Male') }}</option>--}}
{{--                                    <option value="female" @if(old('gender'))=="female" selected @endif>{{ trans('users.Female') }}</option>--}}
{{--                                </select>--}}
{{--                                @error('gender')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ trans('users.Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ trans('users.Confirm Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Register') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        --}}



                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
