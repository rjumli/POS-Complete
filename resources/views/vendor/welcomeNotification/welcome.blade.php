<!DOCTYPE html>
<html data-layout-mode="light" data-sidebar="dark" data-sidebar-image="none" data-layout-style="default"
    data-layout-position="fixed" data-sidebar-size="sm" data-topbar="dark" data-layout-width="fluid"
    data-layout="vertical" data-preloader="disable" lang="" id="heady">
@php $css_file = "css/app.css"; @endphp

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link href="{{ mix('/css/bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ mix('/css/icons.css') }}" rel="stylesheet" />
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <link rel="icon" href="{{ url('adzu.ico') }}">
    <script src="{{ mix('/js/manifest.js') }}" defer></script>
    <script src="{{ mix('/js/vendor.js') }}" defer></script>
    <script src="{{ mix('/js/app.js') }}" defer></script>
</head>

<body>

    <div class="auth-page-content pt-5">
        <div class="container">
            
            <div class="row justify-content-center mt-5">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4">
                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">STSIMS - DOST</h5>
                                <p class="text-muted">Welcome, {{ $user->email }}</p>
                            </div>
                            <div class="p-2">
                                <form method="POST">
                                    @csrf
                                    <input type="hidden" name="email" value="{{ $user->email }}"/>
                                    <div class="mb-3"><label class="form-label" for="password-input">Password</label>
                                        <div class="position-relative auth-pass-inputgroup">
                                            <input type="password" class="form-control pe-5" placeholder="Enter password" name="password" required="">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="confirm-password-input">Confirm Password</label>
                                        <div class="position-relativemb-3">
                                            <input type="password" class="form-control pe-5" placeholder="Confirm password" name="password_confirmation" required="">
                                        </div>
                                    </div>

                                    @error('password')
                                    <span>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                   
                                 
                                    <div class="mt-4">
                                        <button class="btn btn-success btn-md w-100" type="submit">
                                            <div class="btn-content">Save Password</div>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</body>

</html>
