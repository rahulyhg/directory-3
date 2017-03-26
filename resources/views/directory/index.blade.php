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
                <div class="family-unit col-xs-12 col-md-6 col-lg-4">

                    <div class="family-photo">
                        <a href="{{ action('FamilyController@show', ['slug' => $family->slug]) }}">
                            @if($family->thumbnail)
                                <img src="/public/directory/thb/{{ $family->thumbnail }}" alt="{{ $family->name }}" />
                            @else
                                No photo
                            @endif
                        </a>
                    </div>
                    <div class="family-name">
                        <h4>
                            <a href="{{ action('FamilyController@show', ['slug' => $family->slug]) }}">{{ $family->name }}</a>
                        </h4>
                    </div>
                    <div class="family-members">
                        <span class="family-head">
                            @if($family->head)
                                {{ $family->head->first_name }}
                            @endif
                        </span>

                        <span class="family-spouse">
                            @if($family->spouse)
                                &amp; {{ $family->spouse->first_name }}
                            @endif
                        </span>

                        <br>

                        <span class="family-kids">
                            @if($family->dependants)
                                @foreach($family->dependants as $child)
                                    {{ $child->first_name }}@if($family->dependants->last() !== $child), @endif
                                @endforeach
                            @endif
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
