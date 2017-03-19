<ul class="list-unstyled subnav">
    <li>
        <a href="/">All</a>
    </li>
    <li>
        <a href="{{ action('FamilyController@create') }}">Add a Family</a>
    </li>
    <li>
        <a href="{{ action('MemberController@create') }}">Add a Member</a>
    </li>
    <li>
        <a href="{{ action('FamilyController@admin') }}">Admin</a>
    </li>
</ul>
