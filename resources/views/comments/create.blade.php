<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ml-4">

                    <div>
                        <div class="px-4 sm:px-0">
                            <h3 class="text-base font-semibold leading-7 text-gray-900">Feedback Information</h3>
                            <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">feedback details and comments.</p>
                        </div>
                        <div class="mt-6">
                            <dl class="grid grid-cols-1 sm:grid-cols-2">
                                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Title</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ $feedback->title }}</dd>
                                </div>
                                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Category</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ $feedback->category }}</dd>
                                </div>
                                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Submitted By</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{  $feedback->user->name  }}</dd>
                                </div>
                                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Description</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ $feedback->description }}</dd>
                                </div>

                                <div  id="comments" class="border-t border-gray-100 px-4 py-6 sm:col-span-2 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Comments</dt>
                                    <dd class="mt-2 text-sm text-gray-900">
                                        <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200">
                                            @forelse($comments as $comment)
                                                <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                                                    <div class="flex w-0 flex-1 items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                                                        </svg>

                                                        <div class="ml-4 flex min-w-0 flex-1 gap-2">
                                                            <span class="truncate font-medium">{!! $comment->content !!}</span>
                                                            <span class="flex-shrink-0 text-gray-400">{{ Carbon\Carbon::parse($feedback->created_at)->diffForHumans() }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="ml-4 flex-shrink-0">
                                                        <p class="font-medium text-indigo-600 hover:text-indigo-500">{{ $comment?->user->name }}</p>
                                                    </div>
                                                </li>
                                            @empty
                                                <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                                                    <div class="flex w-0 flex-1 items-center"> No Comments found  </div></li>
                                            @endforelse
                                        </ul>
                                    </dd>
                                       <div class="mt-4">
                                           <!-- Pagination links -->
                                           {{ $comments->links() }}
                                       </div>

                                </div>
                            </dl>
                        </div>
                    </div>


                    <form method="post" action="{{ route('comment.store', $feedback->id) }}">
                        @csrf
                        <div class="space-y-12">
                            <div class="border-b border-gray-900/10 pb-12">
                                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="col-span-full">
                                        <label for="content" class="block text-sm font-medium leading-6 text-gray-900">Please comment out your feedback</label>
                                        <div class="mt-2">
                                            <input id="content" type="hidden" name="content" value="{{ old('content') }}">
                                            <trix-editor input="content" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></trix-editor>
                                            {{--                                                                <textarea id="content" name="content" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ old('content') }}</textarea>--}}
                                        </div>
                                        @error('content')
                                        <div class="text-red-600 text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <a href="{{route('feedback.index')}}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
                            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                        </div>
                    </form>

                    <div class="text-gray-900">

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
