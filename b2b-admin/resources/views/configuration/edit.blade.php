@extends('layout')

@section('content')
    <form method="POST" action="{{ route('configuration.update') }}">
        @csrf
        <input name="_method" type="hidden" value="PUT">

        <div class="card card-default open-close-card jq-open-close-card @if(!empty($filter->getShow('settings'))) collapsed-card @endif" data-card="settings">
            @include('_partials.card.header', ['title' => __('view.form.edit.labels.data.settings'), 'collapse' => !empty($filter->getShow('settings')) ? true : false])
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">{{ __('view.configuration.label.language_id') }}</label>
                            <select class="form-control select2-no-search" name="language_id" id="language_id" style="width: 100%;">
                                @foreach($languages as $id => $language)
                                    @if((!empty(old('language_id')) && old('language_id') == $id) || (empty(old('language_id')) && array_key_exists('language_id', $configuration) && $configuration['language_id'] == $id))
                                        <option value="{{ $id }}" selected>{{ $language }}</option>
                                    @else
                                        <option value="{{ $id }}">{{ $language }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pagination_size">{{ __('view.configuration.label.pagination_size') }}</label>
                            <input type="number" class="form-control" id="pagination_size" name="pagination_size" value="{{ !empty(old('pagination_size')) ? old('pagination_size') : (array_key_exists('pagination_size', $configuration) ? $configuration['pagination_size'] : 0) }}" />
                        </div>
                        <div class="form-group">
                            <label for="pagination_size">{{ __('view.configuration.label.minimum_password_length') }}</label>
                            <input type="number" class="form-control" id="minimum_password_length" name="minimum_password_length" value="{{ !empty(old('minimum_password_length')) ? old('minimum_password_length') : (array_key_exists('minimum_password_length', $configuration) ? $configuration['minimum_password_length'] : 0) }}" />
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