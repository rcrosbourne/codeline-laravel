<x-guest-layout>
    <x-jet-authentication-card>

        <x-slot name="logo">
            <h2>How many weekends are between the dates?</h2>
        </x-slot>
        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('weekend-tracker.store') }}">
            @csrf

            <div>
                <x-jet-label for="start_date" value="{{ __('Start Date') }}" />
                <x-jet-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="old('start_date')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="end_date" value="{{ __('End Date') }}" />
                <x-jet-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" required />
            </div>


            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                    {{ __('Calculate Weekends') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
