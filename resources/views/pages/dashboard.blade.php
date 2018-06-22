<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <div>
        <table class="table table-responsive table-striped">
            <caption>
                Information for page {{$pageName}} over the last {{$period}}
                Product Name: {{$productName}}
            </caption>
            <thead>
                <tr>
                    <th>Number of page views</th>
                    <th>Logged in users</th>
                    <th>Revenue</th>
                </tr>
            </thead>
            <tbody id="usersTableBody">
                <tr>
                    <td>{{$numberOfUsersView}}</td>
                    <td>{{$numberOfLoggedInUsersView}}</td>
                    <td>{{$revenue}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
