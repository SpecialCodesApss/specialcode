@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card container">
                    <div class="card-header">Verify Your Email Address</div>
                    <div class="card-header"> Please Check the Code has been sent to your email and verify your account</div>

                    <div class="row">

                    <div class="col-md-6 offset-3 from-input">
                        <label for="verify_code" class="col-md-12 col-form-label text-md--left">
                         verification code</label>
                        <div class="col-md-12">
                         <input id="verify_code" type="text" class="form-control @error('verify_code') is-invalid @enderror" name="verify_code" value="{{ old('verify_code') }}" required autocomplete="verify_code" autofocus>
                         @error('verify_code')
                         <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                         </span>
                         @enderror
                         </div>
                    </div>

                        <div class="col-md-12 from-input">
                            <div class="col-md-4 offset-md-4">
                                <button type="submit" class=" form-control btn btn-primary">Verify</button>
                            </div>
                        </div>

                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection
