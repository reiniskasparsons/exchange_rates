<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="container">
        @if(!empty($relatedRates))
            @foreach($relatedRates as $rate)
                @if($loop->first)
                    <h1>{{$rate['currency']}}</h1>
                @endif
                <div class="hidden">
                    <div class="js-dates">{{$rate['date']}}</div>
                    <div class="js-rates">{{$rate['rate']}}</div>
                </div>
            @endforeach
        @endif
        <div class="row">
            <canvas id="chLine"></canvas>
        </div>
        <a href="/" class="btn btn-success float-right">Back to list</a>
    </div>
</div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
</html>

