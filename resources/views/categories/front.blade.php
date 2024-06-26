<!-- resources/views/categories/front.blade.php -->

<x-guest-layout>
  <!-- Container -->
  <div class="mx-auto w-full max-w-7xl px-5 py-16 md:px-10 md:py-24 lg:py-16">
    <!-- Component -->
    <div class="flex flex-col items-center">
        <div class="container mx-auto px-4">
            <h1 class="text-2xl font-bold my-4">Categories</h1>
            <div class="flex flex-col mt-4">
                @foreach($categories as $category)
                    <a href="{{ route('categories.show', $category) }}" class="mr-4 py-2 text-blue-500">{{ $category->name }} ({{ $category->posts_count }})</a>
                @endforeach
            </div>
        </div>
      <a href="#" class="inline-block rounded-xl bg-black px-8 py-4 text-center font-semibold text-white [box-shadow:rgb(19,_83,_254)_6px_6px]">View More Articles</a>
    </div>
  </div>

  <img src="https://assets.website-files.com/63904f663019b0d8edf8d57c/639832e3e7aba393eeeba215_plain6.svg" alt="" class="absolute bottom-auto left-0 right-auto top-0 inline-block sm:bottom-auto sm:left-4 sm:right-auto sm:top-8 md:left-20 md:top-16" />

  <x-footer />
</x-guest-layout>