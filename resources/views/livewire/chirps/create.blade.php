<?php

use function Livewire\Volt\{state, rules};

state(['message' => '']);

rules([
    'message' => 'required|string|max:255'
]);

$store = function () {
    $validated = $this->validate();

    auth()->user()->chirps()->create($validated);

    $this->message = '';

    $this->dispatch('chirp-created');
}

?>

<div>
    <form wire:submit="store">
        <textarea
            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            wire:model="message" placeholder="{{ __('What\'s on your mind?') }}"></textarea>

        <x-input-error class="mt-2" :messages="$errors->get('message')" />
        <x-primary-button class="mt-4">{{ __('Chirp') }}</x-primary-button>
    </form>
</div>
