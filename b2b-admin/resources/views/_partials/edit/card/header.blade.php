<div class="card-header">
    <h3 class="card-title">{{ $title }}</h3>
    <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
            @if($collapse == true)
                <i class="fas fa-plus"></i>
            @else
                <i class="fas fa-minus"></i>
            @endif
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>