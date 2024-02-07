<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $status }} - {{ $message }}</title>
</head>

<body>
    <h1>{{ $status }}</h1>
    <p>{{ $message }}</p>
    @if (isProd() === false)
        <code>{{ json_encode($details) }}</code>
    @endif
</body>

</html>
