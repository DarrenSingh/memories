<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\LovedOne;


new 
#[Layout('components.layouts.guest')]
class extends Component {
    public LovedOne $lovedOne;

    public function mount(LovedOne $lovedOne)
    {
        $this->lovedOne = $lovedOne;
    }
}; ?>

<div class="pt-16">
    {{-- Top Nav --}}
    <x-dock class="justify-between" :fixed=true :bottom=false>
        <x-dock-item class="items-start pt-2 ps-6" tooltip="Back" icon="o-arrow-left" />
        <x-dock-item class="items-end pt-2 pe-6" tooltip="Share" icon="o-share" />
    </x-dock>

    <!-- Main content -->
    <div class="px-4 py-6 space-y-12">
        <!-- Image and title row -->
        <div class="flex flex-col items-center text-center space-y-3">
            <img src="{{ $lovedOne->photo_url }}" alt="{{ $lovedOne->full_name }}" class="w-64 h-64 rounded-box object-contain">
            <h4 class="text-2xl font-bold text-gray-900 dark:text-gray-200">{{ $lovedOne->full_name }}</h4>
        </div>

        <!-- Description text -->
        <div>
            <h4 class="text-gray-700 dark:text-gray-200 text-left font-bold mb-3">About {{ $lovedOne->first_name }}</h3>
            <p class="text-gray-600 dark:text-gray-100 leading-relaxed">
                {{ $lovedOne->description }}
            </p>
        </div>

        <!-- Cards loop -->
        <div class="space-y-12 mt-8">
            <h4 class="text-gray-700 dark:text-gray-200 text-left font-bold mb-3">Memories</h3>
            @for($i = 1; $i <= 5; $i++)
            <x-mary-card class="transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-lg cursor-pointer shadow-md">
                <a href="{{ route('home') }}">
                    <x-slot:figure>
                        <img src="https://picsum.photos/500/400" />
                    </x-slot:figure>
                    <p class="text-sm text-gray-600 dark:text-gray-100">
                        This is a beautiful memory from their life. Each moment was precious and filled with joy, laughter, and love.
                    </p>
                </a>
            </x-mary-card>
            @endfor
        </div>
    </div>

    <!-- Bottom Nav -->
    <x-dock>
        <x-dock-item tooltip="View Recent" icon="o-magnifying-glass" />
        <x-dock-item tooltip="Home" href="{{ '/' . $lovedOne->url }}" icon="o-home" />
        <x-dock-item tooltip="Add" icon="o-plus" />
    </x-dock>
</div>