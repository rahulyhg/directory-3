@if (count($errors))
    <div class="bg-danger text-danger errors">
        <h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> There were some errors with your request.</h4>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
