@props([
    'active' => null,
    'label' => null,
    'href' => null,
    'icon' => null,
])

@php
    $isActive = $active ?? ($href ? request()->url() === url($href) || request()->routeIs($href) : false);
@endphp

<button {{ $attributes->class([
    'dock-item',
    'dock-active' => $isActive,
]) }} @if($href) onclick="window.location.href='{{ $href }}'" @endif>

    @if($icon)
        <x-icon name="{{ $icon }}" class="w-6 h-6" />
    @endif
    
    {{ $slot }}
    
    @if($label)
        <span class="dock-label text-xs">{{ $label }}</span>
    @endif

</button>
