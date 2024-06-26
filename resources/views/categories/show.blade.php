<!-- resources/views/categories/show.blade.php -->
<x-guest-layout>
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold my-4">{{ $category->name }}</h1>
        <ul>
            @foreach ($category->posts as $post)
                <li>{{ $post->title }}</li>
            @endforeach
        </ul>
    </div>
</x-guest-layout>
