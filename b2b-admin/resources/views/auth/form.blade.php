<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <link rel="stylesheet" href="/assets/styles/adminlte.min.css">
        <link rel="stylesheet" href="/assets/styles/style.css">
        @yield('styles')
        <title>{{ $application->getMetaTitle() }}</title>
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
        <div class="login-logo">{{ __('view.application.name') }}</div>
            @include('_partials/alert')
            <div class="card">
                <div class="card-body login-card-body">
                    <form action="{{ route('login') }}" method="post">
                    @csrf
                        <div class="input-group mb-3">
                            <input type="email" name="email"  value="{{ !empty(old('email')) ? old('email') : '' }}" class="form-control" placeholder="{{ __('view.auth.placeholder.email_address') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="{{ __('view.auth.placeholder.password') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember" name="remember">
                                    <label for="remember">{{ __('view.auth.label.remember_me') }}</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">{{ __('view.button.login') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="/assets/plugins/jquery/jquery.min.js"></script>
        <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/scripts/adminlte.min.js"></script>
        @yield('scripts')
    </body>
</html>