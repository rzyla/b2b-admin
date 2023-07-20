@extends('layout')

@section('content')
    <form method="POST" action="{{ route('pages.store') }}">
        @csrf

        <div class="card card-default open-close-card jq-open-close-card @if(!empty($filter->getShow('basic'))) collapsed-card @endif" data-card="basic">
            @include('_partials.card.header', ['title' => __('view.form.edit.labels.data.basic'), 'collapse' => !empty($filter->getShow('basic')) ? true : false])
            <div class="card-body">
                <div class="row">
                <div class="col-md-12">
                        <div class="form-group">
                            <label for="title">{{ __('view.users.label.title') }}</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="" value="{{ !empty(old('title')) ? old('title') : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="symbol">{{ __('view.users.label.symbol') }}</label>
                            <input type="text" class="form-control" id="symbol" name="symbol" placeholder="" value="{{ !empty(old('symbol')) ? old('symbol') : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="language_id">{{ __('view.users.label.language') }}</label>
                            <select class="form-control select2-no-search" name="language_id" id="language_id" style="width: 100%;">
                                @foreach($languages as $id => $language)
                                    @if(!empty(old('language_id')) && old('language_id') == $id)
                                        <option value="{{ $id }}" selected>{{ $language }}</option>
                                    @else
                                        <option value="{{ $id }}">{{ $language }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="published">{{ __('view.users.label.published') }}</label>
                            <select class="form-control select2 width-100p" name="published" id="published">
                                @if(!empty(old('published')) && old('published') == 0)
                                    <option value="0" selected>{{ __('view.no') }}</option>
                                @else
                                    <option value="0">{{ __('view.no') }}</option>
                                @endif
                                @if(!empty(old('published')) && old('published') == 1)
                                    <option value="1" selected>{{ __('view.yes') }}</option>
                                @else
                                    <option value="1">{{ __('view.yes') }}</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-default open-close-card jq-open-close-card @if(!empty($filter->getShow('details'))) collapsed-card @endif" data-card="details">
            @include('_partials.card.header', ['title' => __('view.form.edit.labels.data.details'), 'collapse' => !empty($filter->getShow('details')) ? true : false])
            <div class="card-body">
                <div class="row">
                <div class="col-md-12">
                        <div class="form-group">
                            <label for="lead">{{ __('view.users.label.lead') }}</label>
                            <textarea class="jq-summernote-200" name="lead" id="lead">{{ !empty(old('lead')) ? old('lead') : '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('view.users.label.description') }}</label>
                            <textarea class="jq-summernote-500" name="description" id="description">{{ !empty(old('description')) ? old('description') : '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-default open-close-card jq-open-close-card @if(!empty($filter->getShow('meta'))) collapsed-card @endif" data-card="meta">
            @include('_partials.card.header', ['title' => __('view.form.edit.labels.data.meta'), 'collapse' => !empty($filter->getShow('meta')) ? true : false])
            <div class="card-body">
                <div class="row">
                <div class="col-md-12">
                        <div class="form-group">
                            <label for="meta_title">{{ __('view.meta.label.title') }}</label>
                            <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="" value="{{ !empty(old('meta_title')) ? old('meta_title') : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="meta_words">{{ __('view.meta.label.words') }}</label>
                            <input type="text" class="form-control" id="meta_words" name="meta_words" placeholder="" value="{{ !empty(old('meta_words')) ? old('meta_words') : ''}}">
                        </div>
                        <div class="form-group">
                            <label for="lead">{{ __('view.meta.label.description') }}</label>
                            <textarea class="form-control" name="meta_description" id="meta_description">{{ !empty(old('meta_description')) ? old('meta_description') : '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-default open-close-card jq-open-close-card @if(!empty($filter->getShow('edit'))) collapsed-card @endif" data-card="edit">
            @include('_partials.card.header', ['title' => __('view.form.edit.labels.data.edit'), 'collapse' => !empty($filter->getShow('edit')) ? true : false])
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="created_at">{{ __('view.users.label.created_at') }}</label>
                            <input type="text" class="form-control" id="created_at" placeholder="" value="" readonly>
                        </div>
                        <div class="form-group">
                            <label for="modified_at">{{ __('view.users.label.updated_at') }}</label>
                            <input type="text" class="form-control" id="updated_at" placeholder="" value="" readonly>
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