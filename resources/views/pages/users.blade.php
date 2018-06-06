@extends('layouts.master')
@section('content')
    <div>
        <input class="mt-5" type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search the table...">
        <table class="table table-responsive table-striped" id="usersTable">
            <thead>
            <tr>
                {{--Allow sort by first name--}}
                <th class="sortable" onclick="sortTable(users, 0, asc1); asc1 *= -1; asc2 = 1;">
                    First Name
                </th>
                {{--Allow sort by last name--}}
                <th class="sortable" onclick="sortTable(users, 1, asc2); asc2 *= -1; asc1 = 1;">
                    Last Name
                </th>
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
@section('css')
    .sortable {
        cursor: pointer;
    }
@endsection
@section('scripts')
    var users, asc1 = 1, asc2 = 1;
    window.onload = function () {
        users = document.getElementById('usersTableBody');
    };

    function sortTable(tbody, col, asc) {
        var rows = tbody.rows, rlen = rows.length, arr = new Array(), i, j, cells, clen;
        // Fill the array with values from the table
        for (i = 0; i < rlen; i++) {
            cells = rows[i].cells;
            clen = cells.length;
            arr[i] = new Array();
            for (j = 0; j < clen; j++) {
                arr[i][j] = cells[j].innerHTML;
            }
        }
        // Sort the array by the specified column number (col) and order (asc)
        arr.sort(function (a, b) {
            return (a[col] == b[col]) ? 0 : ((a[col] > b[col]) ? asc : -1 * asc);
        });
        for (i = 0; i < rlen; i++) {
            arr[i] = '<td>' + arr[i].join('</td><td>') + '</td>';
        }
        tbody.innerHTML = '<tr>' + arr.join('</tr><tr>') + '</tr>';
    }
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