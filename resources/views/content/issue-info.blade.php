<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __($issue->title) }}
        </h2>
        <!-- 内容表述 -->

        <!-- 这里加一个评论的按钮 -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('评论') }}</x-primary-button>
            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('评论') }}</p>
            @endif
        </div>
    </x-slot>
    @foreach ($comments as $comment)
    <!-- 这里是评论内容 -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-12 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    {{ __($comment->content) }}
                </div>
            </div>
        </div>
    </div>
    @endforeach
</x-app-layout>
 