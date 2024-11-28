<?php

use function Livewire\Volt\{state, rules, mount};

state(['chirp', 'message']);

rules([
    'message' => 'required|string|max:255',
]);

mount(fn() => ($this->message = $this->chirp->message));

$update = function () {
    $this->authorize('update', $this->chirp);

    $validated = $this->validate();

    $this->chirp->update($validated);

    $this->dispatch('chirp-updated');
};

$cancel = fn() => $this->dispatch('chirp-edit-canceled');
?>

<div>
    <form wire:submit="update">
        <textarea
            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            wire:model="message"></textarea>

        <x-input-error class="mt-2" :messages="$errors->get('message')" />
        <x-primary-button class="mt-4">{{ __('Save') }}</x-primary-button>
        <button class="mt-4" wire:click.prevent="cancel">Cancel</button>
    </form>
</div>
