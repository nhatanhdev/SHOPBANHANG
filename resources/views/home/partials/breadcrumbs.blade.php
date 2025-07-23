{{-- resources/views/partials/breadcrumbs.blade.php --}}
@php
$breadcrumbs = Get_breadcrumb();
@endphp

<div class="banner-text">
    @if(isset($breadcrumbs) && $breadcrumbs->count())
    <h2>{{ $breadcrumbs->last()->title }}</h2>
        <ol class="breadcrumb">
            @foreach ($breadcrumbs as $breadcrumb)
                @if (!is_null($breadcrumb->url) && !$loop->last)
                    <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                @else
                    <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
                @endif
            @endforeach
        </ol>
    @endif
</div>
