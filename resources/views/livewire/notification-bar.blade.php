<div>
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        @if ($unreadNotifications->count() > 0)
            <span class="badge badge-warning navbar-badge">
                {{ $unreadNotifications->count() }}
            </span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="max-height: 50vh; overflow: auto">
        @foreach ($unreadNotifications as $unreadNotification)
            @php
                $notifiedUser = \App\Models\User::find($unreadNotification->data['userId']);
            @endphp
            @if ($notifiedUser)
                <a wire:click="markAsRead({{ $unreadNotification }})"
                    href="{{ $unreadNotification->data['linkTo'] }}" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{ asset('/storage/' . config('chatify.user_avatar.folder') . '/' . $notifiedUser->avatar) }}"
                            alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title font-weight-bold">
                                {{ $unreadNotification->data['name'] }}
                                <span class="float-right text-sm text-danger">
                                    @if ($unreadNotification->type == 'App\Notifications\NewUserNotification')
                                        <i class="fas fa-user-cog"></i>
                                    @elseif($unreadNotification->type == 'App\Notifications\completeSchedule')
                                        <i class="fas fa-users"></i>
                                    @elseif($unreadNotification->type == 'App\Notifications\createSchedule')
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="fas fa-bug"></i>
                                    @endif
                                </span>
                            </h3>
                            @if ($unreadNotification->type == 'App\Notifications\NewUserNotification')
                                <p class="text-sm">V???a ????ng k?? t??i kho???n v???i email
                                    <span class="font-weight-bold">{{ $unreadNotification->data['email'] }}</span>
                                </p>
                            @elseif ($unreadNotification->type == 'App\Notifications\completeSchedule')
                                <p class="text-sm">V???a ho??n th??nh c??ng vi???c giao ng??y
                                    <span
                                        class="font-weight-bold">{{ Carbon\Carbon::parse($unreadNotification->data['schedule']['date'])->format('d-m-Y') }}</span>
                                </p>
                            @elseif ($unreadNotification->type == 'App\Notifications\createSchedule')
                                <p class="text-sm">B???n v???a ???????c
                                    <span class="font-weight-bold">
                                        {{ $unreadNotification->data['name'] }} </span> giao m???t
                                    c??ng vi???c v??o
                                    ng??y
                                    <span
                                        class="font-weight-bold">{{ Carbon\Carbon::parse($unreadNotification->data['schedule']['date'])->format('d-m-Y') }}</span>
                                </p>
                            @else
                                <p class="text-sm"> ???? c?? l???i s???y ra</p>
                            @endif
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>
                                {{ \Carbon\Carbon::createFromTimestamp(strtotime($unreadNotification->created_at))->diffForHumans(\Carbon\Carbon::now()) }}
                            </p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
            @endif
            <div class="dropdown-divider"></div>
        @endforeach
        @if ($unreadNotifications->count() > 0)
            <a href="#" class="dropdown-item dropdown-footer" wire:click="markAllAsRead()">Mark all
                as read</a>
        @endif
        <a href="#" class="dropdown-item dropdown-footer" data-toggle="modal" data-target="#notificationModal">See all
            notification</a>
    </div>
</div>
