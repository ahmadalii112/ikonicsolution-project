<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Feedback') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" action="{{ route('feedback.store') }}">
                        @csrf
                        <div class="space-y-12">
                            <div class="border-b border-gray-900/10 pb-12">
                                <h2 class="text-base font-semibold leading-7 text-gray-900">Feedback</h2>
                                <p class="mt-1 text-sm leading-6 text-gray-600">This information will be displayed publicly so be careful what you share.</p>
                                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                                        <div class="mt-2">
                                            <input type="text" name="title" id="title" value="{{ old('title') }}" autocomplete="title" class=" @error('title') ring-red-600 @enderror block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                        @error('title')
                                        <div class="text-red-600 text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
                                        <div class="mt-2">
                                            <input type="text" name="category" id="category" value="{{ old('title') }}" autocomplete="family-name" class="@error('title') ring-red-600 @enderror block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                        @error('category')
                                        <div class="text-red-600 text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-span-full">
                                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                                        <div class="mt-2">
                                            <textarea id="description" name="description" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"> {{ old('description') }} </textarea>
                                        </div>
                                        @error('description')
                                        <div class="text-red-600 text-sm">{{ $message }}</div>
                                        @enderror
                                        <p class="mt-3 text-sm leading-6 text-gray-600">Write your feedback in details.</p>
                                    </div>


                                </div>
                            </div>

                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <a href="{{route('feedback.index')}}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
                            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
