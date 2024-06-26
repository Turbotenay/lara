<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                            <input type="text" name="title" id="title" value="{{ $post->title }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-4">
                            <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Content</label>
                            <textarea name="content" id="content" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $post->content }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image</label>
                            <input type="file" name="image" id="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @if($post->image_url)
                                <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="mt-4 h-48 w-48">
                            @endif
                        </div>
                        <div class="mb-4">
                            <label for="categories" class="block text-gray-700 text-sm font-bold mb-2">Categories</label>
                            <select name="categories[]" id="categories" multiple class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if($post->categories->pluck('id')->contains($category->id)) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">Author</label>
                            <select name="user_id" id="user_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" @if($post->user_id == $user->id) selected @endif>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center justify-between">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
