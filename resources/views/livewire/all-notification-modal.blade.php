<div class="container" style="max-height: 500px; overflow: auto">
    <table class="table table-bordered table-hover table-sm">
        <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Ngày</th>
                <th>Loại</th>
                <th>Từ</th>
                <th>Trạng thái</th>
                <th class="text-right">Tùy chọn</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($notifications as $unreadNotification)
                <tr>
                    <th class="text-muted">{{ $i }}. </th>
                    <th class="text-muted">
                        {{ Carbon\Carbon::parse($unreadNotification->created_at)->format('m:h') }} <span
                            class="text-muted"> &bull;</span>
                        {{ Carbon\Carbon::parse($unreadNotification->created_at)->format('d-m-Y') }}
                    </th>
                    <th class="text-muted">{{ $unreadNotification->data['type'] }}</th>
                    <th class="text-muted">{{ $unreadNotification->data['name'] }}</th>
                    <td class="text-muted">
                        @if (!$unreadNotification->read_at)
                            <span class="badge badge-warning">Chưa đọc</span>
                        @else
                            <span class="badge badge-success">Đã đọc</span>
                        @endif
                    </td>
                    <td class="text-right">
                        <a class="btn btn-tool" wire:click="removeNotifi({{ $unreadNotification }})">
                            <i class="fas fa-trash ">
                            </i>
                        </a>
                    </td>
                </tr>
                @php
                    $i += 1;
                @endphp
            @endforeach

        </tbody>
    </table>
</div>
