@extends('layout')

@section('content')
    <form method="POST" action="{{ route('users.update', [$user->id]) }}">
        @csrf
        <input name="_method" type="hidden" value="PUT">
        <div class="card-body white-background silver-border radius-border-top">
            <div class="form-group">
                <label for="name">{{ __('view.users.label.name') }}</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="" value="{{ !empty(old('name')) ? old('name') : $user->name }}">
            </div>
            <div class="form-group">
                <label for="email">{{ __('view.users.label.email') }}</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="" value="{{ !empty(old('email')) ? old('email') : $user->email }}">
            </div>
            <div class="form-group">
                <label for="password">{{ __('view.users.label.password') }} <small class="text-danger">{{ __('view.users.label.password.small_text') }}</small></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="">
                <div><small>{{ __('view.users.info.minimum_password_length') }} {{  $application->minimumPasswordLength()  }}</small></div>
            </div>
        </div>
        <div class="card-footer silver-border radius-border-bottom">
            <button type="submit" class="btn btn-primary float-right">{{ __('view.button.save') }}</button>
        </div>
    </form>
@endsection