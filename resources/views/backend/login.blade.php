<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<!--
Framework 1.7 >>>by Taha Alaa
eng.tahaalaa@gmail.com
00201013758590
-->
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Dashboard / login</title>
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body style="background-image:url({{url('/storage/images/bg.png')}});">

<div class="body"></div>
<div class="grad"></div>
<div class="header">
    <div>Dashboard</div>
</div>
<br>
<div class="login">
    <form  method="POST" action="{{ route('login') }}">
        @csrf
        <input type="text" placeholder="email" name="email"><br>
        @error('email')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
        <input type="password" placeholder="password" name="password"><br>
        @error('password')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
        <input  type="submit" value="Login">
    </form>
</div>

</body>
</html>
