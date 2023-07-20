@extends('layout')

@section('content')

    <form method="POST" action="{{ route('setFilters', ['prefix' => $filter->getPrefix(), 'action' => $filter->getAction()]) }}" class="jq-open-close-card-form">
        @csrf
        <div class="card card-default open-close-card jq-open-close-card @if(!empty($filter->getShow('search'))) collapsed-card @endif" data-card="search">
            @include('_partials.card.header', ['title' => __('view.form.search.labels.search'), 'collapse' => !empty($filter->getShow('search')) ? true : false])
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group clearfix form-group-margin-for-icons margin-bottom-0">
                            <input type="text" value="{{ $filter->getFilter('search') }}" name="filters[search]" class="form-control" data-default-value="">
                        </div>
                        <div class="form-group-margin-icons">
                            @include('_partials.grid.filter.buttons', ['application' => $application, 'icon' => 'search'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    
    <div class="card card-default open-close-card jq-open-close-card @if(!empty($filter->getShow('attributes'))) collapsed-card @endif" data-card="attributes">
        @include('_partials.card.header', ['title' => __('view.form.search.labels.attributes'), 'collapse' => !empty($filter->getShow('attributes')) ? true : false])
        <div class="card-body">
            <div class="row d-block">
                <form method="POST" action="{{ route('attributes', ['prefix' => $application->getPrefix()]) }}" class="jq-open-close-card-form">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group clearfix form-group-margin-for-icons margin-bottom-0">
                            <select class="form-control select2-no-search" name="filters[attributes]" id="filters[attribute]" style="width: 100%;">
                                @foreach($attributes_all as $attribute)
                                    @if(!array_key_exists($attribute->attribute_id, $filter->getAttributes()))
                                        <option value="{{ $attribute->attribute_id }}">{{ $attribute->attribute_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group-margin-icons">
                            @include('_partials.grid.filter.buttons', ['application' => $application, 'icon' => 'plus'])
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <form method="POST" action="{{ route('setFilters', ['prefix' => $filter->getPrefix(), 'action' => $filter->getAction()]) }}" class="jq-open-close-card-form">
                @csrf
                    @foreach($attributes_set as $attribute)
                        <div class="col-md-4">
                            <div class="form-group clearfix form-group-margin-for-icons margin-bottom-0">
                                <select class="form-control select2-no-search" name="filters[attributes]" id="filters[attribute]" style="width: 100%;">
                                    @foreach($attributes_all as $attribute)
                                        @if(!array_key_exists($attribute->attribute_id, $filter->getAttributes()))
                                            <option value="{{ $attribute->attribute_id }}">{{ $attribute->attribute_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endforeach
                </form>
            </div>
        </div>
    </div>
    
    <form method="POST" action="{{ route('setFilters', ['prefix' => $filter->getPrefix(), 'action' => $filter->getAction()]) }}" class="jq-open-close-card-form">
        @csrf
        <div class="card card-default open-close-card jq-open-close-card @if(!empty($filter->getShow('filters'))) collapsed-card @endif" data-card="filters">
            @include('_partials.card.header', ['title' => __('view.form.search.labels.filters'), 'collapse' => !empty($filter->getShow('filters')) ? true : false])
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label>{{ __('view.form.search.labels.categories') }}</label>
                        <div class="form-group">
                            <select class="form-control select2-no-search" name="published" id="published" style="width: 100%;">
                               
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>{{ __('view.form.search.labels.groups') }}</label>
                        <div class="form-group">
                            <select class="form-control select2-no-search" name="published" id="published" style="width: 100%;">
                               
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>{{ __('view.form.search.labels.producer') }}</label>
                        <div class="form-group">
                            <select class="form-control select2-no-search" name="published" id="published" style="width: 100%;">
                               
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>{{ __('view.form.search.labels.supplier') }}</label>
                        <div class="form-group">
                            <select class="form-control select2-no-search" name="published" id="published" style="width: 100%;">
                               
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>{{ __('view.form.search.labels.active') }}</label>
                        <div class="form-group">
                            <select class="form-control select2-no-search" name="published" id="published" style="width: 100%;">
                               
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>{{ __('view.form.search.labels.picture.no') }}</label>
                        <div class="form-group">
                            <select class="form-control select2-no-search" name="published" id="published" style="width: 100%;">
                               
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>{{ __('view.form.search.labels.picture.no.active') }}</label>
                        <div class="form-group">
                            <select class="form-control select2-no-search" name="published" id="published" style="width: 100%;">
                               
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>{{ __('view.form.search.labels.picture.wrong') }}</label>
                        <div class="form-group">
                            <select class="form-control select2-no-search" name="published" id="published" style="width: 100%;">
                               
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group-margin-icons">
                        @include('_partials.grid.filter.buttons', ['application' => $application, 'icon' => 'filter'])
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="card card-content">
        <table class="table table-grid radius-border margin-bottom-0">
            <tbody>
                <tr>
                <th>#</th>
                <th>@include('_partials.grid.col.header', ['label' => __('view.users.label.name'), 'field' => 'name', 'application' => $application, 'filter' => $filter])</th>
                <th>@include('_partials.grid.col.header', ['label' => __('view.users.label.email'), 'field' => 'email', 'application' => $application, 'filter' => $filter])</th>
                <th></th>
                </tr>
                @foreach ($grid as $key => $item)
                <tr>
                    <td class="table-col-nb">{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td class="text-right">
                    
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="links">
        {{ $grid->links('pagination::bootstrap-5') }}
  </div>
@endsection