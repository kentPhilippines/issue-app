<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('添加评论') }}
        </h2>

        {{-- <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('一旦您的帐户被删除，其所有资源和数据将被永久删除。在删除您的帐户之前，请下载您希望保留的任何数据或信息。') }}
        </p> --}}
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'add-comment')"
    >{{ __('添加评论') }}</x-danger-button>

    {{-- 点击删除按钮之后的弹出事件 --}}
    <x-modal name="add-comment" :show="$errors->userDeletion->isNotEmpty()" focusable>
        {{-- <form method="post" action="{{ route('comment.store') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('您确定要添加这个评论吗？') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('
                一旦您的评论添加之后不可以做出修改，并且我们后台的审核人员将会对您的评论做出审核，如果存在不实情况将会视情况追究您的法律责任。') }}
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
                    {{ __('取消') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('确认评论') }}
                </x-danger-button>
            </div>
        </form> --}}




        <form method="post" action="{{ route('comment.store') }}" class="mt-6 space-y-6">
            @csrf
            @method('put')
            <div>
                <x-input-label for="issue_title" :value="__('回复标题')" />
                <x-text-input id="issue_title" name="title" type="input" class="mt-1 block w-full"  />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="issue_content" :value="__('回复内容')" />
                <x-text-input id="issue_content" name="content" type="text" class="mt-1 block w-full"   />
                <x-input-error :messages="$errors->get('content')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="issue_tags" :value="__('标签')" />
                <x-text-input id="issue_tags" name="tags" type="text" placeholder="#狗狗#宠物"  class="mt-1 block w-full"   />
            </div>
            <div>
                <x-input-label for="issue_invites" :value="__('圈人')" />
                <x-text-input id="issue_invites" name="invites" type="text" placeholder="@张三@李四"  class="mt-1 block w-full"   />
            </div>
            <div style="hidden">
                <x-text-input  name="userId" type="hidden"  value="{{__(auth()->user()->id)}}"   class="mt-1 block w-full"   />
                <x-text-input  name="issueId" type="hidden"  value="   {{ __($issue->id) }}"   class="mt-1 block w-full"   />




                    
            </div>
            {{-- <div class="flex items-center gap-4">
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
            </div> --}}
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('取消') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('确认评论') }}
                </x-danger-button>
            </div>



        </form>







































    </x-modal>
</section>
