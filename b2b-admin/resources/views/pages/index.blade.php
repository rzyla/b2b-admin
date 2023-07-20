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
      <div class="card card-default open-close-card jq-open-close-card @if(!empty($filter->getShow('filters'))) collapsed-card @endif" data-card="filters">
          @include('_partials.card.header', ['title' => __('view.form.search.labels.filters'), 'collapse' => !empty($filter->getShow('filters')) ? true : false])
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  @include('_partials.grid.search.fields.language', ['label' => __('view.pages.search.labels.language'), 'languages' => $languages, 'filter' => $filter])
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  @include('_partials.grid.search.fields.published', ['label' =>  __('view.pages.search.labels.published'), 'filter' => $filter])
                </div>
              </div>
            </div>
            @include('_partials.grid.search.buttons')
          </div>
      </div>
  </form>

  <div class="card card-content">
      <table class="table table-grid radius-border margin-bottom-0">
        <tbody>
          <tr>
            <th>#</th>
            <th>@include('_partials.grid.col.header', ['label' => __('view.users.label.title'), 'field' => 'title', 'application' => $application])</th>
            <th>@include('_partials.grid.col.header', ['label' => __('view.users.label.symbol'), 'field' => 'symbol', 'application' => $application])</th>
            <th>@include('_partials.grid.col.header', ['label' => __('view.users.label.language'), 'field' => 'language', 'application' => $application])</th>
            <th>@include('_partials.grid.col.header', ['label' => __('view.users.label.published'), 'field' => 'published', 'application' => $application])</th>
            <th>@include('_partials.grid.col.header', ['label' => __('view.users.label.created_at'), 'field' => 'created_at', 'application' => $application])</th>
            <th></th>
          </tr>
          @foreach ($grid as $key => $item)
            <tr>
              <td class="table-col-nb">{{ $item->id }}</td>
              <td>{{ $item->title }}</td>
              <td>{{ $item->symbol }}</td>
              <td>{{ $item->language }}</td>
              <td>
                @if($item->published == 1)
                  {{ __('view.yes') }}
                @else
                  {{ __('view.no') }}
                @endif
              </td>
              <td>{{ $item->created_at }}</td>
              <td class="text-right">
                @include('_partials.grid.row.buttons')
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