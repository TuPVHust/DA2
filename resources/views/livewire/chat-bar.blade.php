<div>
    <a class="nav-link" href="{{ route('chatify') }}">
        <i class="far fa-comments"></i>
        @if (\App\Models\ChMessage::where('seen', 0)->where('to_id', Auth::user()->id)->count() > 0)
            <span
                class="badge badge-danger navbar-badge">{{ \App\Models\ChMessage::where('seen', 0)->where('to_id', Auth::user()->id)->count() }}</span>
        @endif
    </a>
</div>
