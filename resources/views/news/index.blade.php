<x-app-layout>
    <x-slot name="header">
        <h2 class="select-none font-semibold text-xl text-gray-800 leading-tight">
            {{ __('News') }}
        </h2>
    </x-slot>

    <div class="flex-col items-center mx-auto w-3/4 m-5">
        <div class="bg-white p-5">
            <table class="mx-auto">
                @foreach ($news as $item)
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ $item->user->profile_photo_url }}"
                                alt="{{ $item->user->name }}">
                        </div>
                        <div class="ml-2">
                            <span class="text-orange-500">{{ $item->user->name }}</span>
                            <p class="font-semibold">{{ $item->title }}</p>
                            <p class="text-gray-500 max-w-3xl">{{ $item->description }}</p>
                            <div class="flex items-center mt-2">
                                @if (auth()->check() && auth()->user()->id !== $item->user->id)
                                    @if (auth()->user()->isFollowing($item->user->id))
                                        <form method="post" action="{{ route('unfollow', $item->user->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-500" type="submit">Unfollow</button>
                                        </form>
                                    @else
                                        <form method="post" action="{{ route('storefollow') }}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->user->id }}">
                                            <button class="bg-slate-700 text-white py-1 px-3 rounded"
                                                type="submit">Follow</button>
                                        </form>
                                    @endif
                                @endif
                                <div class="ml-4">
                                    @if (auth()->user()->isLike($item->id))
                                        <form method="post" action="{{ route('unlike', $item->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="red"
                                                    viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 transition">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <form method="post" action="{{ route('like') }}">
                                            @csrf
                                            <input type="hidden" name="like_id" value="{{ $item->user->id }}">
                                            <input type="hidden" name="news_id" value="{{ $item->id }}">
                                            <button type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="red"
                                                    class="w-6 h-6 transition">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                                <div class="ml-4 mb-1">
                                    <a href="{{ route('comment', ['news_id' => $item->id]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" class="w-6 h-6 stroke-blue-500">
                                            <!-- Customize color here -->
                                            <a href="{{ route('comment', ['news_id' => $item->id]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    class="w-6 h-6 stroke-blue-500"> <!-- Customize color here -->
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3 2a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V6a2 2 0 00-2-2h-5.414l-2.293-2.293A1 1 0 007 2H3zm9 0v7m0 0l3-3m-3 3l-3-3"></path>
                                            
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                @endforeach
            </table>
        </div>
    </div>
</x-app-layout>
