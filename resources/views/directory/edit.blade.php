@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Edit Family: "{{ $family->name }}"</h1>

            @include('partials.errors')
        </div>
    </div>

    <div class="row">
        {!! Form::model( $family,['method' => 'PATCH', 'action' => ['FamilyController@update', $family->id], 'files' => true]) !!}
            @include('directory.form', ['submitButtonText' => 'Update'])
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

    <script>
        // On page load, set example uri default value to the slug
        var $start = $(".slugjs-slug").val();
        $(".slugjs-uri").text($start);
    </script>
@endsection
