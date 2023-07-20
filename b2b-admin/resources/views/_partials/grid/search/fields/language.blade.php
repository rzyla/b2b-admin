<label>{{ $label }}</label>
<select name="filters[language]" class="form-control select2-no-search" data-default-value="">
    <option value="">&nbsp;</option>
    @foreach($languages as $id => $name)
        @if($filter->getFilter('language') == $id)
            <option value="{{ $id }}" selected>{{ $name }}</option>
        @else
            <option value="{{ $id }}">{{ $name }}</option>
        @endif
    @endforeach
</select>