<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('issue标题') }}
        </h2>
        <!-- 内容表述 -->

        <!-- 这里加一个评论的按钮 -->
    </x-slot>







    <!-- 这里是评论内容 -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-12 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('content.comments-issue')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
 