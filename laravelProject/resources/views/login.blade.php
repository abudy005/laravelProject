<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login - Molla Shop</title>

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/shop/images/icons/favicon-32x32.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/shop/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/shop/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/shop/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/shop/css/skins/skin-demo-2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/shop/css/demos/demo-2.css') }}">
</head>

<body>
    <div class="page-wrapper">

        <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17"
             style="background-image: url('{{ asset('assets/shop/images/backgrounds/login-bg.jpg') }}')">
            <div class="container">
                <div class="form-box">
                    <div class="form-tab">
                        <ul class="nav nav-pills nav-fill" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin"
                                   role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">

                                @if (session('error'))
                                    <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                                @endif

                                <form action="{{ route('login.post') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Email address *</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                               id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password *</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                               id="password" name="password" required>
                                        @error('password')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>LOG IN</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                                            <label class="custom-control-label" for="remember">Remember Me</label>
                                        </div>
                                    </div>
                                </form>

                            </div><!-- .End .tab-pane -->
                        </div><!-- End .tab-content -->
                    </div><!-- End .form-tab -->
                </div><!-- End .form-box -->
            </div><!-- End .container -->
        </div><!-- End .login-page -->

    </div><!-- End .page-wrapper -->

    <script src="{{ asset('assets/shop/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/shop/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/shop/js/main.js') }}"></script>
</body>

</html>
