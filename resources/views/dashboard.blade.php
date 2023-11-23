<x-app-layout>
    <x-slot name="header">
        <h2 class="select-none font-semibold text-xl text-gray-800 leading-tight pt-16">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="flex-col items-center mx-auto w-3/4 m-5">
        <form action="{{ route('storenews') }}" method="POST">
            @csrf

            <div class="mb-4 w-full">
                <label for="news" class="block font-bold mb-2">News</label>
                <input class="border border-gray-300 p-2 w-full" name="title" type="text" placeholder="Title">
            </div>

            <div class="mb-4 w-full">
                <textarea name="description" cols="30" rows="10" class="border border-gray-300 p-2 w-full"
                    placeholder="What's on your mind?"></textarea>
            </div>

            <x-secondary-button class="my-5 border border-grey-300 mr-2">{{ __('Upload Photo') }}</x-secondary-button>

            <div class="text-center">
                <button type="submit"
                    class="bg-orange-500 shadow-md hover:bg-yellow-400 text-white font-bold py-2 px-4 rounded mb-5">Post</button>
            </div>
        </form>
    </div>
</x-app-layout>
