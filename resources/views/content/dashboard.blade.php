<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('仪表板') }}
        </h2>
    </x-slot>
    @foreach ($issues as $issue)
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __($issue->title) }}
                </h2>
                <div class="p-4 text-gray-900 dark:text-gray-100">
                    {{ __($issue->content) }}
                </div>
            </div>
        </div>
    </div>
    @endforeach
</x-app-layout>
