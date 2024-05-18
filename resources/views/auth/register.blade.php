<!doctype html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('assets/login_2/font.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/login_2/font-awesome.min.css') }}"> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('assets/login_2/style.css') }}">

</head>

<body class="img js-fullheight" style="background-image: url(assets/login_2/bg.jpg);">
    <section style="padding:20px 0px 10px 0px;">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <h3 class="mb-4 text-center">Register</h3>

                        <form method="POST" action="{{ route('register') }}" class="signin-form">
                            @csrf

                            <div class="form-group">
                                <input placeholder="Name" id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input placeholder="Email" id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input placeholder="Password" id="password-field" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                <span toggle="#password-field"
                                    class="fa fa-fw fa-eye field-icon toggle-password"></span>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                             <div class="form-group">
                                <input placeholder="Confirm Password" id="password-confirm" type="password"
                                    class="form-control @error('password') is-invalid @enderror"  name="password_confirmation"
                                    required autocomplete="new-password">

                                <span toggle="#password-confirm"
                                    class="fa fa-fw fa-eye field-icon toggle-password"></span>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <span class="p-2">{!! captcha_img() !!}</span>

                                <button type="button" class="btn btn-danger" class="reload" id="reload">
                                    &#x21bb;
                                </button>
                            </div>

                            <div class="form-group">
                                <input placeholder="Captcha" id="captcha" type="text"
                                    class="form-control @error('captcha') is-invalid @enderror" name="captcha" required>

                                @error('captcha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Register</button>
                            </div>

                        </form>

                        <p class="w-100 text-center m-0">
                            <a href="{{ route('login') }}" style="color: #fff">- Login -</a>
                        </p>

                    </div>
                </div>
            </div>

        </div>
    </section>

    <script src="{{ asset('assets/login_2/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/login_2/popper.js') }}"></script>
    <script src="{{ asset('assets/login_2/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/login_2/main.js') }}"></script>
    <script src="{{ asset('assets/login_2/beacon.min.js') }}"></script>

    <script type="text/javascript">
        $(document).on("click", "#reload", function(e) {
            $.ajax({
                type: 'GET',
                url: 'reload-captcha',
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    </script>

</body>

</html>
