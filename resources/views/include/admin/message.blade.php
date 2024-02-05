@if(count($errors)>0)
    <div class="alert alert-danger mg-b-0" role="alert">
        <button aria-label="بستن" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">×</span>
        </button>
        <strong>اخطار! </strong>
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif
