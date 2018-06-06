@extends('layouts.master')
@section('content')
    <div>
        <div class="mt-5">
            <a href="{{action('Pages\UsersController@sort', ['column' => 'first_name'])}}">Sort By First Name</a>
        </div>
        <div class="mt-2 mb-2">
            <a href="{{action('Pages\UsersController@sort', ['column' => 'last_name'])}}">Sort By Last Name</a>
        </div>
        <div class="mt-2 mb-2">
            <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search the table...">
        </div>
        <table class="table table-responsive table-striped" id="usersTable">
            <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Website address</th>
            </tr>
            </thead>
            <tbody id="usersTableBody">
            @foreach($users as $user)
                <tr>
                    {{--First Name--}}
                    <td>{{ $user['first_name'] }}</td>
                    {{--Last Name--}}
                    <td>
                        {{ $user['last_name'] }}
                    </td>
                    {{--Email address--}}
                    <td>
                        <a href="mailto:{{ $user['email'] }}" >{{ $user['email'] }}</a>
                    </td>
                    {{--Website address--}}
                    <td>
                        <a href="http://{{ $user['website'] }}">{{ $user['website'] }}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('scripts')
    function searchTable() {
        var input, filter, table, tr, td, i, j, tds, ths, matched;
        input = document.getElementById('searchInput');
        filter = input.value.toUpperCase();
        tr = document.getElementsByTagName('tr');

        // Loop through all table rows, and hide the ones that don't match the query
        for (i = 0; i < tr.length; i++) {
            tds = tr[i].getElementsByTagName('td');
            ths = tr[i].getElementsByTagName('th');
            matched = false;

            // Leave the row header
            if (ths.length > 0) {
                matched = true;
            } else {
                for (j = 0; j < tds.length; j++) {
                    td = tds[j];
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        matched = true;
                        break;
                    }

                }
            }
            if (matched == true) {
                tr[i].style.display = '';
            } else {
                tr[i].style.display = 'none';
            }
        }
    }
@endsection