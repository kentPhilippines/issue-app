<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('发布issue') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("提出您的疑问，在这里！！！") }}
        </p>
    </header>
    <form method="post" action="{{ route('issues.store') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')
        <div>
            <x-input-label for="issue_title" :value="__('文章标题')" />
            <x-text-input id="issue_title" name="title" type="input" class="mt-1 block w-full"  />
        </div>
        <div>
            <x-input-label for="issue_content" :value="__('内容')" />
            <x-text-input id="issue_content" name="content" type="text" class="mt-1 block w-full"   />
        </div>
        <div>
            <x-input-label for="issue_tags" :value="__('标签')" />
            <x-text-input id="issue_tags" name="tags" type="text" placeholder="#狗狗#宠物"  class="mt-1 block w-full"   />
        </div>
        <div>
            <x-input-label for="issue_invites" :value="__('邀请人回答')" />
            <x-text-input id="issue_invites" name="invites" type="text" placeholder="@张三@李四"  class="mt-1 block w-full"   />
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('保存') }}</x-primary-button>
            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('保存') }}</p>
            @endif
        </div>
    </form>
</section>
