<x-guest-layout>
  <!-- Container -->
  <div class="mx-auto w-full max-w-7xl px-5 py-16 md:px-10 md:py-24 lg:py-16">
    <!-- Component -->
    <div class="flex flex-col items-center">
      <!-- Blog Div -->
      <div class="mb-6 grid grid-cols-1 justify-items-center gap-8 sm:justify-items-stretch md:mb-10 md:grid-cols-3 md:gap-4 lg:mb-12">
        @foreach($posts as $post)
        <!-- Blog Item -->
        <a href="{{ route('posts.show', $post->id) }}" class="flex flex-col gap-4 rounded-2xl border border-solid border-[#b1b1b1] bg-[#f5f8ff] p-6 font-bold text-black transition hover:[box-shadow:rgb(0,_0,_0)_7px_7px]">
          <img src="{{ $post->image_url }}" alt="" class="inline-block h-60 w-full object-cover" />
          <div class="w-full pt-4">
            <p class="mb-4 text-xs font-semibold uppercase text-[#636262]">
              @foreach($post->categories as $category)
                  {{ $category->name }}@if(!$loop->last), @endif
              @endforeach</p>
            <p class="mb-4 text-xl font-semibold">{{ $post->title }}</p>
            <p class="mb-5 font-normal text-[#636262] lg:mb-8">{{ $post->content }}</p>
            <div class="mx-auto flex max-w-[480px] flex-row items-center text-left">
              <img src="https://via.placeholder.com/64" alt="" class="mr-4 inline-block h-16 w-16 rounded-full object-cover" />
              <div class="flex flex-col items-start">
                <!-- <h6 class="text-base font-semibold">
                @if ($post->user)
                    {{ $post->user->name }}
                @else
                    <span class="text-gray-500">Guest</span>
                @endif
                </h6> -->
                <div class="flex items-start max-[991px]:flex-col lg:items-center">
                  <p class="text-sm text-[#636262]">{{ $post->created_at->format('M d, Y') }}</p>
                </div>
              </div>
            </div>
          </div>
        </a>
        @endforeach
      </div>
      <a href="#" class="inline-block rounded-xl bg-black px-8 py-4 text-center font-semibold text-white [box-shadow:rgb(19,_83,_254)_6px_6px]">View More Articles</a>
    </div>
  </div>

  <img src="https://assets.website-files.com/63904f663019b0d8edf8d57c/639832e3e7aba393eeeba215_plain6.svg" alt="" class="absolute bottom-auto left-0 right-auto top-0 inline-block sm:bottom-auto sm:left-4 sm:right-auto sm:top-8 md:left-20 md:top-16" />

  <x-footer />
</x-guest-layout>
