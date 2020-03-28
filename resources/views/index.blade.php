<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Exchange rates</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="container">
        @if($errors->any())
            <div class="alert alert-danger w-50 margin-auto" role="alert">
                {{$errors->first()}}
            </div>
        @endif
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
            @if(!empty($rates))
                @foreach ($rates as $rate)
                    <tr class="cursor-pointer" onclick="window.location='/single/{{$rate->id}}';">
                        <th scope="row">{{$rate->id}}</th>
                        <td>{{$rate->currency}}</td>
                        <td>{{$rate->rate}}</td>
                        <td>{{$rate->date}}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        {{$rates->links("pagination::bootstrap-4")}}
    </div>
</div>
</body>
</html>
