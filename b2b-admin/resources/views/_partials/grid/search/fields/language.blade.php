<label>{{ $label }}</label>
<select name="filters[language]" class="form-control select2-no-search">
    <option>&nbsp;</option>
    @foreach($languages as $id => $name)
        @if($application->getFilter('language') == $id)
            <option value="{{ $id }}" selected>{{ $name }}</option>
        @else
            <option value="{{ $id }}">{{ $name }}</option>
        @endif
    @endforeach
</select>