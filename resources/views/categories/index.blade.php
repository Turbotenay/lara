<!-- resources/views/categories/index.blade.php -->

<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <div onclick="history.back()" class="mr-4 bg-blue-500 hover:bg-blue-700 text-gray-500 font-bold py-2 px-4 rounded cursor-pointer">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 9.75 14.25 12m0 0 2.25 2.25M14.25 12l2.25-2.25M14.25 12 12 14.25m-2.58 4.92-6.374-6.375a1.125 1.125 0 0 1 0-1.59L9.42 4.83c.21-.211.497-.33.795-.33H19.5a2.25 2.25 0 0 1 2.25 2.25v10.5a2.25 2.25 0 0 1-2.25 2.25h-9.284c-.298 0-.585-.119-.795-.33Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h2 class="font-semibold text-xl text-gray-500 leading-tight">
                {{ __('Categories') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-4">Create Category</a>
                    <table class="min-w-full divide-y divide-gray-200" id="categories-table">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($categories as $category)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $category->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

<script>
    if (!$.fn.DataTable.isDataTable('#categories-table')) {
        $('#categories-table').DataTable({});
    }
</script>
