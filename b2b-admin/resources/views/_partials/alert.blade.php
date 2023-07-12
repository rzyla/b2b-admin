@if (!empty($application->getSuccess()))
    <div class="alerts">
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ $application->getSuccess() }}
        </div>
    </div>
@endif 

@if($errors->any())
    <div class="alerts">
        @foreach($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ $error }}
            </div>
        @endforeach
    </div>
@endif