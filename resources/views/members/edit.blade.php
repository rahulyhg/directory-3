@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Edit a Member: "{{ $member->first_name . ' ' . $member->last_name }}"</h1>

                @include('partials.errors')
            </div>
        </div>

        <div class="row">
            {!! Form::model( $member,['method' => 'PATCH', 'action' => ['MemberController@update', $member->id]]) !!}
                @include('members.form', ['submitButtonText' => 'Update'])
            {!! Form::close() !!}
        </div>

    </div>
@stop

@section('js')
    <script src="/js/status.js"></script>

    <script src="/js/jquery.mask.min.js"></script>
    <script>
    	$('#member-mobile').mask('(000) 000-0000');
    </script>
@endsection
