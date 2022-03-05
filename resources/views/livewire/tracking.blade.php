<div>
    @foreach ($positionsArray as $key1 => $items)
        <p>{{ $key1 }}: </p>
        @foreach ($items as $key2 => $item)
            @if ($key2 === 'timeStamp')
                {{-- <span>{{ $key2 }}:
                    {{ Carbon\Carbon::parse($item)->format('d-m-Y') }}</span> --}}
                <span>{{ $key2 }}: {{ $item }}</span><span>&#9474;</span>
            @else
                <span>{{ $key2 }}: {{ $item }}</span><span>&#9474;</span>
            @endif
        @endforeach
    @endforeach

</div>
