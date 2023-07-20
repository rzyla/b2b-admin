@extends('layout')

@section('content')
    <form method="POST" action="{{ route('account.update') }}" enctype="multipart/form-data">
        @csrf
        <input name="_method" type="hidden" value="PUT">

        <div class="card card-default open-close-card jq-open-close-card @if(!empty($filter->getShow('basic'))) collapsed-card @endif" data-card="basic">
            @include('_partials.card.header', ['title' => __('view.form.edit.labels.data.basic'), 'collapse' => !empty($filter->getShow('basic')) ? true : false])
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">{{ __('view.account.label.name') }}</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="" value="{{ !empty(old('name')) ? old('name') : $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">{{ __('view.account.label.email') }}</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="" value="{{ !empty(old('email')) ? old('email') : $user->email }}">
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('view.account.label.password') }} <small class="text-danger">{{ __('view.account.label.password.small_text') }}</small></label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="">
                            <div><small>{{ __('view.account.info.minimum_password_length') }} {{ $minimum_password_length }}</small></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-default open-close-card jq-open-close-card @if(!empty($filter->getShow('image'))) collapsed-card @endif" data-card="image">
            @include('_partials.card.header', ['title' => __('view.form.edit.labels.data.image'), 'collapse' => !empty($filter->getShow('image')) ? true : false])
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">{{ __('view.account.label.avatar') }}</label>
                            @if(empty($user->avatar))
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="avatar" name="avatar" />
                                    <label class="custom-file-label" for="avatar"></label>
                                </div>
                            @else
                                <div>
                                    <img src="{{ ImageHelper::Thumb($application->user->avatar, 200, 200) }}" alt="" />
                                </div>
                                <input type="checkbox" value="delete" name="deleteAvatar" /> {{ __('view.account.label.delete_avatar') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix buttons-bottom margin-top-20">
            <button type="submit" class="btn btn-primary float-right">{{ __('view.button.save') }}</button>
        </div>
    </form>
@endsection