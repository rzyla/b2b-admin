<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        @if(count($application->buttons->get()) > 0)
          <h1 class="m-0 float-left">{{ $application->getTitle() }}</h1>
          @foreach($application->buttons->get() as $button)
            <a class="btn {{ $button->class }}" href="{{ route($button->route) }}" title="{{ $button->name }}"><i class="fas {{ $button->ico }}"></i></a>
          @endforeach
        @else
          <h1 class="m-0">{{ $application->getTitle() }}</h1>
        @endif
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          @foreach($application->breadcrumb->get() as $breadcrumb)
            @if($breadcrumb->active)
              <li class="breadcrumb-item active">{{ $breadcrumb->name }}</li>
            @else
              <li class="breadcrumb-item"><a href="/{{ $breadcrumb->route }}">{{ $breadcrumb->name }}</a></li>
            @endif
          @endforeach
        </ol>
      </div>
    </div>
  </div>
</div>