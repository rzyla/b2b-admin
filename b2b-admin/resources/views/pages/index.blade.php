@extends('layout')

@section('content')

  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('filters', ['prefix' => $application->getPrefix()]) }}">
        @csrf
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              @include('_partials.grid.search.fields.search', ['label' => __('view.form.search.labels.search'), 'application' => $application])
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              @include('_partials.grid.search.fields.language', ['label' => __('view.pages.search.labels.language'), 'languages' => $languages, 'application' => $application])
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              @include('_partials.grid.search.fields.published', ['label' =>  __('view.pages.search.labels.published'), 'application' => $application])
            </div>
          </div>
        </div>
        @include('_partials.grid.search.buttons')
      </form>
    </div>
  </div>
  <div class="card">
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