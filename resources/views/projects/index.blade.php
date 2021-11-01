<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h1>BirdBoard</h1>

    <ul>
        @forelse($projects as $project)
            <li>{{ $project->title }}</li>
            <li>{{ $project->description }}</li>
        @empty
            <p>No data</p>
        @endforelse
    </ul>
</body>
</html>
