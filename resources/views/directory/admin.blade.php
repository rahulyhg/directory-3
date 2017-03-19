@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>
                Admin Dashboard
                <span class="action-btns pull-right">
                    <a href="/family/create" class="btn btn-primary"><i class="fa fa-plus"></i>Add Family</a>
                    <a href="/members/create" class="btn btn-default"><i class="fa fa-plus"></i>Add a Member</a>
                </span>
            </h1>

            <?php $direction = (Request::get('direction') == 'asc') ? 'desc' : 'asc' ; ?>

            <table class="table table-striped">
                <tr>
                    <th>
                        <?php $sort_by = (Request::get('sort_by') == 'name') ? 'name' : '' ; ?>
                        <a href="{{ action('FamilyController@admin', ['sort_by' => 'name', 'direction' => $direction] ) }}">
                            Name
                            @if ($sort_by == "name" AND $direction == "asc")
                                <i class="fa fa-sort-desc" aria-hidden="true"></i>
                            @elseif ($sort_by == "name" AND $direction == "desc")
                                <i class="fa fa-sort-asc" aria-hidden="true"></i>
                            @else
                                <i class="fa fa-sort" aria-hidden="true"></i>
                            @endif
                        </a>
                    </th>
                    <th>
                        <?php $sort_by = (Request::get('sort_by') == 'updated_at') ? 'updated_at' : '' ; ?>
                        <a href="{{ action('FamilyController@admin', ['sort_by' => 'updated_at', 'direction' => $direction] ) }}">
                            Last Updated
                            @if ($sort_by == "updated_at" AND $direction == "asc")
                                <i class="fa fa-sort-desc" aria-hidden="true"></i>
                            @elseif ($sort_by == "updated_at" AND $direction == "desc")
                                <i class="fa fa-sort-asc" aria-hidden="true"></i>
                            @else
                                <i class="fa fa-sort" aria-hidden="true"></i>
                            @endif
                        </a>
                    </th>
                    <th>
                        <?php $sort_by = (Request::get('sort_by') == 'status_id') ? 'status_id' : '' ; ?>
                        <a href="{{ action('FamilyController@admin', ['sort_by' => 'status_id', 'direction' => $direction] ) }}">
                            Status
                            @if ($sort_by == "status_id" AND $direction == "asc")
                                <i class="fa fa-sort-desc" aria-hidden="true"></i>
                            @elseif ($sort_by == "status_id" AND $direction == "desc")
                                <i class="fa fa-sort-asc" aria-hidden="true"></i>
                            @else
                                <i class="fa fa-sort" aria-hidden="true"></i>
                            @endif
                        </a>
                    </th>

                    <th>
                        &nbsp;
                    </th>
                </tr>

                @foreach ($families as $family)
                    <tr>
                        <td>
                            @if ($family->status_id == 2)
                                <span class="text-warning">{{ $family->name }}@if($family->head), {{ $family->head->first_name }}@endif</span>
                            @else
                                <a href="/family/{{ $family->slug }}">{{ $family->name }}@if($family->head), {{ $family->head->first_name }}@endif</a>
                            @endif
                        </td>
                        <td>
                            {{ $family->updated_at->diffForHumans() }}
                        </td>
                        <td>
                            {{ $family->status_id }}
                        </td>

                        <td>
                            <span class="action-btns-no-text pull-right">

                                <a style="margin: 0 5px;" class="btn btn-default" href="{{ url('family/' . $family->slug . '/edit') }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                                <form style="display: inline-block;" method="POST" action="{{ url('family/' . $family->id) }}">
                                    {!! csrf_field() !!}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-default" onclick="if ( ! confirm('Are you sure you want to delete this family and its members? Set the family status to Closed if unsure.') ) return false;"><i class="fa fa-trash"></i></button>
                                </form>

                            </span>
                        </td>
                    </tr>
                @endforeach

            </table>
        </div>
    </div>
</div>
@endsection


@section('js')

@endsection
