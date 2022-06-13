<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 ">

<div class="container-login">
    <div class="box-login">
        <h1 class="title">LOGO</h1>

        <form class="mt-6" action="{{ route('authenticate')}}" method="post">
            @csrf
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <div> 
                <label for="email" class="label">Email</label>
                <input type="email" name="email" id="email" placeholder="votre email@" value="{{ old('email')}}">
            </div>
            <div class="mt-4">
                <div>
                    <label for="password" class="label">Password</label>
                    <input type="password" name="password" id="password" placeholder="" >
                </div>
                <a href="#" class="link">Forget Password?</a>
                <div class="mt-6">
                    <button class="button-valid-login">
                        Login
                    </button>
                </div>
        </form>
        <p class="minimal"> Don't have an account? <a href="#"
                class="minimal-link">Sign up</a></p>
    </div>
</div>

</body>
</html>