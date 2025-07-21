@props([
    'size' => 'md',
    'fixed' => true,
    'bottom' => true,
])

<div {{ $attributes->class([
    'dock',
    'dock-xs' => $size === 'xs',
    'dock-sm' => $size === 'sm', 
    'dock-md' => $size === 'md',
    'dock-lg' => $size === 'lg',
    'dock-xl' => $size === 'xl',
    'fixed' => $fixed,
    'bottom-0' => $fixed && $bottom,
    'top-0' => $fixed && !$bottom,
    'z-50' => $fixed
]) }}>
    {{ $slot }}
</div>
