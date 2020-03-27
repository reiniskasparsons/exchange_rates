<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="css/app.css">
    <!-- Styles -->
    <style>
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

    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="container">
        <table class="table table-sm table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Currency</th>
                <th scope="col">Rate</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($rates as $rate)
                <tr>
                    <th scope="row">{{$rate->id}}</th>
                    <td>{{$rate->currency}}</td>
                    <td>{{$rate->rate}}</td>
                    <td>{{$rate->date}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{$rates->links("pagination::bootstrap-4")}}
    </div>
</div>
</body>
</html>
