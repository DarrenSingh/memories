
<?php

use App\Models\LovedOne;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Mary\Traits\Toast;

new class extends Component {
    
    use WithFileUploads, Toast;

    #[Rule('required|max:1')]
    public $photoUpload;
    public $photo;
    public $user_id;
    
    public $first_name;
    public $middle_name;
    public $last_name;

    public $date_of_birth;
    public $description;
    public $url;

    public function create() {

        $this->validate([
            'photoUpload' => 'image|max:1024',
            'first_name' => 'required',
            'last_name' => 'required',
            'url' => ['required', 'alpha_dash', function ($attribute, $value, $fail) {
            if (!preg_match('/^[a-zA-Z0-9_-]+$/', $value)) {
                $fail('The URL may only contain letters, numbers, dashes, and underscores.');
            }
            }],
        ]);
    
        $this->user_id = Auth::user()->id;

        $extension = $this->photoUpload->getClientOriginalExtension();
        $fileName = 'user_' . Auth::user()->id . '_' . Str::slug($this->first_name . '_' . $this->last_name, '_') . '.' . $extension;

        try {
            $this->photoUpload->storePubliclyAs(path: 'profilePhotos', name: $fileName);
            $this->photo = 'profilePhotos/' . $fileName;

        } catch (\Throwable $th) {
            $this->warning('Error uploading photo, please try again.');
            return;
        }

        try {
            // create LovedOne
            $lovedOne = new LovedOne($this->except('photoUpload'));
            $lovedOne->save();
        } catch (\Illuminate\Database\QueryException $qe) {
            $this->warning('Database error occurred while creating the memory page. Please try again.');
        } catch (\Throwable $th) {
            $this->warning('An unexpected error occurred. Please try again.');
        }
        
        $this->success('Successfully created memory page for '. $this->first_name . ' ' . $this->last_name, redirectTo: '/dashboard');
        
    }

}; ?>

<div>
<x-header title="Setup a Memories Page for a Loved One"  separator />


    <x-form wire:submit='create'>

        {{-- profile photo --}}
        <h3 class="text-center lg:text-left">Let's start by adding a photo of your loved one!</h3>
            <x-file  wire:model="photoUpload" accept="image/png" 
            change-text="Upload Photo"
            crop-text="Crop"
            crop-title-text="Crop image"
            crop-cancel-text="Cancel"
            crop-save-text="Crop"
            crop-after-change
            class="flex justify-center lg:justify-start">
            <img src="{{ $user->avatar ?? '/images/upload.png' }}" class="h-40 rounded-lg center" />
        </x-file>

        {{-- name  --}}
        <x-input label="First Name" wire:model="first_name" placeholder="Enter first name" />
        <x-input label="Middle Name (optional)" wire:model="middle_name" placeholder="Enter middle name" />
        <x-input label="Last Name" wire:model="last_name" placeholder="Enter last name" />
        
        {{-- date of birth --}}
        <x-datetime label="Date of Birth" wire:model="date_of_birth" />
        
        {{-- description --}}
        <x-textarea label="Description" wire:model="description" placeholder="Share a few words that capture their essence" hint="Max 2000 chars" rows="8" />

        {{-- url --}}
        <x-input label="Desired URL" wire:model="url" prefix="memories.test/"/>
        
        <x-button label="Create Memory Page" type="create" class="btn-primary" spinner="create" />
    </x-form>
</div>
