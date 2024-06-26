<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <form action="{{ route('settings.update') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="content_limit">Content Limit:</label>
                                <input type="number" name="content_limit" id="content_limit" class="form-control" value="{{ $contentLimitSetting->value ?? '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="title_limit">Title Limit:</label>
                                <input type="number" name="title_limit" id="title_limit" class="form-control" value="{{ $titleLimitSetting->value ?? '' }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Settings</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
