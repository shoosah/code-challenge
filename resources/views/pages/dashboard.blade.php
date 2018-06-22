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
        {!! Form::open() !!}
        <div class="form-group">
            {!! Form::text('pageName', null, [
                'class' => 'form-control',
                'placeholder' => 'Page Name',
            ]) !!}
            {!! Form::text('productName', null, [
                'class' => 'form-control',
                'placeholder' => 'Product Name',
            ]) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Search', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        {!! Form::close() !!}
    </div>
    @if ($result)
        <div>
            <table class="table table-responsive table-striped">
                <caption>
                    Information for page {{$result['pageName']}}
                    <br/>
                    From {{$result['startDate']}}
                    until {{$result['endDate']}}
                    <br/>
                    Product Name: {{$result['productName']}}
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
                        <td>{{$result['numberOfUsersView']}}</td>
                        <td>{{$result['numberOfLoggedInUsersView']}}</td>
                        <td>{{$result['revenue']}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endif
</body>
</html>
