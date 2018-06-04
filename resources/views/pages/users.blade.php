@extends('layouts.master')
@section('content')
    <div>
        <table class="table table-responsive table-striped">
            <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Website address</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <?php
                $lastName = (strpos($user->name, ' ') === false) ?
                        '' :
                        preg_replace('#.*\s([\w-]*)$#', '$1', $user->name)
                ?>
                <tr>
                    <td>{{ trim(preg_replace('#' . $lastName . '#', '', $user->name)) }}</td>
                    <td>
                        {{$lastName}}
                    </td>
                    <td>
                        <a href="mailto:{{ $user->email }}" >{{ $user->email }}</a>
                    </td>
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