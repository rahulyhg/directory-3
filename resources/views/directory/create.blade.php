@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Add a Family</h1>

            @include('partials.errors')
        </div>
    </div>

    <div class="row">
        {!! Form::open (['method' => 'POST', 'action' => ['FamilyController@store'], 'files' => true]) !!}
            @include('directory.form', ['submitButtonText' => 'Add Family'])
        {!! Form::close() !!}
    </div>

</div>
@stop

@section('js')
<script src="/js/slug.js"></script>
<script src="/js/status.js"></script>

<script src="/js/jquery.mask.min.js"></script>
<script>
    $('#family-phone').mask('(000) 000-0000');
</script>
@endsection
