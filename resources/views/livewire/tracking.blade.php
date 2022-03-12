<div>
    <h4>Tài xế đang hoạt động</h4>
    <hr>
    @if (sizeof($positionsArray) > 0)
        @foreach ($positionsArray as $key1 => $items)
            {{-- <pre>{!! $positionsArray !!}</pre> --}}
            <div class="user-block mt-2">
                <img class="img-circle img-bordered-sm"
                    src="{{ asset('/storage/' . config('chatify.user_avatar.folder') . '/' . $items['userAvatar']) }}"
                    alt="Avatar">
                <span class="username">
                    <a href="javascript:void(0)"
                        onclick="flyToLatLng({{ $items['lat'] }}, {{ $items['lng'] }})">{{ $key1 }}.</a>
                    {{-- <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a> --}}
                </span>
                <span class="description">
                    @if ($items['speed'])
                        {{ $items['speed'] }} km/h
                    @else
                        0 km/h
                    @endif
                    - {{ Carbon\Carbon::parse($items['timeStamp'])->format('h:m') }} PM
                </span>
            </div>
            <br>
        @endforeach
    @else
        <div class="d-flex align-items-center">
            <strong>Loading...</strong>
            <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
        </div>
    @endif
</div>
