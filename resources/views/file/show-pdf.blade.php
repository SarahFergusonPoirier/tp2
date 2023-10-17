<!DOCTYPE html>
<html lang="{{ $file->lang }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>{{ $file->name }}</h1>
    <h2>@lang('lang.by') {{ $nomUser }}</h2>
    <p>@lang('lang.created_at') {{ $file->created_at }} | @lang('lang.updated_at') {{ $file->updated_at }}</p>
</body>
</html>