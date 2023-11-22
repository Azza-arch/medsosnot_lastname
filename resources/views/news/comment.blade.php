<x-app-layout class="select-none">
    <div class="bg-white mx-auto w-2/3 p-3 m-10">

        <div class="mb-4 mx-auto text-justify">
            <h1 class="font-semibold mb-3 select-none">{{ $news->title }}</h1>
            <p class="select-none">{{ $news->description }}</p>
            <br>
            <form action="{{ route('storecomment') }}" method="POST">
                @csrf
                <input type="hidden" name="news_id" value="{{ $news->id }}">
                <input class="border-hidden shadow-md p-2 w-1/3" name="comment" type="text" placeholder="Comment">
                <button type="submit">Post</button>
            </form>
        </div>

        <div class="mx-auto w-2/3"> <!-- Adjust the width as needed -->
            <table class="w-full">
                @foreach ($comments as $comment)
                    <tr>
                        <td class="p-3">
                            <span class="text-orange-500 font-bold">{{ $comment->user->name }}</span>
                        </td>
                        <td class="p-3">{{ $comment->comment }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr class="border-t border-gray-300">
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</x-app-layout>
