<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
      data-sidebar-image="none" data-bs-theme="dark" data-body-image="img-1" data-preloader="disable">

<head>

    <meta charset="utf-8"/>
    <title>Login | {{$title}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="Themesbrand" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('template/velzon/')}}assets/images/favicon.ico">

    <!-- Layout config Js -->
    <script src="{{asset('template/velzon/assets/js/layout.js')}}"></script>
    <!-- Bootstrap Css -->
    <link href="{{asset('template/velzon/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="{{asset('template/velzon/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="{{asset('template/velzon/assets/css/app.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- custom Css-->
    <link href="{{asset('template/velzon/assets/css/custom.min.css')}}" rel="stylesheet" type="text/css"/>

</head>

<body>

<!-- auth-page wrapper -->
<div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="bg-overlay"></div>
    <!-- auth-page content -->
    <div class="auth-page-content overflow-hidden pt-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card overflow-hidden card-bg-fill border-0 card-border-effect-none">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4 auth-one-bg h-100">
                                    <div class="bg-overlay"></div>
                                    <div class="position-relative h-100 d-flex flex-column">
                                        <div class="mb-4">
                                            <a href="#" class="d-block">
                                                <img src="{{asset('template/velzon/')}}assets/images/logo-light.png"
                                                     alt="" height="18">
                                            </a>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->

                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4">
                                    <div>
                                        <h5 class="text-primary">Halaman Login !</h5>
                                        <p class="text-muted">Silahkan Login terlebih dahulu.</p>
                                        @error('email')
                                            <div class="alert alert-danger" role="alert">
                                                <strong> Error! </strong> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mt-4">
                                        <form action="{{ route('login') }}" method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="text" name="email" class="form-control" id="email"
                                                        value="@if(Cookie::has('loginUser')) {{Cookie::get('loginUser')}} @else {{old('email')}} @endif" required>
                                            </div>

                                            <div class="mb-3">
                                                <div class="float-end">
                                                    <a href="{{route('password.request')}}" class="text-muted">Forgot password?</a>
                                                </div>
                                                <label class="form-label" for="password-input">Password</label>
                                                <div class="position-relative auth-pass-inputgroup mb-3">
                                                    <input type="password" name="password"
                                                           class="form-control pe-5 password-input" value="@if(Cookie::has('loginPassword')){{Cookie::get('loginPassword')}}@endif"
                                                           id="password-input" required>
                                                    <button
                                                        class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                        type="button" id="password-addon"><i
                                                            class="ri-eye-fill align-middle"></i></button>
                                                </div>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" value=""
                                                       id="auth-remember-check" @if(Cookie::has('loginUser')) checked  @endif>
                                                <label class="form-check-label" for="auth-remember-check">Remember
                                                    me</label>
                                            </div>

                                            <div class="mt-4">
                                                <button type="submit" class="btn btn-primary w-100">Sign In</button>
                                            </div>

                                            <div class="mt-4 text-center">
                                                <div class="signin-other-title">
                                                    <h5 class="fs-13 mb-4 title">Sign In with</h5>
                                                </div>

                                                <div>
                                                    <button type="button"
                                                            class="btn btn-primary btn-icon waves-effect waves-light"><i
                                                            class="ri-facebook-fill fs-16"></i></button>
                                                    <button type="button"
                                                            class="btn btn-danger btn-icon waves-effect waves-light"><i
                                                            class="ri-google-fill fs-16"></i></button>
                                                    <button type="button"
                                                            class="btn btn-dark btn-icon waves-effect waves-light"><i
                                                            class="ri-github-fill fs-16"></i></button>
                                                    <button type="button"
                                                            class="btn btn-info btn-icon waves-effect waves-light"><i
                                                            class="ri-twitter-fill fs-16"></i></button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>

                                    <div class="mt-5 text-center">
                                        <p class="mb-0">Don't have an account ? <a href="{{route('register')}}"
                                                                                   class="fw-semibold text-primary text-decoration-underline">
                                                Signup</a></p>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->

            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->
    <x-admint.footer-layout-admin/>
    <!-- end Footer -->
</div>
<!-- end auth-page-wrapper -->

<!-- JAVASCRIPT -->
<script src="{{asset('template/velzon/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('template/velzon/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('template/velzon/assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{asset('template/velzon/assets/libs/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('template/velzon/assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
<script src="{{asset('template/velzon/assets/js/plugins.js')}}"></script>

<!-- password-addon init -->
<script src="{{asset('template/velzon/assets/js/pages/password-addon.init.js')}}"></script>

<script>
    setTimeout(function () {
            $('.alert').fadeOut('slow');
        }, 2000
    );
</script>
</body>

</html>
