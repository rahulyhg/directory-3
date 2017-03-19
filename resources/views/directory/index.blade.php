@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-2">
            @include('partials.subnav')
        </div>

        <div class="col-sm-12 col-md-9 col-md-offset-1">
            <h1>Member Directory</h1>
            <hr />


            @foreach ($families->chunk(3) as $fams)
            <div class="row clearfix">

                @foreach($fams as $family)
                <div class="family-unit col-xs-6 col-md-4">

                    <div class="family-photo">
                        <a href="/directory/{{ $family->slug }}">
                            @if($family->thumbnail)
                                <img src="/public/directory/thb/{{ $family->thumbnail }}" alt="{{ $family->name }}" />
                            @else
                                No photo
                            @endif
                        </a>
                    </div>
                    <div class="family-name">
                        <h4>
                            <a href="/directory/{{ $family->slug }}">{{ $family->name }}</a>
                        </h4>
                    </div>
                    <div class="family-members">
                        <span class="family-head">
                        @foreach ($family->members as $member)
                            @if($member->family_role_id == 1)
                                {{ $member->first_name }}
                            @elseif($member->family_role_id == 2)
                                &amp; {{ $member->first_name }}
                            @endif
                        @endforeach
                        </span>

                        <br>

                        <span class="family-kids">
                        @foreach ($family->members as $member)
                            @if($member->family_role_id == 3)
                                {{ $member->first_name }},
                            @endif
                        @endforeach
                        </span>
                    </div>

                </div>
                @endforeach

            </div>
            @endforeach


        </div>
    </div>
</div>
@endsection
