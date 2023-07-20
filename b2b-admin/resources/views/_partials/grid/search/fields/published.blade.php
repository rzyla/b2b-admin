<label>{{ $label }}</label>
<select name="filters[published]" class="form-control select2-no-search" data-default-value="">
    <option value="">&nbsp;</option>
    @if($filter->getFilter('published') == "0")
        <option value="0" selected>{{ __('view.no') }}</option>
    @else
        <option value="0">{{ __('view.no') }}</option>
    @endif
    @if($filter->getFilter('published') == "1")
        <option value="1" selected>{{ __('view.yes') }}</option>
    @else
        <option value="1">{{ __('view.yes') }}</option>
    @endif
</select>