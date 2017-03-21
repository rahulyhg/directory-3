@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-2">
            @include('partials.subnav')
        </div>

        <div class="col-sm-12 col-md-9 col-md-offset-1">

            @if($family->thumbnail)
            <div style="float:right;"><img src="/public/directory/thb/{{ $family->thumbnail }}" alt="{{ $family->name }}"></div>
            @endif
            
            <h1>{{ $family->name }}</h1>

            <hr />

            <div style="margin:30px 0;">
                <h3>{{ $family->phone }}</h3>
                <p>{{ $family->address }}<br />
                {{ $family->city . ', ' . $family->state . ' ' . $family->zip }}</p>
                @if ($family->anniversary)Anniversary: {{ $family->anniversary->format('F j, Y') }}@endif
            </div>

            <hr />

            <ul class="list-group" style="margin-top: 30px;">
                @foreach ($family->members as $member)
                    <li class="list-group-item">
                        <h4>{{ $member->first_name }} {{ $member->last_name }}</h4>
                        @if ($member->email){{ $member->email }}<br />@endif
                        @if ($member->mobile){{ $member->mobile }}<br />@endif
                        @if ($member->birthday){{ $member->birthday->format('F j') }}<br />@endif
                    </li>
                @endforeach
            </ul>

            <hr />

            <div class="action-btns">
                <a href="{{ action('FamilyController@edit', ['slug' => $family->slug]) }}" class="btn btn-default"><i class="fa fa-pencil-square-o"></i> Edit</a>
                <form method="POST" action="{{ action('FamilyController@destroy', ['id' => $family->id]) }}" style="float:right;">
                    {!! csrf_field() !!}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger" onclick="if ( ! confirm('Are you sure you want to delete this family and its members? Set the family status to Closed if unsure.') ) return false;"><i class="fa fa-trash"></i> Delete</button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
