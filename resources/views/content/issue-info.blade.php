<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('查看issue') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                   
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __(' ' . $issue->title) }}
                    </h2>
            
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __(' ' . $issue->content) }}
                    </p> 
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        
                        @foreach ($tags as $tag)
                          {{ __('#'. $tag->tag_name) }}
                        @endforeach
                    </p> 


                </div>
                {{-- 文章标题  和 内容--}}
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                  {{-- @include('profile.partials.update-password-form') --}}
                @foreach ($comments as $comment)
                    
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('用户@' . $comment->announcer) }} {{ __('# ' . $comment->title) }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __( $comment->content) }}
                    </p> 
                @endforeach
                </div>
                {{-- 文章评论 --}}
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('content.issues.comments-issue')
                </div>
                {{-- 添加评论按钮 --}}
            </div>
        </div>
    </div>
</x-app-layout>































{{-- 




<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __(' #' . $issue->title) }}
        </h2>
        <!-- 内容表述 -->
    
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        {{ __(' #' . $issue->content) }}
    </p>


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
</div>
</div>
</div>
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
</x-app-layout>
 <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('您确定要删除您的帐户吗？') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('
            一旦您的帐户被删除，其所有资源和数据将被永久删除。请输入您的密码以确认您想要永久删除您的帐户。') }}
        </p>

        <div class="mt-6">
            <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

            <x-text-input
                id="password"
                name="password"
                type="password"
                class="mt-1 block w-3/4"
                placeholder="{{ __('Password') }}"
            />

            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3">
                {{ __('Delete Account') }}
            </x-danger-button>
        </div>
    </form>
</x-modal>
  --}}