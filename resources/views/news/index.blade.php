<x-app-layout class="select-none">
    <x-slot name="header">
        <h2 class=" select-none font-semibold text-xl text-gray-800 leading-tight">
            {{ __('News') }}
        </h2>
    </x-slot>

    <div class="bg-white rounded w-3/4 shadow mt-5 p-4 mx-auto flex-grow text-justify">
        <div>
            <table class="mx-auto">
                @foreach ($news as $item)
                    <tr>
                        <td class="flex">
                            <img class="h-8 w-8 rounded-full object-cover m-2" src="{{ $item->user->profile_photo_url }}"
                                alt="{{ $item->user->name }}">
                            <span class="text-orange-500 mt-2">{{ $item->user->name }}</span>
                        </td>
                        <td>
                            @if (auth()->check() && auth()->user()->id !== $item->user->id)
                                @if (auth()->user()->isFollowing($item->user->id))
                                    <form method="post" action="{{ route('unfollow', $item->user->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded shadow-md py-2 px-4" type="submit">Unfollow</button>
                                    </form>
                                @else
                                    <form method="post" action="{{ route('storefollow') }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->user->id }}">
                                        <button class="rounded bg-slate-700 text-white py-2 px-6" type="submit">Follow</button>
                                    </form>
                                @endif
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="font-semibold">{{ $item->title }}</td>
                    </tr>
                    <tr>
                        <td>{{ $item->image }}</td>
                    </tr>
                    <tr>
                        <td class="ml-6 max-w-3xl">{{ $item->description }}</td>
                    </tr>
                    <tr>
                        <td class="flex items-center">
                            <div class="w-6">
                                <a href="{{ route('comment', ['news_id' => $item->id]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" class="w-6 h-6 stroke-orange-400">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                                    </svg>
                                </a>
                            </div>
                            <div class="ml-2 text-slate-400">{{ $item->created_at }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><br>
                            <hr>
                        </td> <!-- Add a horizontal line as a gap -->
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</x-app-layout>
