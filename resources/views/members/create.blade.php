@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Add a Member</h1>

                @include('partials.errors')
            </div>
        </div>

        <div class="row">
            {!! Form::open (['method' => 'POST', 'action' => ['MemberController@store'], 'files' => true]) !!}
                @include('members.form', ['submitButtonText' => 'Save', 'addAnotherButtonText' => 'Save and Add More'])
            {!! Form::close() !!}
        </div>

    </div>
@stop

@section('js')
    <script src="/js/status.js"></script>

    <script src="/js/jquery.mask.min.js"></script>
    <script>
    	$('#member-mobile').mask('(000) 000-0000');

        $('.btn-save-add').on('click', function(){
            $('.member-add-another').val('true');
        });
    </script>
@endsection
