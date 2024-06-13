<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
</head>
<body>
    @while ($i <10)
        num : {{ $i }}
        @php
            $i++;
        @endphp
        {{-- {{ $i++ }} --}}
    @endwhile
    @if ($hobbies >= 1)
        @for ($i =0; $i<= 10; $i++)
            <p>{{ $i }}</p>
        @endfor
        <ul>
        @foreach ($hobbies as $hobby)
            <li>{{ $hobby }}</li>
        @endforeach
        @forelse ($name as $n)
            {{ $n }}    
        @empty
            <br><p>No data available</p>
        @endforelse
        </ul>
    @endif
</body>
</html>