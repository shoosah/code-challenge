@extends('layouts.master')
@section('content')
    <div>
        <table class="table table-responsive table-striped" id="usersTable">
            <thead>
            <tr>
                {{--Allow sort by first name--}}
                <th class="sortable" onclick="sortTable(users, 0, asc1); asc1 *= -1; asc2 = 1; asc3 = 1;">
                    First Name
                </th>
                {{--Allow sort by last name--}}
                <th class="sortable" onclick="sortTable(users, 1, asc1); asc1 *= -1; asc2 = 1; asc3 = 1;">
                    Last Name
                </th>
                <th>Email</th>
                <th>Website address</th>
            </tr>
            </thead>
            <tbody id="usersTableBody">
            @foreach($users as $user)
                {{--Split first and last name--}}
                <?php
                $lastName = (strpos($user->name, ' ') === false) ?
                        '' :
                        preg_replace('#.*\s([\w-]*)$#', '$1', $user->name)
                ?>
                <tr>
                    {{--First Name--}}
                    <td>{{ trim(preg_replace('#' . $lastName . '#', '', $user->name)) }}</td>
                    {{--Last Name--}}
                    <td>
                        {{$lastName}}
                    </td>
                    {{--Email address--}}
                    <td>
                        <a href="mailto:{{ $user->email }}" >{{ $user->email }}</a>
                    </td>
                    {{--Website address--}}
                    <td>
                        <a href="http://{{ $user->website }}">{{ $user->website }}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif
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
        users = document.getElementById("usersTableBody");
    };

    function sortTable(tbody, col, asc) {
        var rows = tbody.rows, rlen = rows.length, arr = new Array(), i, j, cells, clen;
        // fill the array with values from the table
        for (i = 0; i < rlen; i++) {
            cells = rows[i].cells;
            clen = cells.length;
            arr[i] = new Array();
            for (j = 0; j < clen; j++) {
                arr[i][j] = cells[j].innerHTML;
            }
        }
        // sort the array by the specified column number (col) and order (asc)
        arr.sort(function (a, b) {
            return (a[col] == b[col]) ? 0 : ((a[col] > b[col]) ? asc : -1 * asc);
        });
        for (i = 0; i < rlen; i++) {
            arr[i] = "<td>" + arr[i].join("</td><td>") + "</td>";
        }
        tbody.innerHTML = "<tr>" + arr.join("</tr><tr>") + "</tr>";
    }
@endsection