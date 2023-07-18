@extends('layout')

@section('content')
    <form method="POST" action="{{ route('configuration.update') }}">
        @csrf
        <input name="_method" type="hidden" value="PUT">
        <div class="card-body white-background silver-border radius-border-top">
            <div class="form-group">
                <label for="name">{{ __('view.configuration.label.language_id') }}</label>
                <select class="form-control select2-no-search" name="language_id" id="language_id" style="width: 100%;">
                    @foreach($languages as $id => $language)
                        @if((!empty(old('language_id')) && old('language_id') == $id) || (empty(old('language_id')) && array_key_exists('language_id', $configuration) && $configuration['language_id'] ==  $id))
                            <option value="{{ $id }}" selected>{{ $language }}</option>
                        @else
                            <option value="{{ $id }}">{{ $language }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="card-footer silver-border radius-border-bottom">
            <button type="submit" class="btn btn-primary float-right">{{ __('view.button.save') }}</button>
        </div>
    </form>
@endsection