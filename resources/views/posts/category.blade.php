<x-guest-layout>
    <!-- Container -->
    <div class="mx-auto w-full max-w-7xl px-5 py-16 md:px-10">
        <h1 class="text-2xl text-blue-500 font-bold mb-8">Posts in {{ $category->name }}</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($posts as $post)
                <!-- Post Div -->
                <div class="w-full rounded-2xl border border-solid border-[#b1b1b1] bg-[#f5f8ff] p-6 font-bold text-black transition hover:[box-shadow:rgb(0,_0,_0)_7px_7px]">
                    <a href="{{ route('posts.show', $post) }}">
                        <img src="{{ $post->image_url }}" alt="" class="w-full h-48 object-cover mb-4 rounded-t-2xl" />
                    </a>
                    <div class="w-full">
                        <p class="mb-4 text-xs font-semibold uppercase text-[#636262]">
                            @foreach($post->categories as $category)
                                {{ $category->name }}@if(!$loop->last), @endif
                            @endforeach
                        </p>
                        <p class="mb-4 text-xl font-semibold"><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></p>
                        <p class="mb-5 font-normal text-[#636262]">{{ \Illuminate\Support\Str::limit($post->content, 100) }}</p>
                        <div class="flex items-center">
                            <img src="https://via.placeholder.com/64" alt="" class="mr-4 inline-block h-16 w-16 rounded-full object-cover" />
                            <div class="flex flex-col">
                                <h6 class="text-base font-semibold">
                                    @if ($post->user)
                                        {{ $post->user->name }}
                                    @else
                                        <span class="text-gray-500">Guest</span>
                                    @endif
                                </h6>
                                <div class="flex items-center">
                                    <p class="text-sm text-[#636262]">{{ $post->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p>No posts found in this category.</p>
            @endforelse
        </div>
    </div>
    <img src="https://assets.website-files.com/63904f663019b0d8edf8d57c/639832e3e7aba393eeeba215_plain6.svg" alt="" class="absolute bottom-auto left-0 right-auto top-0 inline-block sm:bottom-auto sm:left-4 sm:right-auto sm:top-8 md:left-20 md:top-16" />
    <x-footer />
</x-guest-layout>
