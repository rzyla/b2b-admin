@extends('layout')

@section('content')
    <form method="POST" action="{{ route('users.update', [$user->id]) }}">
        @csrf
        <input name="_method" type="hidden" value="PUT">
        <div class="card-body white-background silver-border radius-border-top">
            <div class="form-group">
                <label for="name">{{ __('labels.name_last_name') }}</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="" value="{{ !empty(old('name')) ? old('name') : $user->name }}">
            </div>
            <div class="form-group">
                <label for="email">{{ __('labels.email') }}</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="" value="{{ !empty(old('email')) ? old('email') : $user->email }}">
            </div>
            <div class="form-group">
                <label for="password">{{ __('labels.password') }} <small class="text-danger">{{ __('labels.password_small_text') }}</small></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="">
                <div><small>{{ __('labels.minimum_password_length') }} {{  $application->minimumPasswordLength()  }}</small></div>
            </div>
        </div>
        <div class="card-footer silver-border radius-border-bottom">
            <button type="submit" class="btn btn-primary float-right">{{ __('common.button_save') }}</button>
        </div>
    </form>
@endsection